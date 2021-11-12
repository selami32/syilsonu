<?php
/*session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}*/

$adres=$_GET["ad"];
include "baglanti.php";
include "veritabani.php";
set_time_limit(0); 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

function iutf($metin){
  return iconv('iso-8859-9','utf-8',$metin);
}

function evh($metin){
  if ($metin=="true") {return "X";} else {return "";}
}

date_default_timezone_set('Europe/London');

require_once '../PHPExcel/Classes/PHPExcel/IOFactory.php';
//$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_serialized;
$ilcesorgu="";
$okulsorgu="";

//$ilcesi=$_GET["ilcesi"];
//$okulturu=$_GET["okulturu"];
$kurumkodu=$_GET["kurumkodu"];

$ilcesi="";
$okulturu="";
// $kurumkodu=738636;


$dosya="risk_rapor.xls";
$objReader = new PHPExcel_Reader_Excel5();
$obxl = $objReader->load($dosya);

include "risk_okulrapor.php";

$obxl->setActiveSheetIndexByName('riskrapor');
if ($sonuc) $sonuc->close();

$veritabani->close();
$objWriter = PHPExcel_IOFactory::createWriter($obxl, 'Excel5');

$indirilecekdosya="riskokulrapor.xls";
header("Content-Disposition: attachment; filename=" . urlencode($indirilecekdosya));    
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");             
//header("Content-Length: " . 16666);
flush(); // this doesn't really matter.


//$objWriter->save(str_replace('.php', '.xls', __FILE__));
$objWriter->save('php://output');

?>
