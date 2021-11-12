<?php


$tablo=$onek."psikomudahale";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}

//Ya Âlîm Yâ Allah


    $sorgu="select sum(`anaokulupsikoegitim`),	sum(`ilkokulpsikoegitim`),	sum(`ortaokulpsikoegitim`),	sum(`lisepsikoegitim`),	sum(`ogretmenpsikoegitim`),	sum(`yoneticipsikoegitim`),	sum(`ogrencisayisipsikoegitim`),	sum(`velisayisipsikoegitim`), count(*),	sum(`psikolojikdanismanpsikoegitim`),	sum(`anaokulupsikolojikbilgilenidirme`),	sum(`ilkokulpsikolojikbilgilenidirme`),	sum(`ortaokulpsikolojikbilgilenidirme`),	sum(`lisepsikolojikbilgilenidirme`),	sum(`ogretmenpsikolojikbilgilenidirme`),	sum(`yoneticipsikolojikbilgilenidirme`),	sum(`ogrencisayisipsikolojikbilgilenidirme`),	sum(`velisayisipsikolojikbilgilenidirme`),	sum(`psikolojikdanismanpsikolojikbilgilenidirme`),	count(*), sum(`anaokulugruplapsikolojik`),	sum(`ilkokulgruplapsikolojik`),	sum(`ortaokulgruplapsikolojik`),	sum(`lisegruplapsikolojik`),	sum(`ogretmengruplapsikolojik`),	sum(`yoneticigruplapsikolojik`),	sum(`ogrencisayisigruplapsikolojik`),	sum(`velisayisigruplapsikolojik`),	sum(`psikolojikdanismangruplapsikolojik`),count(*), 	sum(`anaokuluhayatasahipcikma`),	sum(`ilkokulhayatasahipcikma`),	sum(`ortaokulhayatasahipcikma`),	sum(`lisehayatasahipcikma`),	sum(`ogretmenhayatasahipcikma`),	sum(`yoneticihayatasahipcikma`),	sum(`ogrencisayisihayatasahipcikma`),	sum(`velisayisihayatasahipcikma`),	sum(`psikolojikdanismanhayatasahipcikma`),	count(*), sum(`anaokuluaileegitimi`),	sum(`ilkokulaileegitimi`),	sum(`ortaokulaileegitimi`),	sum(`liseaileegitimi`),	sum(`ogretmenaileegitimi`),	sum(`yoneticiaileegitimi`),	sum(`ogrencisayisiaileegitimi`),	sum(`velisayisiaileegitimi`),	sum(`psikolojikdanismanaileegitimi`),	count(*), sum(`anaokulutemelonleme`),	sum(`ilkokultemelonleme`),	sum(`ortaokultemelonleme`),	sum(`lisetemelonleme`),	sum(`ogretmentemelonleme`),	sum(`yoneticitemelonleme`),	sum(`ogrencisayisitemelonleme`),	sum(`velisayisitemelonleme`),	sum(`psikolojikdanismantemelonleme`),	count(*)
from $tablo $ilcesorgu $okulsorgu ";


    $sonuc=$veritabani->query($sorgu);
    $satirbaslangic=6;
    $toplamsatir=6;
    if ($sonuc) $satir=$sonuc->fetch_array();
    $sutunsayisi=10;

    $y=0;
    for ($i=0;$i<$toplamsatir;$i++){		
          $satirno=$i+$satirbaslangic;
              $obxl->setActiveSheetIndexByName('psikomud')				  
                ->setCellValue('B'.$satirno, $satir[$y])
                ->setCellValue('C'.$satirno, $satir[$y+1])
                ->setCellValue('D'.$satirno, $satir[$y+2])
                ->setCellValue('E'.$satirno, $satir[$y+3])
                ->setCellValue('F'.$satirno, $satir[$y+4])
                ->setCellValue('G'.$satirno, $satir[$y+5])
                ->setCellValue('H'.$satirno, $satir[$y+6])
                ->setCellValue('I'.$satirno, $satir[$y+7])
                ->setCellValue('J'.$satirno, $satir[$y+8])
                ->setCellValue('K'.$satirno, $satir[$y+9])
                ;              
              $y=$y+$sutunsayisi;

    }


/*
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
*/


?>