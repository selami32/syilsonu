<?php
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

$tablolar=array(
 $onek."etkinliklerv2",
 $onek."etkinliklerv2_ekbilgi",
 $onek."okullar",
 $onek."rehberogretmen",
 $onek."rehberogretmen_egitimler"
 );
$sonuc=array_search($tablo, $tablolar);
if ($sonuc===false) die("tablo ismi yanlis:$tablo");

$gonderilenSQL=$_POST['gonderkutusu'];
$kurumkodu=$_POST['kurumkodu'];
$ajax=$_POST['ajax'];
$sifre=$_POST['sifre'];
$adisoyadi=$_POST['adisoyadi'];


$gonderilenSQL=str_replace("\\","", $gonderilenSQL);
$gonderilenSQL=str_replace("delete","", $gonderilenSQL);
$gonderilenSQL=str_replace("drop","", $gonderilenSQL);
$gonderilenSQL=str_replace(";","", $gonderilenSQL);

if ($gonderilenSQL=="okulbilgisil"){
	
	$tablolar=explode(",", $sifre);

	for ($i=0;$i<count($tablolar);$i++){
		$sql="delete from ".$tablolar[$i] ." where kurumkodu='$kurumkodu'";
		$veritabani->query($sql);
		//echo $sql;
	}
	$sql="update ".$onek."okullar set girilentablo=0 where kurumkodu=$kurumkodu";
	$veritabani->query($sql);
	if ( $veritabani->error) {
		die($veritabani->error);
	}else{
		die(iutf("Bilgiler silindi","utf"));
	}

}

if($ajax=="evet") $gonderilenSQL=iutf($gonderilenSQL,"iso");
//echo $gonderilenSQL;

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

case $onek."rehberogretmen":

    $sql="delete from $tablo where adisoyadi='".iutf($adisoyadi,"iso")."';";
    $veritabani->query("$sql");
    $veritabani->query($gonderilenSQL);
      break;
case $onek."rehberogretmen_egitimler":
    $sql="delete from $tablo where tckimlik='$kurumkodu'";
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
      $veritabani->query("$gonderilenSQL");
}		


 $tablolar=array(
 $onek.'rehberogretmen',
 $onek.'etkinliklerv2'
  );
 $dolutablo=0;

for ($y=0; $y < count($tablolar); $y++){
  $sorgu="select * from $tablolar[$y] where kurumkodu=$kurumkodu";
  $sonuc=$veritabani->query($sorgu);
    if ($sonuc){
      if ($sonuc->num_rows>0){
          $dolutablo++;		
      }
    } ;

}

$sorgu="update ".$onek."okullar SET girilentablo = '$dolutablo' where kurumkodu=$kurumkodu";
$veritabani->query($sorgu);	


//echo iconv("UTF-8", "iso-8859-9",$gonderilenSQL);


if ( $veritabani->error) {
	echo  $veritabani->error;
}else{
	echo iutf("Deðiþiklikler Kayýt Edildi","utf");
}
?>


