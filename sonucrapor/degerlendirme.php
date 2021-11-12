<?php

// Yâ Âlîm Yâ Allah
$tablo=$onek."degerlendirme";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}


$sorgu="select * from $tablo $ilcesorgu $okulsorgu";
$sonuc=$veritabani->query($sorgu);
$satirno=4;

$sheet=$obxl->setActiveSheetIndexByName("degerlendirme");

if ($sonuc){
	while ($satir=$sonuc->fetch_assoc()){

			$sorgu="select * from $onek"."okullar where kurumkodu=".$satir['kurumkodu'];
			$okulsonuc=$veritabani->query($sorgu);
			if ($okulsonuc){ $okulsatir=$okulsonuc->fetch_assoc(); $okulismi=$okulsatir["ilcesi"] . " " . $okulsatir["okulunadi"]; }
			
						
			$sheet->setCellValue('A'.$satirno, iutf($okulismi))
				  ->setCellValue('B'.$satirno, iutf($satir["sorunlar"]))
				  ->setCellValue('C'.$satirno, iutf($satir['oneriler']))	;

			$sheet->getStyle('A'.$satirno)->getAlignment()->setWrapText(true);
			$sheet->getStyle('B'.$satirno)->getAlignment()->setWrapText(true);
			$sheet->getStyle('C'.$satirno)->getAlignment()->setWrapText(true);
			$sheet->getRowDimension($satirno)->setRowHeight(-1);
			$satirno++;
	}
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
$satirno--;

$sheet->getStyle("A4:C$satirno")->applyFromArray($styleArray);
$sheet->getStyle("A1")->applyFromArray($styleArray);



?>