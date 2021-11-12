<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}

include "baglanti.php";
include "veritabani.php";
set_time_limit(0); 
//ob_start();
// Yâ Âlîm Yâ Allah.

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
$rakam=0;
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');


function ilerleme($rakam){

global $veritabani, $onek;

  $sql = "update $onek"."okullar set girilentablo = '".$rakam."' where kurumkodu=1";
  $veritabani->query($sql);

}

function iutf($metin){
  return iconv('iso-8859-9','utf-8',$metin);
}

function evh($metin){
  if ($metin=="true") {return "X";} else {return "";}
}

date_default_timezone_set('Europe/London');

require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
//$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_serialized;

$dosya="raporprogram.xls";
$objReader = new PHPExcel_Reader_Excel5();
$obxl = $objReader->load($dosya);

$ilcesorgu="";
$okulsorgu="";


//$ilcesi=iconv('utf-8','iso-8859-9',$_GET["ilcesi"]);
//$okulturu=iconv('utf-8','iso-8859-9',$_GET["okulturu"]);


$ilcesi=$_GET["ilcesi"];
$okulturu=$_GET["okulturu"];
//die ($_GET["ilcesi"]);
/*
if ($ilcesi!="-"){
$ilcesorgu=" WHERE ilcesi='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " okulturu='$okulturu' ";
}
*/

$rapordosyalari=array(
'okullar',
'rehhiz',
'sorunalan',
'meslekirehberlik',
'okulisyeriziyaret',
'sinavkaygisi',
'olcmearaclari',
'psikomudahale',
'etkinlikler',
'arastirma',
'isbirligi',
'hizmetici',
'degerlendirme',
'ozelegitim',
'kaynastirma',
'rehberogretmen',
'okuldurum'
);

$artis=100/count($rapordosyalari); // artis yok bazarda
ilerleme(0);

foreach ($rapordosyalari as $rapordosyasi){

  include 'sonucrapor/'.$rapordosyasi.'.php';
  $rakam=$rakam+$artis;
  ilerleme($rakam);

}

$obxl->setActiveSheetIndexByName('okullar');

$objWriter = PHPExcel_IOFactory::createWriter($obxl, 'Excel5');

$indirilecekdosya="toplamrapor.xls";
header("Content-Disposition: attachment; filename=" . urlencode($indirilecekdosya));    
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");             
//header("Content-Length: " . 16666);
flush(); // this doesn't really matter.

//$objWriter->save(str_replace('.php', '.xls', __FILE__));
$objWriter->save('php://output');

ilerleme(0);
//echo $sql;
if ($sonuc) $sonuc->close();
$veritabani->close();

?>

