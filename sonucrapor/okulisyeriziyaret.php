<?php


$tablo=$onek."okulisyeriziyaret";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}


//Ya Âlîm Yâ Allah


    $sorgu="select sum(`genellisesayisi`), count(`genellisesayisi`),	sum( `genelliseogrencisayisi`), count( `genelliseogrencisayisi`),	sum( `anadolufensayisi`), count( `anadolufensayisi`),	sum( `anadolufenogrencisayisi`), count( `anadolufenogrencisayisi`),	sum( `anadoluguzelsanatlarsayisi`), count( `anadoluguzelsanatlarsayisi`),	sum( `anadoluguzelsanatlarogrencisayisi`), count( `anadoluguzelsanatlarogrencisayisi`),	sum( `sosyalbilimlersayisi`), count( `sosyalbilimlersayisi`),	sum( `sosyalbilimlerogrencisayisi`), count( `sosyalbilimlerogrencisayisi`),	sum( `mesleklisesisayisi`), count( `mesleklisesisayisi`),	sum( `mesleklisesiogrencisayisi`), count( `mesleklisesiogrencisayisi`),	sum( `meslekdanismamerkezisayisi`), count( `meslekdanismamerkezisayisi`),	sum( `meslekdanismamerkeziogrencisayisi`), count( `meslekdanismamerkeziogrencisayisi`),	sum( `isyerisayisi`), count( `isyerisayisi`),	sum( `isyeriogrencisayisi`), count( `isyeriogrencisayisi`),	sum( `fakulteyuksekokulsayisi`), count( `fakulteyuksekokulsayisi`),	sum( `fakulteyuksekokulogrencisayisi`), count( `fakulteyuksekokulogrencisayisi`),	sum( `digersayisi`), count( `digersayisi`),	sum( `digerogrencisayisi`), count( `digerogrencisayisi`)     from $tablo $ilcesorgu $okulsorgu";


    $sonuc=$veritabani->query($sorgu);
    //echo $sorgu;
    $satirbaslangic=4;
    $toplamsatir=9;
    $satir=$sonuc->fetch_array();
    $sutunsayisi=4;

    $y=0;
    for ($i=0;$i<$toplamsatir;$i++){		
          $satirno=$i+$satirbaslangic;
              $obxl->setActiveSheetIndexByName('Ziyaretler')				  
                ->setCellValue('B'.$satirno, $satir[$y])
                ->setCellValue('C'.$satirno, $satir[$y+1])
                ->setCellValue('D'.$satirno, $satir[$y+2])
                ->setCellValue('E'.$satirno, $satir[$y+3])
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