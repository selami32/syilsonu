<?php
session_start();
include "baglanti.php";
include "veritabani.php";
$rp=$_GET["rp"];
if ($rp!="") $onek=$rp."_";

$tablo=$onek."okullar";

$kurumkodu=trim($_POST["kurumkodu"]);
$sifre=trim($_POST["sifre"]);

$hata=iconv('iso-8859-9','UTF-8','{"error":"Kurum kodu  yada þifreniz hatalýdýr.","success":"true"}');
$tamamdir='{"success":"true"}';

if ($kurumkodu=="" or $sifre=="")  { 
	die($hata);
}


$sorgu="select * from $tablo where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($sorgu);
if($okulsonuc){
	$satir=$okulsonuc->fetch_assoc() or die ($hata);
	$kayitlisifre=$satir['parola'];
	if ($kayitlisifre=='12345'){
      $hata=iconv('iso-8859-9','UTF-8','{"error":"Teknik hatadan dolayý þifreniz 12345 olarak belirlenmiþtir. <br> Lütfen 12345 girerek deneyin.","success":"true"}');
	}
}

if (iconv('UTF-8','iso-8859-9',$sifre)==$kayitlisifre){	
	echo $tamamdir;	
    $_SESSION["login"] = "true";
}else{
	echo $hata ;
}



?>