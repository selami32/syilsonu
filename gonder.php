<?php
session_start();
if(!isset($_SESSION["login"])){

echo "Bu sayfayý görüntüleme yetkiniz yoktur.";
session_destroy();
die();
}
include 'baglanti.php';
include 'veritabani.php';

function iutf($deger,$hangiyone){

  if ($hangiyone=="utf"){
    return iconv("iso-8859-9","utf-8",$deger);
  }else{
    return iconv("utf-8","iso-8859-9",$deger);
  }

}

$gonderilenSQL=$_POST['gonderkutusu'];
$kurumkodu=$_POST['kurumkodu'];
$ajax=$_POST['ajax'];
$sifre=$_POST['sifre'];
$adisoyadi=$_POST['adisoyadi'];
$tablo=$_POST['tablo'];

$tablolar=array(
'arastirma',
'degerlendirme',
'etkinlikler',
'hizmetici',
'isbirligi',
'kaynastirma',
'meslekirehberlik',
'ogrencidavranislari',
'okulbilgileri',
'okulisyeriziyaret',
'okullar',
'olcmearaclari',
'psikomudahale',
'rehberlikservisi',
'rehhiz',
'sinavkaygisi',
'sorunalan',
'toplanti',
'rehberogretmen',
'rehberogretmen_egitimler',
'ozelegitim_ekbilgi',
'ozelegitim'
);

for($i=0;$i<count($tablolar);$i++){
	$tablolar[$i]=$onek.$tablolar[$i];
}

if($ajax=="evet") $gonderilenSQL=iutf($gonderilenSQL,"iso");

switch ($sifre){
case "evet":
	$sql="UPDATE $tablo SET parola='$gonderilenSQL' where kurumkodu='$kurumkodu'";
	$veritabani->query("$sql");
	if ($veritabani->error){
		die($veritabani->error);
	}else{
		die(iutf("Þifre baþarýyla deðiþtirildi","utf"));
	}
  break;
case "satirsil":
  $sql="delete from $tablo where kurumkodu=$kurumkodu";
  $veritabani->query($sql);
	if ($veritabani->error){
		die($veritabani->error);
	}else{
    $adisoyadi=iutf($adisoyadi,"iso");
    die(iutf(" \"$adisoyadi\" veritabanýndan silindi!","utf"));
	}
  break;
}

if ($gonderilenSQL=="temizle"){

	for ($i=0;$i<count($tablolar);$i++){
		$sql="TRUNCATE ".$tablolar[$i].";";
		if ($tablolar[$i]!=$onek."okullar"){
			$veritabani->query($sql);
			
		}
	}
	$sql="UPDATE $tablo SET girilentablo='0' WHERE kurumkodu <> 1";
	$veritabani->query($sql);
	echo($veritabani->error);
	die(iutf("Temizlik tamamlandý sayfayý yenileyiniz.","utf"));
}

$sonuc=array_search($tablo, $tablolar);
if ($sonuc===false) die("tablo ismi yanlis:$tablo");
$sonuc=strpos($gonderilenSQL,$tablo);
if ($sonuc===false) die("tablo ismi yanlis:$tablo");


$gonderilenSQL=str_replace("/*","", $gonderilenSQL);
$gonderilenSQL=str_replace("//","", $gonderilenSQL);
$gonderilenSQL=str_replace("--","-", $gonderilenSQL);
$gonderilenSQL=str_replace("\\","", $gonderilenSQL);
$gonderilenSQL=str_replace("delete","", $gonderilenSQL);
$gonderilenSQL=str_replace("drop","", $gonderilenSQL);
$gonderilenSQL=str_replace(";","", $gonderilenSQL);
$gonderilenSQL=str_replace("truncate","", $gonderilenSQL);




//echo $gonderilenSQL;


/*
$test=$veritabani->query("DESCRIBE  ".$gonderilenSQL);

if ($veritabani->error){
  die(iutf("Sorguda hata bulunuyor:".$veritabani->error,"utf"));
}
*/


switch ($tablo) {
case $onek."rehberogretmen":
        $sql="delete from $onek"."rehberogretmen where adisoyadi='".iutf($adisoyadi,"iso")."'";
          $veritabani->query("$sql");

         $veritabani->query("$gonderilenSQL");
         
        break;


case $onek."rehberogretmen_egitimler":
        $sql="delete from $onek"."rehberogretmen_egitimler where adisoyadi='".iutf($kurumkodu,"iso")."'";
        
          $veritabani->query("$sql");
          $veritabani->query("$gonderilenSQL");
         
        break;
default:
    if ($kurumkodu=="1") {
     $gonderilenSQL=str_replace("INSERT","REPLACE", $gonderilenSQL);
     
    }else{
      $sql="delete from $tablo where kurumkodu='$kurumkodu'";
      $veritabani->query("$sql");
    }

      
      $veritabani->query("$gonderilenSQL");
}		
		


//echo iconv("UTF-8", "iso-8859-9",$gonderilenSQL);


if ( $veritabani->error) {
	echo  $veritabani->error;
	
}else{
	echo iutf("Deðiþiklikler Kayýt Edildi","utf");
}

$veritabani->close();

?>


