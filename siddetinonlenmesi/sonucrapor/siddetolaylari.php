<?php

// Y? ?l?m Y? Allah
$tablo=$onek."siddetolaylari";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}

$sorgu="select (select concat(ilcesi, ' ',okulunadi) from $onek"."okullar where $onek"."okullar.kurumkodu=$tablo.kurumkodu) as okulismi, 
$tablo.olaysayisi, 
$tablo.konu, 
$tablo.karisanogrencisayisi, 
$tablo.yapilancalismalar 
from $tablo  $ilcesorgu $okulsorgu ORDER BY okulismi";

//echo $sorgu;
$sonuc=$veritabani->query($sorgu);
$satirno=3;

$sheet=$obxl->setActiveSheetIndexByName("siddetolaylari");

if ($sonuc){
	while ($satir=$sonuc->fetch_assoc()){

			
						
			$sheet->setCellValue('A'.$satirno, iutf($satir["okulismi"]))
            ->setCellValue('B'.$satirno, iutf($satir["konu"]))
            ->setCellValue('C'.$satirno, iutf($satir['olaysayisi']))	
            ->setCellValue('D'.$satirno, iutf($satir['karisanogrencisayisi']))	
            ->setCellValue('E'.$satirno, iutf($satir['yapilancalismalar']))	
            ;

			$sheet->getStyle('A'.$satirno)->getAlignment()->setWrapText(true);
			$sheet->getStyle('B'.$satirno)->getAlignment()->setWrapText(true);
			$sheet->getStyle('D'.$satirno)->getAlignment()->setWrapText(true);
			$sheet->getStyle('E'.$satirno)->getAlignment()->setWrapText(true);
			$sheet->getRowDimension($satirno)->setRowHeight(-1);
			$satirno++;
	}
}
//Ya ?l?m Y? Allah
$styleArray = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'F0000000'),
		),
	),
);
$satirno--;

$sheet->getStyle("A3:E$satirno")->applyFromArray($styleArray);



?>