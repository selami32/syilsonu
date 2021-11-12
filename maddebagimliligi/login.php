 

<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=trim($_POST["kurumkodu"]);
$sifre=trim($_POST["sifre"]);

$hata=iconv('iso-8859-9','UTF-8','{"error":"Kurum kodu  yada þifreniz hatalýdýr.","success":"true"}');
$tamamdir='{"success":"true"}';

if ($kurumkodu=="" or $sifre=="")  { 
die($hata);
}


$sorgu="select * from ".$onek."okullar where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($sorgu);
if($okulsonuc){
$satir=$okulsonuc->fetch_assoc() or die ($hata);
$kayitlisifre=$satir['parola'];
}

if ($sifre==$kayitlisifre){
echo $tamamdir;
}else
{
echo $hata;
}



?>