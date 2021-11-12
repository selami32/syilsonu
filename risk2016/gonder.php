<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
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

$tablo=$_POST['tablo'];
$kurumkodu=$_POST['kurumkodu'];
$ajax=$_POST['ajax'];
$sifre=$_POST['sifre'];

$gonderilenSQL=$_POST['gonderkutusu'];

/*
if ($sifre!="evet"){
     $sonuc=strpos($gonderilenSQL,$tablo);
     if ($sonuc==false) die("bir {2} hatasi var ama sebebini soylemem");
}
*/

$tablolar=array(
'ogrencibilgileri',
'anketsorulari',
'okullar'
);

for($i=0;$i<count($tablolar);$i++){
	$tablolar[$i]=$onek.$tablolar[$i];
}

$sonuc=array_search($tablo, $tablolar);
if ($sonuc===false) die("bir {3}$tablo hatasi var ama sebebini soylemem");




$gonderilenSQL=str_replace("--","-", $gonderilenSQL);
$gonderilenSQL=str_replace("\\","", $gonderilenSQL);
$gonderilenSQL=str_replace("delete","", $gonderilenSQL);
$gonderilenSQL=str_replace("truncate","", $gonderilenSQL);
$gonderilenSQL=str_replace("drop","", $gonderilenSQL);
$gonderilenSQL=str_replace(";","", $gonderilenSQL);


if($ajax=="evet") $gonderilenSQL=iutf($gonderilenSQL,"iso");
//echo $gonderilenSQL;
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

if ($sifre=="evet"){
	$sql="UPDATE $tablo SET parola='$gonderilenSQL' where kurumkodu='$kurumkodu'";
	$veritabani->query("$sql");
	if ($veritabani->error){
		die($veritabani->error);
	}else{
		die(iutf("Þifre baþarýyla deðiþtirildi","utf"));
	}
}

switch ($tablo) {
case $onek."rehberogretmen_egitimler":
        $sql="delete from $onek"."rehberogretmen_egitimler where adisoyadi='".iutf($kurumkodu,"iso")."'";
        
          $veritabani->query("$sql");
          $veritabani->query("$gonderilenSQL");
         
        break;
default:
    if ($kurumkodu=="1") {
      $sql="truncate $tablo";
    }else{
      $sql="delete from $tablo where kurumkodu='$kurumkodu'";
    }

      $veritabani->query("$sql");
     if ($gonderilenSQL!="") $veritabani->query("$gonderilenSQL");
}		
		


//echo iconv("UTF-8", "iso-8859-9",$gonderilenSQL);


if ( $veritabani->error) {
	echo  $veritabani->error;
	
}else{
	echo iutf("Deðiþiklikler Kayýt Edildi","utf");
}

$veritabani->close();

?>


