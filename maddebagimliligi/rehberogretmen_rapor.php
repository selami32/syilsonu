<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET['kurumkodu'];
$okulunadi=$_GET["okulunadi"];


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

/** Include PHPExcel_IOFactory */
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';


//$obxl = PHPExcel_IOFactory::load("rehberogretmenraportaslak.xls");
$dosya="rehberogretmenraportaslak.xls";
$objReader = new PHPExcel_Reader_Excel5();
//    $objReader = new PHPExcel_Reader_Excel2007();
//    $objReader = new PHPExcel_Reader_Excel2003XML();
//    $objReader = new PHPExcel_Reader_OOCalc();
//    $objReader = new PHPExcel_Reader_SYLK();
//    $objReader = new PHPExcel_Reader_Gnumeric();
//    $objReader = new PHPExcel_Reader_CSV();
/** Load $inputFileName to a PHPExcel Object  **/
$obxl = $objReader->load($dosya);

$sorguek="";
if ($kurumkodu!=''){

$sorguek=" where kurumkodu=$kurumkodu";
}
$sorgu="select * from ".$onek."rehberogretmen $sorguek";
$sonuc=$veritabani->query($sorgu);
$satirno=3;
$okulunadi=trUpper($okulunadi);
$obxl->setActiveSheetIndex(0)
    ->setCellValue('A1', iutf("$okulunadi "."REHBER жаRETMEN BнLGнLERн"));
$sayfam=$obxl->setActiveSheetIndex(0) ;

while ($satir=$sonuc->fetch_assoc()){
 $satirno++;
 
$obxl->setActiveSheetIndex(0)
      ->setCellValue('A'.$satirno, $satirno-3)
      ->setCellValue('B'.$satirno, $satir['tckimlik'])
      ->setCellValue('C'.$satirno, iutf($satir['adisoyadi']))
      ->setCellValue('D'.$satirno, iutf($satir['eposta']))
      ->setCellValue('E'.$satirno, iutf($satir['gorevunvani']))
      ->setCellValue('F'.$satirno, iutf($satir['gorevyeri']))
      ->setCellValue('G'.$satirno, iutf($satir['ceptelefonu']))
      ->setCellValue('H'.$satirno, iutf($satir['okulturu']))
      ->setCellValue('I'.$satirno, iutf($satir['ili']))
      ->setCellValue('J'.$satirno, iutf($satir['ilcesi']))
      ->setCellValue('K'.$satirno, $satir['hizmetsuresi'])
      ->setCellValue('L'.$satirno, evh($satir['TKT-7-11']))
      ->setCellValue('M'.$satirno, evh($satir['TYT-6-8']))
      ->setCellValue('N'.$satirno, evh($satir['TKT-9-11']))
      ->setCellValue('O'.$satirno, evh($satir['risk']))
      ->setCellValue('P'.$satirno, evh($satir['psikososyal']))
      ->setCellValue('Q'.$satirno, evh($satir['7-19aile']))
      ->setCellValue('R'.$satirno, iutf($satir['diger']))
      ->getRowDimension($satirno)->setRowHeight(-1)
      ;
      $sayfam->getStyle('C'.$satirno)->getAlignment()->setWrapText(true);
      $sayfam->getStyle('F'.$satirno)->getAlignment()->setWrapText(true);
      $sayfam->getStyle('D'.$satirno)->getAlignment()->setWrapText(true);
      $sayfam->getStyle('E'.$satirno)->getAlignment()->setWrapText(true);
      $sayfam->getStyle('G'.$satirno)->getAlignment()->setWrapText(true);
      $sayfam->getStyle('R'.$satirno)->getAlignment()->setWrapText(true);
      
      
   

      $dsorgu="select * from  ".$onek."rehberogretmen_egitimler where tckimlik=".$satir['tckimlik'];
      $dsonuc=$veritabani->query($dsorgu);
      $veregitimler='';
      if ($dsonuc){
          while ($dsatir=$dsonuc->fetch_assoc()){
                 $veregitimler=$veregitimler.$dsatir['verebilecegiegitimler'].chr(10);
          }
      $obxl->setActiveSheetIndex(0)      
            ->setCellValue('S'.$satirno, iutf(substr($veregitimler,0,-1)))
            ->getStyle('S'.$satirno)->getAlignment()->setWrapText(true);
            


      }
}
//Ya Тlюm Yт Allah

$styleArray = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'F0000000'),
        ),
      ),
    );
    
    
		$sayfam->getStyle("A4:S$satirno")->applyFromArray($styleArray);
 

$sonuc->close();
$veritabani->close();
$objWriter = PHPExcel_IOFactory::createWriter($obxl, 'Excel5');

$indirilecekdosya="rehberogretmen_rapor.xls";
header("Content-Disposition: attachment; filename=" . urlencode($indirilecekdosya));    
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");             
//header("Content-Length: " . 16666);
flush(); // this doesn't really matter.


//$objWriter->save(str_replace('.php', '.xls', __FILE__));
$objWriter->save('php://output');

/*$adres="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

$dosyaismi=str_replace('php','xls',$adres);
echo $dosyaismi;*/

?>