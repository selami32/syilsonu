<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}
// Yâ Âlîm Yâ Allah
include 'baglanti.php';
include 'veritabani.php';

function satirsayisi($tablo){
  
  $sql="select * from $tablo";
  $sonuc=$veritabani->query("$sql");
	
  return $sonuc->num_rows;
}

function satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis) {
    if (!$sorgu) {$satir=str_ireplace("Selami"," ",$satir); $content = str_ireplace($degis,$satir,$content); return $content; }
    $gecicisatir="";
    $satirlar="";
    
    while ($sonuc=$sorgu->fetch_array())
    {
    
      if ($degis=='hizmet_ici') $sonuc= preg_replace ("/\r\n|\n\r|\n|\r/","\par ",$sonuc);

      $gecicisatir=$satir;
      for ($i=0;$i<$toplamalan;$i++){
  
    
       $gecicisatir = preg_replace("'Selami'", $sonuc[$i],$gecicisatir,1);   
    
      }

      $satirlar=$satirlar.$gecicisatir;
    }
      $content = str_ireplace($degis,$satirlar,$content);
      return $content;
}

function satireklemeozelr($content, $sorgu, $satir,$toplamalan, $degis, $veritabani,$tablo) {
    if (!$sorgu) {$satir=str_ireplace("Selami"," ",$satir); $content = str_ireplace($degis,$satir,$content); return $content; }
    $gecicisatir="";
    $satirlar="";
    
    while ($sonuc=$sorgu->fetch_array())
    {
    
      if ($degis=='hizmet_ici') $sonuc= preg_replace ("/\r\n|\n\r|\n|\r/","\par ",$sonuc);

      $gecicisatir=$satir;
      for ($i=0;$i<$toplamalan;$i++){
  
    
       $gecicisatir = preg_replace("'Selami'", $sonuc[$i],$gecicisatir,1);   
    
      }
      
      if ($degis=='rehber_o'){
                $adisoyadi=$sonuc['adisoyadi'];
                $sql="select `aldigiegitimler` from $tablo"."_egitimler where adisoyadi='$adisoyadi' and aldigiegitimler<>''";
                $result=$veritabani->query($sql);
                $alsatirlar="";
                if ($sonuc){
                  while ($row=$result->fetch_assoc()){
                    $alsatirlar=$alsatirlar . $row['aldigiegitimler'] . "\par ";  
                    }
                    $gecicisatir = preg_replace("'Selami'", $alsatirlar,$gecicisatir,1); 

                }

      }
      $satirlar=$satirlar.$gecicisatir;
    }
      $content = str_ireplace($degis,$satirlar,$content);
      return $content;
}

function dosyalistele($yol) { 
    $dizinac = opendir($yol); 
    while ( gettype ($dosya = readdir($dizinac) ) != boolean ) { 
        if ( is_file("$yol/$dosya") ) { 
                echo (ucwords($dosya)."<br>"); 
        } 
    } 
    closedir ($dizinac); 
}
/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}


$kurumkodu=$_POST["kurumkodu"];
if (!$kurumkodu) $kurumkodu=$_GET["kurumkodu"];

if (!$kurumkodu) die("kurum kodu yoktu");
//dosyanýn içini okuyup deðiþkene atayan kod:
$content= file_get_contents('yil_sonu.rtf'); 

//rehhiz
$tablo=$onek."rehhiz";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
//echo $sorgu;

$degis="Reh_hiz";

if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())

	{
		for ($i=1;$i<50;$i++){
		$content = preg_replace("'$degis'",$sonuc[$i+2],$content,1);   
		}


	}
	}
$content = str_ireplace($degis," ",$content);
//=============================================


//okul bilgileri
$tablo=$onek."okulbilgileri";
$sql="select `ili`, `ilcesi`, `okulunadi`, `ogretimyili`, `adresi`, `ogrenimsekli`, `ogrenimsekli`, `telefonfaks`, `postakodu`, `internetadresi`, `eposta`, `ogrencisayisikiz`, `ogrencisayisierkek`, `ogrencisayisitoplam`,    `rehberogretmennorm`, `rehberogretmensayisi` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$degis="okul_bil";

if ($sorgu){
	while ($sonuc=$sorgu->fetch_array()){
		for ($i=0;$i<=16;$i++){
		  
		  switch ($i) {
		  case 5:
		  case 6:
			
			if ($sonuc[$i]=="normal")
			{
	//          echo "burda $sonuc[$i] ";
			  $degis="okul_biln";
			  $content = str_ireplace($degis,"X",$content); 
			  $degis="okul_bili";
			  $content = str_ireplace($degis," ",$content); 
			}
			else
			{
			 $degis="'okul_bili'";
			 $content = preg_replace($degis,"X",$content,1); 
			 $degis="'okul_biln'";
			 $content = preg_replace($degis," ",$content,1); 
			}
			break;
		
		  default:    
			
			  $degis="okul_bil";
			$content = preg_replace("'$degis'",$sonuc[$i],$content,1); 
			
		break;
		}	
		}

	}
}
$degis="okul_bil";
$content = str_ireplace($degis," ",$content); //temizlik
//=============================================



//toplantilar
$tablo=$onek."toplanti";
$sql="select `toplantitarihibirinciyariyil`, `birinciyariyilalinankararlar`, `toplantitarihiikinciyariyil`, `ikinciyariyilalinankararlar`, `toplantitarihiyilsonu`, `yilsonualinankararlar` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$degis="Toplantilar";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=0;$i<=6;$i++){
		$sonuc[$i]=temizle($sonuc[$i]);
		$sonuc[$i]= preg_replace ("/\r\n|\n\r|\n|\r/","\par ",$sonuc[$i]);
		
		//echo $sonuc[$i];
			$content = preg_replace("'$degis'",$sonuc[$i],$content,1); 

		}

	}
}
$content = str_ireplace($degis," ",$content); //temizlik
//=============================================



/*/rehberogretmen
$tablo=$onek."rehberogretmen";
$sql="select `adisoyadi`, `cinsiyeti`, `gorevebaslamatarihi`, `buokuldagorevebaslamatarihi`, `gorevturu`, `mezunokul`, `tezkonusu`, `eposta`, `ceptelefonu` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$aranacaklar=array(
"adi_soyadi",
"cinsi_yeti",
"gorbas",
"okulda_gor",
"gorevturu",
"kad_rolu",
"gor_ev",
"me_zunol",
"yuk_sek",
"e_posta",
"tele_fon"
);
if ($sorgu){
	while ($sonuc=$sorgu->fetch_assoc())
	{
	  $adisoyadi=$sonuc['adisoyadi'];
			$content = preg_replace("'adi_soyadi'", $sonuc['adisoyadi'],$content,1); 
			$content = preg_replace("'cinsi_yeti'", $sonuc['cinsiyeti'],$content,1); 
			$content = preg_replace("'gorbas'", $sonuc['gorevebaslamatarihi'],$content,1); 
			$content = preg_replace("'okulda_gor'", $sonuc['buokuldagorevebaslamatarihi'],$content,1); 
			if ($sonuc['gorevturu']=='Görevlendirme'){
		  $content = preg_replace("'kad_rolu'", '',$content,1);
		  $content = preg_replace("'gor_ev'", 'X',$content,1);
		}else{
		  $content = preg_replace("'kad_rolu'", 'X',$content,1);
		  $content = preg_replace("'gor_ev'", '',$content,1);
			} 
			$content = preg_replace("'me_zunol'", $sonuc['mezunokul'],$content,1); 
			$content = preg_replace("'yuk_sek'", $sonuc['tezkonusu'],$content,1); 
			$content = preg_replace("'e_posta'", $sonuc['eposta'],$content,1); 
			$content = preg_replace("'tele_fon'", $sonuc['ceptelefonu'],$content,1); 
		  
	  
	}
}
$content=str_replace($aranacaklar,"",$content);

$sql="select `aldigiegitimler` from $tablo"."_egitimler where adisoyadi='$adisoyadi' and aldigiegitimler<>''";
$sonuc=$veritabani->query($sql);
$satirlar="";
if ($sonuc){
  while ($satir=$sonuc->fetch_assoc()){
    $satirlar=$satirlar . $satir['aldigiegitimler'] . "\par ";  
  }
		$content = str_ireplace("ald_eg", $satirlar,$content); 

}
*/
$satir='\ql \li113\ri113\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin113\lin113\pararsid6494615 {
\b\f39\insrsid6494615\charrsid6494615 Selami\cell }\pard \ql \li113\ri113\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin113\lin113\pararsid1655658 {\b\f39\insrsid6494615\charrsid6494615 Selami\cell Selami\cell }{\b\f39\insrsid6494615 Selami}{
\b\f39\insrsid6494615\charrsid6494615 \cell }{\b\f39\insrsid6494615 Selami}{\b\f39\insrsid6494615\charrsid6494615 \cell }{\b\f39\insrsid6494615 Selami}{\b\f39\insrsid6494615\charrsid6494615 \cell }\pard 
\qc \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid1655658 {\b\f39\insrsid6494615 Selami}{\b\f39\insrsid6494615\charrsid6494615 \cell }{\b\f39\insrsid6494615 Selami}{\b\f39\insrsid6494615\charrsid6494615 \cell }\pard 
\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid6494615 {\b\f39\insrsid6494615 E-Posta: Selami
\par Telefon: Selami}{\b\f39\insrsid6494615\charrsid6494615 \cell }\pard \qc \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid1655658 {\b\f39\insrsid6494615 Selami}{\b\f39\insrsid6494615\charrsid6494615 \cell }\pard 
\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\f39\insrsid6494615\charrsid6494615 \trowd \irow1\irowband1\lastrow \ts11\trgaph108\trrh1624\trleft-108\trkeep\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 
\trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 \trftsWidth3\trwWidth10120\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid6494615\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol 
\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxbtlr\clftsWidth3\clwWidth959\clshdrawnil \cellx851\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr
\brdrs\brdrw10 \cltxbtlr\clftsWidth3\clwWidth354\clshdrawnil \cellx1205\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxbtlr\clftsWidth3\clwWidth331\clshdrawnil \cellx1536\clvertalc\clbrdrt
\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxbtlr\clftsWidth3\clwWidth331\clshdrawnil \cellx1867\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxbtlr\clftsWidth3\clwWidth401\clshdrawnil \cellx2268\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxbtlr\clftsWidth3\clwWidth426\clshdrawnil \cellx2694\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1604\clshdrawnil \cellx4298\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1432\clshdrawnil \cellx5730\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth2208\clshdrawnil \cellx7938\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth2074\clshdrawnil \cellx10012\row }\pard ';
$tablo=$onek."rehberogretmen";
$sql="select `adisoyadi`, `cinsiyeti`, `gorevebaslamatarihi`, `buokuldagorevebaslamatarihi`, (SELECT IF (`gorevturu`='Kadrolu','X','') ), (SELECT IF (`gorevturu`='Kadrolu','','X') ),`mezunokul`, `tezkonusu`, `eposta`, `ceptelefonu` from $tablo where kurumkodu=$kurumkodu";

$sorgu=$veritabani->query("$sql");
$toplamalan=10;
$degis="rehber_o";
$content=satireklemeozelr($content, $sorgu, $satir,$toplamalan, $degis,$veritabani,$tablo);
$satir="";



//===============================

//sorunalan
$tablo=$onek."sorunalan";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
//echo $sorgu;
$toplamalan=29-1;
$degis="s_alan";

if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())

	{
		for ($i=4;$i<$toplamalan;$i++){
		$content = preg_replace("'$degis'",$sonuc[$i],$content,1);   
		}
		$degis="s_diger";
	$content = str_ireplace($degis,$sonuc[$toplamalan],$content);
	}
}
$degis="s_alan";
$content = str_ireplace($degis," ",$content); //temizlik

//=============================================

//rehberlik servisi bilgileri
$tablo=$onek."rehberlikservisi";
$sql="select `bagimsizodasivarmi`, `hizmetlericinuygunmu`, `donanimyeterlimi`, `bilgisayarvarmi`, `yazicivarmi`, `internetvarmi`, `telefonvarmi`, `fotokopivarmi`, `olcmearaclarivarmi` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query($sql);
//echo $sorgu;
$toplamalan=11;
$degis="reh_d";

if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=0;$i<$toplamalan;$i++){
//  echo $sonuc[$i];
			if ($sonuc[$i]=="1"){
				$content = preg_replace("'$degis'","X",$content,1);   
				$content = preg_replace("'$degis'"," ",$content,1);   
			}
			if ($sonuc[$i]=="2"){
				$content = preg_replace("'$degis'"," ",$content,1);   
				$content = preg_replace("'$degis'","X",$content,1);   
			}
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik


//=============================================

/*
//meslekirehberlik
$tablo=$onek."meslekirehberlik";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=66;
$degis="m_reh";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=3;$i<$toplamalan;$i++){
	  
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik

*/
//=============================================

//üst okul ziyaret
$tablo=$onek."okulisyeriziyaret";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=21;
$degis="ust_ok";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=3;$i<$toplamalan;$i++){
	  
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik

//==============================================


//sýnav kaygýsý
$tablo=$onek."sinavkaygisi";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=16;
$degis="sin_kay";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=4;$i<$toplamalan;$i++){
	  
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik

//==============================================


/*/olcme araclari
$tablo=$onek."olcmearaclari";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=95;
$degis="olc_me";
while ($sonuc=$sorgu->fetch_array())
{
	for ($i=2;$i<$toplamalan;$i++){
  
    $content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
  
    }
}
$content = str_ireplace($degis," ",$content); //temizlik

//==============================================*/


//psikomud
$tablo=$onek."psikomudahale";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=76;

	$degis="psi_ko";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=4;$i<$toplamalan;$i++){
	  
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik

//==============================================



/*ogrenci davranýþlarý (tablo dinamik hale geldiginden iptal)
$tablo=$onek."ogrencidavranislari";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=90;
$degis="ogr_dav";
while ($sonuc=$sorgu->fetch_array())
{
	for ($i=2;$i<$toplamalan;$i++){
  
    $content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
  
    }
}
$content = str_ireplace($degis," ",$content); //temizlik */



//araþtýrma
$satir=' \s15\qc \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid15539575 \fs24\lang1055\langfe1055
\cgrid\langnp1055\langfenp1055 {\cf0\insrsid13378192 Selami}{\cf0\insrsid13378192\charrsid7752596 \cell }{\cf0\insrsid13378192 Selami}{ 
\cf0\insrsid13378192\charrsid7752596 \cell }{\cf0\insrsid13378192 Selami}{\cf0\insrsid13378192\charrsid7752596 \cell }\pard\plain \ql 
\li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 
\fs20\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\fs24\cf0\insrsid13378192\charrsid7752596 \trowd \irow5\irowband5\ts11
\trgaph108\trleft0\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh
\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 \trftsWidth3\trwWidth9639\trftsWidthB3\trftsWidthA3\trautofit1\trpaddl108\trpaddr108\trpaddfl3
\trpaddft3\trpaddfb3\trpaddfr3\tblrsid13378192\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol \clvertalt\clbrdrt
\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3142\clshdrawnil 
\cellx3142\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth3248\clshdrawnil \cellx6390\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 
\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3249\clshdrawnil \cellx9639\row }\pard\plain ';

$tablo=$onek."arastirma";
$sql="select `arastirmalar`, `projeler`, `yayinlar` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=3;
$degis="aras_t";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";

//olcmearaclariyeni

$satir='\ql \li0\ri0\widctlpar\intbl\pvpara\phmrg\posx69\posy92\dxfrtext141\dfrmtxtx141\dfrmtxty0\wraparound\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid6696404 {\rtlch\fcs1 
\af0\afs22 \ltrch\fcs0 \fs22\insrsid2517716 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid6696404\charrsid13240584 \cell }\pard \ltrpar
\qc \li0\ri0\widctlpar\intbl\pvpara\phmrg\posx69\posy92\dxfrtext141\dfrmtxtx141\dfrmtxty0\wraparound\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid6696404 {\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid2517716 Selami}{\rtlch\fcs1 \af0\afs22 
\ltrch\fcs0 \fs22\insrsid6696404\charrsid13240584 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid2517716 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid6696404\charrsid13240584 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 
\fs22\insrsid2517716 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid6696404\charrsid13240584 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid2517716 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid6696404\charrsid13240584 \cell 
}\pard \ltrpar\ql \li0\ri0\sa200\sl276\slmult1\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid6696404\charrsid2169627 \trowd \irow2\irowband2\lastrow \ltrrow
\ts11\trgaph70\trrh251\trleft-70\trkeep\trbrdrt\brdrs\brdrw30 \trbrdrl\brdrs\brdrw30 \trbrdrb\brdrs\brdrw30 \trbrdrr\brdrs\brdrw30 \trbrdrh\brdrs\brdrw15 \trbrdrv\brdrs\brdrw15 
\tpvpara\tphmrg\tposx69\tposy92\tdfrmtxtLeft141\tdfrmtxtRight141\trftsWidth3\trwWidth9639\trftsWidthB3\trftsWidthA3\trpaddl70\trpaddr70\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblind0\tblindtype3 \clvertalt\clbrdrt\brdrs\brdrw30 \clbrdrl\brdrs\brdrw30 
\clbrdrb\brdrs\brdrw30 \clbrdrr\brdrs\brdrw15 \cltxlrtb\clftsWidth3\clwWidth3939\clshdrawnil \cellx3869\clvertalc\clbrdrt\brdrs\brdrw30 \clbrdrl\brdrs\brdrw15 \clbrdrb\brdrs\brdrw30 \clbrdrr\brdrs\brdrw15 \cltxlrtb\clftsWidth3\clwWidth885\clshdrawnil 
\cellx4754\clvertalc\clbrdrt\brdrs\brdrw30 \clbrdrl\brdrs\brdrw15 \clbrdrb\brdrs\brdrw30 \clbrdrr\brdrs\brdrw15 \cltxlrtb\clftsWidth3\clwWidth1430\clshdrawnil \cellx6184\clvertalc\clbrdrt\brdrs\brdrw30 \clbrdrl\brdrs\brdrw15 \clbrdrb\brdrs\brdrw30 
\clbrdrr\brdrs\brdrw15 \cltxlrtb\clftsWidth3\clwWidth1430\clshdrawnil \cellx7614\clvertalc\clbrdrt\brdrs\brdrw30 \clbrdrl\brdrs\brdrw15 \clbrdrb\brdrs\brdrw30 \clbrdrr\brdrs\brdrw30 \cltxlrtb\clftsWidth3\clwWidth1955\clshdrawnil \cellx9569\row 
}\pard';

$tablo=$onek."olcmearaclari";
$sql="select olcmearaci, subesayisi, kiz, erkek, toplam from $tablo where kurumkodu='$kurumkodu' and subesayisi<>0 ORDER BY sn";
$sorgu=$veritabani->query("$sql");
$toplamalan=5; //0 la beraber
$degis="olc_me";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";



//etkinlik tablosu
$satir='\ql \li0\ri0\sl360\slmult1\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid794430 {\fs16\insrsid5337054 Selami}

{\fs16\insrsid5337054\charrsid10814865 \cell }\pard 
\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid794430 {\fs16\insrsid5337054 Selami}{\fs16

\insrsid5337054\charrsid5337054 \cell }\pard\plain 
\s15\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid794430 \fs24\lang1055\langfe1055

\cgrid\langnp1055\langfenp1055 {\fs16\insrsid5337054 Selami}{\fs16\insrsid5337054\charrsid5337054 \cell }{\fs16\insrsid5337054 Selami}{
\fs16\insrsid5337054\charrsid5337054 \cell }{\fs16\insrsid5337054 Selami}{\fs16\insrsid5337054\charrsid5337054 \cell }{\fs16

\insrsid5337054 Selami}{\fs16\insrsid5337054\charrsid5337054 \cell }{\fs16\insrsid5337054 Selami}{
\fs16\insrsid5337054\charrsid5337054 \cell }{\fs16\insrsid5337054 Selami}{\fs16\insrsid5337054\charrsid5337054 \cell }\pard\plain \ql 

\li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 
\fs20\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\fs24\insrsid9437780  }{\insrsid5337054 \trowd \irow3\irowband3\lastrow \ts11

\trgaph70\trrh240\trleft0\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 
\trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 \trftsWidth3\trwWidth9639\trftsWidthB3\trftsWidthA3\trpaddl70\trpaddr70\trpaddfl3

\trpaddfr3 \clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth2127\clshdrawnil \cellx2127\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 

\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3827\clshdrawnil \cellx5954\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth567\clshdrawnil \cellx6521

\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth623\clshdrawnil \cellx7144\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 

\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth624\clshdrawnil \cellx7768\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth623\clshdrawnil \cellx8391

\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth624\clshdrawnil \cellx9015\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 

\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth624\clshdrawnil \cellx9639\row }\pard ';

$tablo=$onek."etkinlikler";
$sql="select `etkinlikturu`, `etkinlikkonusu`, `etkinliksayisi`, `etkinlikkatogretmen`, `etkinlikkatogrenci`, `etkinlikkatveli`, `etkinlikkatdiger`, `etkinlikkattoplam` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=8; //0 la beraber
$degis="etkin_lik";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";

//isbirligi yapýlan kuruluþlar
$satir='\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid4944595 {\fs22\cf1\insrsid15102860 Selami}{\fs22\cf1

\insrsid15102860\charrsid30724 \cell }{\fs22\cf1\insrsid15102860 Selami}{
\fs22\cf1\insrsid15102860\charrsid30724 \cell }\pard \ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\cf1

\insrsid15102860\charrsid30724 \trowd \irow1\irowband1\lastrow \ts11\trgaph108\trleft0\trbrdrt\brdrs\brdrw10 \trbrdrl
\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth9639\trftsWidthB3\trftsWidthA3\trautofit1\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3

\tblrsid15102860\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol \clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 
\clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth4806\clshdrawnil \cellx4806\clvertalt\clbrdrt\brdrs\brdrw10 

\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth4833\clshdrawnil 
\cellx9639\row }\pard ';

$tablo=$onek."isbirligi";
$sql="select kurum,konusu from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=3; //0 la beraber
$degis="isbir_lik";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";




//hizmetici egitim onerileri
$satir='\irow1\irowband1\lastrow \ts11\trgaph70\trrh-284\trleft-70\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 

\trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth9639\trftsWidthB1\trftsWidthA3\trpaddl70\trpaddr70\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3 

\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth7200\clshdrawnil \cellx7130\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 

\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth2439\clshdrawnil \cellx9569\pard \ql \li0\ri0\sl360\slmult1
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid5837368 { Selami}{\charrsid11076583 \cell }{ Selami}{\cell }\pard 
\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\f36\fs18\insrsid485030\charrsid11076583 \trowd \irow1

\irowband1\lastrow \ts11\trgaph70\trrh-284\trleft-70\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 
\trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 \trftsWidth3\trwWidth9639\trftsWidthB1\trftsWidthA3\trpaddl70

\trpaddr70\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3 \clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb
\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth7200\clshdrawnil \cellx7130\clvertalc\clbrdrt\brdrs\brdrw10 

\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth2439\clshdrawnil \cellx9569
\row }\pard ';

$tablo=$onek."hizmetici";
$sql="select konu, kimlere from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=3; //0 la beraber
$degis="hizmet_ici";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";
//===================================================================

//mesleki rehberlik yeni
$satir='\s16\qc \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 \rtlch\fcs1 \af0\afs24\alang1025 \ltrch\fcs0 
\fs24\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \fs16\insrsid11488154 Baslangic}{\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \fs16\insrsid14294362\charrsid2169627 \cell }\pard \ltrpar
\s16\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid14294362\charrsid2169627 
\cell }\pard \ltrpar\s16\qc \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 
\fs22\insrsid14294362\charrsid2169627 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami
}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }\pard\plain \ltrpar\ql \li0\ri0\sa200\sl276\slmult1\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 \rtlch\fcs1 \af0\afs20\alang1025 \ltrch\fcs0 
\fs20\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid14294362\charrsid2169627 \trowd \irow2\irowband2\ltrrow\ts11\trgaph108\trleft-70\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr
\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth9851\trftsWidthB3\ftrftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid14294362\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind38\tblindtype3 \clvmgf\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3130\clshdrawnil \cellx3060\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth3420\clshdrawnil \cellx6480\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx7560\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx8640\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1141\clshdrawnil \cellx9781\row \ltrrow}\trowd \irow3\irowband3\ltrrow\ts11\trgaph108\trleft-70\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv
\brdrs\brdrw10 \trftsWidth3\trwWidth9851\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid14294362\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind38\tblindtype3 \clvmrg\clvertalc\clbrdrt
\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3130\clshdrawnil \cellx3060\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth3420\clshdrawnil \cellx6480\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx7560\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx8640\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1141\clshdrawnil \cellx9781\pard \ltrpar\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \fs16\insrsid14294362\charrsid2169627 \cell 
}\pard\plain \ltrpar\s16\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 \rtlch\fcs1 \af0\afs24\alang1025 \ltrch\fcs0 \fs24\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0\afs16 
\ltrch\fcs0 \b\fs16\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid14294362\charrsid2169627 \cell }\pard \ltrpar\s16\qc \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {
\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 
\fs22\insrsid14294362\charrsid2169627 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }\pard\plain \ltrpar\ql \li0\ri0\sa200\sl276\slmult1
\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 \rtlch\fcs1 \af0\afs20\alang1025 \ltrch\fcs0 \fs20\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid14294362\charrsid2169627 
\trowd \irow3\irowband3\ltrrow\ts11\trgaph108\trleft-70\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth9851\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid14294362\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind38\tblindtype3 \clvmrg\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3130\clshdrawnil \cellx3060\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth3420\clshdrawnil \cellx6480\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx7560\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx8640\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1141\clshdrawnil \cellx9781\row \ltrrow}\pard \ltrpar\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 
\fs16\insrsid14294362\charrsid2169627 \cell }\pard\plain \ltrpar\s16\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 \rtlch\fcs1 \af0\afs24\alang1025 \ltrch\fcs0 
\fs24\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid14294362\charrsid2169627 \cell }\pard \ltrpar
\s16\qc \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }{
\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 
\fs22\insrsid14294362\charrsid2169627 \cell }\pard\plain \ltrpar\ql \li0\ri0\sa200\sl276\slmult1\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 \rtlch\fcs1 \af0\afs20\alang1025 \ltrch\fcs0 
\fs20\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid14294362\charrsid2169627 \trowd \irow4\irowband4\ltrrow\ts11\trgaph108\trleft-70\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr
\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth9851\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid14294362\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind38\tblindtype3 \clvmrg\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3130\clshdrawnil \cellx3060\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth3420\clshdrawnil \cellx6480\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx7560\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx8640\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1141\clshdrawnil \cellx9781\row \ltrrow}\pard \ltrpar\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 
\fs16\insrsid14294362\charrsid2169627 \cell }\pard\plain \ltrpar\s16\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 \rtlch\fcs1 \af0\afs24\alang1025 \ltrch\fcs0 
\fs24\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid14294362\charrsid2169627 \cell }\pard \ltrpar
\s16\qc \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }{
\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 
\fs22\insrsid14294362\charrsid2169627 \cell }\pard\plain \ltrpar\ql \li0\ri0\sa200\sl276\slmult1\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 \rtlch\fcs1 \af0\afs20\alang1025 \ltrch\fcs0 
\fs20\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid14294362\charrsid2169627 \trowd \irow5\irowband5\ltrrow\ts11\trgaph108\trleft-70\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr
\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth9851\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid14294362\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind38\tblindtype3 \clvmrg\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3130\clshdrawnil \cellx3060\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth3420\clshdrawnil \cellx6480\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx7560\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx8640\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1141\clshdrawnil \cellx9781\row \ltrrow}\pard \ltrpar\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 
\fs16\insrsid14294362\charrsid2169627 \cell }\pard\plain \ltrpar\s16\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 \rtlch\fcs1 \af0\afs24\alang1025 \ltrch\fcs0 
\fs24\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs16 \ltrch\fcs0 \b\fs16\insrsid14294362\charrsid2169627 \cell }\pard \ltrpar
\s16\qc \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12025754 {\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }{
\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid10829595 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid14294362\charrsid2169627 \cell }{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 \fs22\insrsid11488154 Selami}{\rtlch\fcs1 \af0\afs22 \ltrch\fcs0 
\fs22\insrsid14294362\charrsid2169627 \cell }\pard\plain \ltrpar\ql \li0\ri0\sa200\sl276\slmult1\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 \rtlch\fcs1 \af0\afs20\alang1025 \ltrch\fcs0 
\fs20\lang1055\langfe1055\cgrid\langnp1055\langfenp1055 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid14294362\charrsid2169627 \trowd \irow6\irowband6\lastrow \ltrrow\ts11\trgaph108\trleft-70\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 
\trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth9851\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid14294362\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind38\tblindtype3 \clvmrg\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3130\clshdrawnil \cellx3060\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth3420\clshdrawnil \cellx6480\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx7560\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx8640\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1141\clshdrawnil \cellx9781\row }\pard\plain';

$tablo=$onek."meslekirehberlik";
//satýr eklemeli tablo için deðer deðiþtirme 
$modullericinokultipi='Mesleki ve teknik Eðitimde Modüller Arasý Geçiþler (Yatay Geçiþler)';
$sql="select `kiz`, `erkek`, `toplam` from $tablo where `kurumkodu`='$kurumkodu' and `grubu` <> '$modullericinokultipi' ORDER BY `sn` ASC" ;
$sorgu=$veritabani->query("$sql");
$toplamsatir=20;

$degis="m_reh";
//YÂ ÂLÎM ALLAH!
if ($sorgu){
	for ($i=0;$i<$toplamsatir;$i++){
	$sonuc=$sorgu->fetch_assoc();
	
		$content = preg_replace("'$degis'", $sonuc['kiz'],$content,1);   
	  $content = preg_replace("'$degis'", $sonuc['erkek'],$content,1);
	  $content = preg_replace("'$degis'", $sonuc['toplam'],$content,1);
		
	}
}
$content = str_replace($degis," ",$content); //temizlik
// tablonun 5 satýrlý bir bölüm ekleme sistemi:
$sql="SELECT `yonlendirilenokul`, `kiz`, `erkek`, `toplam` from $tablo where kurumkodu='$kurumkodu' AND `grubu` = '$modullericinokultipi' ORDER BY `sn` ASC";
$sorgu=$veritabani->query("$sql");
$toplamalan=4; //0 la beraber
$degis="mesleki_rehberlik";

if ($sorgu){
  $gecicisatir="";
  $satirlar="";
  
  $tekrar= ceil($sorgu->num_rows/5);

for ($t=0;$t<$tekrar;$t++){  
    $gecicisatir=$satir;   
    for ($r=0;$r<5;$r++){
       $sonuc=$sorgu->fetch_assoc();  
       $gecicisatir = preg_replace("'Selami'", $sonuc['yonlendirilenokul'],$gecicisatir,1);   
       $gecicisatir = preg_replace("'Selami'", $sonuc['kiz'],$gecicisatir,1);   
       $gecicisatir = preg_replace("'Selami'", $sonuc['erkek'],$gecicisatir,1);   
       $gecicisatir = preg_replace("'Selami'", $sonuc['toplam'],$gecicisatir,1);   
   //     echo $sonuc['yonlendirilenokul'].'<br>'; 
        
     }   
     $satirlar=$satirlar.$gecicisatir;
}

}
      $content = str_ireplace($degis,$satirlar,$content);

//$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$content = str_replace('Selami'," ",$content); //temizlik
$content = str_replace('Baslangic',$modullericinokultipi,$content); 

$satir="";
//==========================


//kaynastirma
$satir='\li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid5243253 {\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 
\f40\fs18\insrsid5243253\charrsid5243253 Selami\cell }\pard \ltrpar\qj \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid1595024 {\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami
}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 
\ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 
\ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 
\ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 
\ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 
\ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 
\ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 
\ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 
\ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 
\ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 
\ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 
\ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 
\ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }\pard \ltrpar
\qj \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid12720330 {\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 
\b\f40\insrsid5243253\charrsid5243253 \cell }{\rtlch\fcs1 \ab\af0\afs18 \ltrch\fcs0 \f40\fs18\insrsid5243253\charrsid5243253 Selami}{\rtlch\fcs1 \ab\af0 \ltrch\fcs0 \b\f40\insrsid5243253\charrsid5243253 \cell }\pard \ltrpar\ql \li0\ri0\sa200\sl276\slmult1
\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\rtlch\fcs1 \af0 \ltrch\fcs0 \f40\insrsid5243253\charrsid5243253 \trowd \irow3\irowband3\lastrow \ltrrow\ts11\trgaph108\trrh237\trleft-108\trbrdrt\brdrs\brdrw10 \trbrdrl
\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth10081\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid5243253\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind0\tblindtype3 \clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1242\clshdrawnil \cellx1134\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth401\clshdrawnil \cellx1535\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx1937\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx2339\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx2741\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth401\clshdrawnil \cellx3142\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx3544\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx3946\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx4348\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth401\clshdrawnil \cellx4749\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx5151\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx5553\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx5955\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx6357\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth401\clshdrawnil \cellx6758\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx7160\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx7562\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx7964\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth401\clshdrawnil \cellx8365\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx8767\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx9169\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx9571\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth402\clshdrawnil \cellx9973\row }\pard \ltrpar\qj \li0\ri0\widctlpar\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\itap0\pararsid14973085 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid12994610  }';

$tablo=$onek."kaynastirma";
$sql="select `siniflar`, `zihinkiz`, `zihinerkek`, `dehbkiz`, `dehberkek`, `ustunkiz`, `ustunerkek`, `gormekiz`, `gormeerkek`, `ozgulkiz`, `ozgulerkek`, `isitmekiz`, `isitmeerkek`, `ortopedikiz`, `ortopedierkek`, `konusmakiz`, `konusmaerkek`, `spastikkiz`, `spastikerkek`, `otistikkiz`, `otistikerkek`, `birdenfazlakiz`, `birdenfazlaerkek`  from $tablo where kurumkodu='$kurumkodu' ORDER BY `sn`";
$sorgu=$veritabani->query("$sql");
$toplamalan=23; //0 la beraber
$degis="kaynas_tirma";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";
//===================================================================


/*
$tablo=$onek."degerlendirme";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=4;
$degis="sorun_oneri";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=2;$i<$toplamalan;$i++){
		$sonuc[$i]= preg_replace ("/\r\n|\n\r|\n|\r/","\par ",$sonuc[$i]);
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik

*/


//özel eðitim======================================
$satir='\qr \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid6257673 {\fs18\insrsid15621807\charrsid15621807 Selami\cell }\pard \qc \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid6257673 {
\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{
\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{
\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{
\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{
\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }{\insrsid15621807 Selami}{\insrsid15621807\charrsid15621807 \cell }\pard \ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\insrsid15621807\charrsid15621807 
\trowd \irow4\irowband4\lastrow \ts11\trgaph108\trleft-108\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth10008\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol \clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrdb\brdrw10 \clbrdrb\brdrs\brdrw10 
\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1771\clshdrawnil \cellx1663\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth514\clshdrawnil \cellx2177\clvertalt
\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth515\clshdrawnil \cellx2692\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth515\clshdrawnil \cellx3207\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth515\clshdrawnil \cellx3722\clvertalt\clbrdrt\brdrdb\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth515\clshdrawnil \cellx4237\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth514\clshdrawnil \cellx4751\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth515\clshdrawnil \cellx5266\clvertalt\clbrdrt\brdrdb\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth494\clshdrawnil \cellx5760\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth536\clshdrawnil \cellx6296\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth544\clshdrawnil \cellx6840\clvertalt\clbrdrt\brdrdb\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth486\clshdrawnil \cellx7326\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth594\clshdrawnil \cellx7920\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth436\clshdrawnil \cellx8356\clvertalt\clbrdrt\brdrdb\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth514\clshdrawnil \cellx8870\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth515\clshdrawnil \cellx9385\clvertalt\clbrdrt\brdrdb\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth515\clshdrawnil \cellx9900\row }\pard';

$tablo=$onek."ozelegitim";
$sql="select `siniflar`, `zihinkiz`, `zihinerkek`, `gormekiz`, `gormeerkek`, `isitmekiz`, `isitmeerkek`, `ortopedikiz`, `ortopedierkek`, `otistikkiz`, `otistikerkek`, `ustunozelerkek`, `ustunozelkiz`, `bagimliocemkiz`, `bagimliocemerkek`, `toplamkiz`, `toplamerkek` from $tablo where kurumkodu='$kurumkodu' ORDER BY sn ASC";
$sorgu=$veritabani->query("$sql");
$toplamalan=20; //0 la beraber
$degis="ozel_eg";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";

$sql="select sinifsayisi, ogretmensayisi from $tablo"."_ekbilgi where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=2;

	$degis="ozel_t";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=0;$i<$toplamalan;$i++){
	  
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik


/*öðrenci davranýþlarý DÝÐER FORMA AKTARILDIÐINDAN ÝPTAL
$satir='\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid8070320 {\fs22\cf1\insrsid13263329 Selami\cell }\pard 

\qc \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid8070320 {\fs22\cf1\insrsid13263329 
Selami\cell Selami\cell Selami\cell Selami\cell Selami\cell Selami\cell Selami\cell }\pard \ql \li0\ri0

\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\insrsid13263329\charrsid920978 \trowd \irow3\irowband3\lastrow 
\ts11\trgaph70\trrh340\trleft-15\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 

\trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth9654\trftsWidthB3\trftsWidthA3\trpaddl70\trpaddr70\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid6444505

\tbllkhdrrows\tbllkhdrcols \clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth5251\clshdrawnil \cellx5236\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 

\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth627\clshdrawnil \cellx5863\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth629\clshdrawnil \cellx6492

\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth628\clshdrawnil \cellx7120\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 

\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth629\clshdrawnil \cellx7749\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth632\clshdrawnil \cellx8381

\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth629\clshdrawnil \cellx9010\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 

\clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth629\clshdrawnil \cellx9639\row }\pard ';


$tablo=$onek."ogrencidavranislari";
$sql="select `konu`, `ilkogretimuyarma`, `ilkogretimkinama`, `ilkogretimokuldeg`, `ortaogretimmahrukinama`, `ortaogretimkisauzak`, `ortaogretimtasdikname`, `ortaogretimorgunegitimdisi` from $tablo where kurumkodu='$kurumkodu' ORDER BY sn";
$sorgu=$veritabani->query("$sql");
$toplamalan=8; //0 la beraber
$degis="ogr_dav";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";

*/




//hizmetlerin deðerlendirilmesi
$tablo=$onek."degerlendirme";
$sql="select * from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=3;
$degis="sorun_oneri";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=1;$i<$toplamalan;$i++){
		$sonuc[$i]= preg_replace ("/\r\n|\n\r|\n|\r/","\par ",$sonuc[$i]);
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}

	$content = str_ireplace($degis," ",$content); //temizlik
}

$veritabani->close();
/*========================================================
                çýktý alýnýyor
 ======================================================== */         
$dosya=$kurumkodu.".rtf";

header("Content-Disposition: attachment; filename=" . urlencode($dosya));    
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");             
header("Content-Length: " . strlen($content));
flush(); // this doesn't really matter.

echo $content;

$content="";
/* 
===========================================================================
zip file eklentisi ve dosya kaydetme yetkisi olmama ihtimali nedeniyle iptal:
===========================================================================

$file = fopen("$kurumkodu.rtf", "w") or die("dosya açýlamadý!");
fwrite($file, $content); 
fclose($file);

$files_to_zip = array(
	"$kurumkodu.rtf"	
);
if (file_exists("$kurumkodu.zip")) unlink("$kurumkodu.zip");

//if true, good; if false, zip creation failed
$result = create_zip($files_to_zip,"$kurumkodu.zip");
if ($result=false) die("dosya oluþturulamadý");

unlink("$kurumkodu.rtf");
$content="";
$veritabani->close();

/*
echo "<a style='font-family:arial narrow' href='$kurumkodu.zip'>Raporu indirmek için buraya týklayýn</a>";
echo "<script language='javascript'>";
echo "document.location.href='$kurumkodu.zip'";
echo "</script>";
//========================================================


$adres="http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
$dosyalinki=str_replace("rapor.php","$kurumkodu.zip",$adres);

echo $dosyalinki;
*/
?>