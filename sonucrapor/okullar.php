<?php

//$obxl = PHPExcel_IOFactory::load("rehberogretmenraportaslak.xls");
/** Load $inputFileName to a PHPExcel Object  **/

$tablo=$onek."okullar";

if ($ilcesi!="-"){
  $ilcesorgu=" and ilcesi='$ilcesi' ";
}

if ($okulturu!="-"){
  $okulsorgu=" and okulturu = '$okulturu' ";
}

$sorgu="select * from $tablo where kurumkodu<>1 $ilcesorgu $okulsorgu ORDER BY girilentablo DESC";

$sonuc=$veritabani->query($sorgu);
$satirno=3;

while ($satir=$sonuc->fetch_assoc()){
 $satirno++;
 
		$obxl->setActiveSheetIndexByName('okullar')
			  ->setCellValue('A'.$satirno, iutf($satir["ilcesi"]))
			  ->setCellValue('B'.$satirno, iutf($satir['okulunadi']))
			  ->setCellValue('C'.$satirno, iutf($satir['girilentablo']))      
			  ->getRowDimension($satirno)->setRowHeight(-1);
}
//Ya Âlîm Yâ Allah
$styleArray = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'F0000000'),
		),
	),
);

$sheet=$obxl->setActiveSheetIndexByName("okullar");
$sheet->getStyle("A4:C$satirno")->applyFromArray($styleArray);



?>