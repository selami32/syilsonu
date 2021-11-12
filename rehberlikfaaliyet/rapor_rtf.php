<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}
// Yâ Âlîm Yâ Allah
include 'baglanti.php';
include 'veritabani.php';

function strtoupperTR($str){
     $str = str_replace(array('i', 'ý', 'ü', 'ð', 'þ', 'ö', 'ç'), array('Ý', 'I', 'Ü', 'Ð', 'Þ', 'Ö', 'Ç'), $str);
     return strtoupper($str);
}

function satirsayisi($tablo){
  
  $sql="select * from $tablo";
  $sonuc=$veritabani->query("$sql");
	
  return $sonuc->num_rows;
}

function satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis) {
    if (!$sorgu) {$satir=str_ireplace("Selami"," ",$satir); $content = str_ireplace($degis,$satir,$content); return $content; }
    $gecicisatir="";
    $satirlar="";
    $sn=0;
    while ($sonuc=$sorgu->fetch_array())
    {
    $sn++;
      $sonuc= preg_replace ("/\r\n|\n\r|\n|\r/","\par ",$sonuc);

      $gecicisatir=$satir;
      for ($i=0;$i<$toplamalan;$i++){
  
    
       $gecicisatir = preg_replace("'Selami'", $sonuc[$i],$gecicisatir,1);   
       $gecicisatir = preg_replace("'s_n'", $sn,$gecicisatir,1);      
      }
      $satirlar=$satirlar.$gecicisatir;
    }
      $content = str_ireplace($degis,$satirlar,$content);
      return $content;
}


$kurumkodu=$_POST["kurumkodu"];
if (!$kurumkodu) $kurumkodu=$_GET["kurumkodu"];
$okulunadi=$_POST["okulunadi"];
if (!$okulunadi) $okulunadi=$_GET["okulunadi"];

if (!$kurumkodu) die("kurum kodu yoktu");
//dosyanýn içini okuyup deðiþkene atayan kod:
$content= file_get_contents('risk_okulrapor.rtf'); 




//Yönetici öðretmen tablosu
$satir='\li0\ri0\sl240\slmult0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid3687373 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid9915885 
s_n}{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid6832680\charrsid9717868 \cell }\pard\plain \ltrpar\s15\ql \li0\ri0\sl240\slmult0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid335705\contextualspace \rtlch\fcs1 
\af0\afs22\alang1025 \ltrch\fcs0 \f37\fs22\lang1055\langfe1033\cgrid\langnp1055\langfenp1033 {\rtlch\fcs1 \af0\afs20 \ltrch\fcs0 \fs20\insrsid14752472 Selami}{\rtlch\fcs1 \af0\afs20 \ltrch\fcs0 \fs20\insrsid6832680\charrsid9717868 \cell 
}\pard\plain \ltrpar\ql \li0\ri0\sl240\slmult0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid3687373 \rtlch\fcs1 \af0\afs22\alang1025 \ltrch\fcs0 \f37\fs22\lang1055\langfe1033\cgrid\langnp1055\langfenp1033 {\rtlch\fcs1 
\af0\afs20 \ltrch\fcs0 \fs20\insrsid14752472 Selami}{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid6832680\charrsid9717868 \cell }{\rtlch\fcs1 \af0\afs20 \ltrch\fcs0 \fs20\insrsid14752472 Selami}{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid6832680\charrsid9717868 \cell }
{\rtlch\fcs1 \af0\afs20 \ltrch\fcs0 \fs20\insrsid14752472 Selami}{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid6832680\charrsid9717868 \cell }{\rtlch\fcs1 \af0\afs20 \ltrch\fcs0 \fs20\insrsid14752472 Selami}{\rtlch\fcs1 \af0 \ltrch\fcs0 
\insrsid6832680\charrsid9717868 \cell }{\rtlch\fcs1 \af0\afs20 \ltrch\fcs0 \fs20\insrsid14752472 Selami}{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid6832680\charrsid9717868 \cell }\pard \ltrpar
\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid6832680\charrsid9717868 \trowd \irow2\irowband2\lastrow \ltrrow\ts11\trgaph108\trrh540\trleft-108\trbrdrt\brdrs\brdrw10\brdrcf1 
\trbrdrl\brdrs\brdrw10\brdrcf1 \trbrdrb\brdrs\brdrw10\brdrcf1 \trbrdrr\brdrs\brdrw10\brdrcf1 \trbrdrh\brdrs\brdrw10\brdrcf1 \trbrdrv\brdrs\brdrw10\brdrcf1 
\trftsWidth3\trwWidth9878\trftsWidthB3\trftsWidthA3\trautofit1\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid9915885\tbllkhdrrows\tbllkhdrcols\tbllknocolband\tblind0\tblindtype3 \clvertalb\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl
\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth686\clshdrawnil \cellx578\clvertalb\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr
\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth5018\clshdrawnil \cellx5596\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 
\cltxlrtb\clftsWidth3\clwWidth809\clshdrawnil \cellx6405\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth809\clshdrawnil \cellx7214
\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth809\clshdrawnil \cellx8023\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl
\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth809\clshdrawnil \cellx8832\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr
\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth938\clshdrawnil \cellx9770\row }\pard';

$tablo=$onek."yoneticiogretmen";
$sql="select `programicerigimadde`, `cokyararli`, `yararli`, `yararliolmadi`, `hicyararliolmadi`, `toplam` from $tablo where kurumkodu=$kurumkodu order by sn";
$sorgu=$veritabani->query("$sql");
$toplamalan=6;
$degis="yone_tici";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";


//aile eðitimi tablosu
$satir='\li0\ri0\sl240\slmult0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid3687373 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid9568736 s_n}{\rtlch\fcs1 \af0 
\ltrch\fcs0 \insrsid3687373\charrsid9717868 \cell }\pard\plain \ltrpar\s15\ql \li0\ri0\sl240\slmult0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid3687373\contextualspace \rtlch\fcs1 \af0\afs22\alang1025 \ltrch\fcs0 
\f37\fs22\lang1055\langfe1033\cgrid\langnp1055\langfenp1033 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid9568736 Selami}{\rtlch\fcs1 \af0\afs20 \ltrch\fcs0 \fs20\insrsid3687373\charrsid9717868 \cell }\pard\plain \ltrpar\ql \li0\ri0\sl240\slmult0
\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid3687373 \rtlch\fcs1 \af0\afs22\alang1025 \ltrch\fcs0 \f37\fs22\lang1055\langfe1033\cgrid\langnp1055\langfenp1033 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid9568736 Selami}{
\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid3687373\charrsid9717868 \cell }{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid9568736 Selami}{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid3687373\charrsid9717868 \cell }{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid9568736 Selami}{
\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid3687373\charrsid9717868 \cell }{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid9568736 Selami}{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid3687373\charrsid9717868 \cell }{\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid9568736 Selami}{
\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid3687373\charrsid9717868 \cell }\pard \ltrpar\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\rtlch\fcs1 \af0 \ltrch\fcs0 \insrsid3687373\charrsid9717868 
\trowd \irow2\irowband2\lastrow \ltrrow\ts11\trgaph108\trrh540\trleft-108\trbrdrt\brdrs\brdrw10\brdrcf1 \trbrdrl\brdrs\brdrw10\brdrcf1 \trbrdrb\brdrs\brdrw10\brdrcf1 \trbrdrr\brdrs\brdrw10\brdrcf1 \trbrdrh\brdrs\brdrw10\brdrcf1 \trbrdrv
\brdrs\brdrw10\brdrcf1 \trftsWidth3\trwWidth9839\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tbllkhdrrows\tbllkhdrcols\tbllknocolband\tblind0\tblindtype3 \clvertalb\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl
\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth648\clshdrawnil \cellx540\clvertalb\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr
\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth5116\clshdrawnil \cellx5656\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 
\cltxlrtb\clftsWidth3\clwWidth749\clshdrawnil \cellx6405\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth806\clshdrawnil \cellx7211
\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth791\clshdrawnil \cellx8002\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl
\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth791\clshdrawnil \cellx8793\clvertalt\clbrdrt\brdrs\brdrw10\brdrcf1 \clbrdrl\brdrs\brdrw10\brdrcf1 \clbrdrb\brdrs\brdrw10\brdrcf1 \clbrdrr
\brdrs\brdrw10\brdrcf1 \cltxlrtb\clftsWidth3\clwWidth938\clshdrawnil \cellx9731\row }\pard \ltrpar\qc ';

$tablo=$onek."aileegitimi";
$sql="select `programicerigimadde`, `cokyararli`, `yararli`, `yararliolmadi`, `hicyararliolmadi`, `toplam` from $tablo where kurumkodu=$kurumkodu order by sn";
$sorgu=$veritabani->query("$sql");
$toplamalan=6;
$degis="aile_egitimi";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";


//ogrenci verileri

$tablo=$onek."degerlendirme";
$sql="select `subesayisisinif4`, `subesayisisinif6`, `subesayisisinif9`, `kizsinif4`, `erkeksinif4`, `kizsinif6`, `erkeksinif6`, `kizsinif9`, `erkeksinif9`, `kiztoplam`, `erkektoplam` from $tablo where kurumkodu=$kurumkodu order by sn";
$sorgu=$veritabani->query("$sql");
$toplamalan=12-1;
$degis="Og_v";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=0;$i<$toplamalan;$i++){
	  
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik


//yönetici-öðretmen

$tablo=$onek."degerlendirme_yoneticiogretmen";
$sql="select `YOegitimsayisi`,`YOkatilimcisayisi` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=2;
$degis="yo_sa";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=0;$i<$toplamalan;$i++){
	  
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik

//AÝLE EÐÝTÝMÝ
$tablo=$onek."degerlendirme_aileegitimi";
$sql="select `AEegitimsayisi`,`AEkatilimcisayisi` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=2;
$degis="ae_sa";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=0;$i<$toplamalan;$i++){
	  
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik


//açýklama

$tablo=$onek."degerlendirme_aciklama";
$sql="select `aciklama` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=1;
$degis="degerlendir_me";
if ($sorgu){
	while ($sonuc=$sorgu->fetch_array())
	{
		for ($i=0;$i<$toplamalan;$i++){
          $sonuc[$i]= preg_replace ("/\r\n|\n\r|\n|\r/","\par ",$sonuc[$i]);
		$content = preg_replace("'$degis'", $sonuc[$i],$content,1);   
	  
		}
	}
}
$content = str_ireplace($degis," ",$content); //temizlik

//okul ismi
$degis="okul_ismi";
$content = str_replace($degis, strtoupperTR($okulunadi),$content);   

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
?>