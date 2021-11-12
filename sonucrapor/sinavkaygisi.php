<?php


$tablo=$onek."sinavkaygisi";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" AND (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}

//Ya Âlîm Yâ Allah
$sorguseti=array(
"(okulturu = 'ilkokul' or okulturu = 'ortaokul')",
"okulturu = 'lise'"
);

for ($x=0;$x<count($sorguseti);$x++){
    $sorgu="select sum(`sinavlarhkbilgiverilenilkogretimogrencisayisi`), count(`sinavlarhkbilgiverilenilkogretimogrencisayisi`),	sum( `sinavlarhkbilgiverilenilkogretimogretmensayisi`), count( `sinavlarhkbilgiverilenilkogretimogretmensayisi`),	sum( `sinavlarhkbilgiverilenilkogretimailesayisi`), count( `sinavlarhkbilgiverilenilkogretimailesayisi`),	sum( `sinavlarhkbilgiverilenilkogretimmahallibasin`), count( `sinavlarhkbilgiverilenilkogretimmahallibasin`),	sum( `ustogretimhkbilgiverilenilkogretimogrencisayisi`), count( `ustogretimhkbilgiverilenilkogretimogrencisayisi`),	sum( `ustogretimhkbilgiverilenilkogretimogretmensayisi`), count( `ustogretimhkbilgiverilenilkogretimogretmensayisi`),	sum( `ustogretimhkbilgiverilenilkogretimailesayisi`), count( `ustogretimhkbilgiverilenilkogretimailesayisi`),	sum( `ustogretimhkbilgiverilenilkogretimmahallibasin`), count( `ustogretimhkbilgiverilenilkogretimmahallibasin`),	sum( `sinavkaygisibilgiverilenilkogretimogrencisayisi`), count( `sinavkaygisibilgiverilenilkogretimogrencisayisi`),	sum( `sinavkaygisibilgiverilenilkogretimogretmensayisi`), count( `sinavkaygisibilgiverilenilkogretimogretmensayisi`),	sum( `sinavkaygisibilgiverilenilkogretimailesayisi`), count( `sinavkaygisibilgiverilenilkogretimailesayisi`),	sum( `sinavkaygisibilgiverilenilkogretimmahallibasin`), count( `sinavkaygisibilgiverilenilkogretimmahallibasin`)
 from $tablo where $sorguseti[$x] $ilcesorgu";


    $sonuc=$veritabani->query($sorgu);
    $satirbaslangic=6;
    $toplamsatir=3;
    if ($sonuc) $satir=$sonuc->fetch_array();
    $sutunsayisi=8;

    $y=0;
    for ($i=0;$i<$toplamsatir;$i++){		
          $satirno=$i+$satirbaslangic;
          switch ($x){
            case 0:
              $obxl->setActiveSheetIndexByName('sinavkaygisi')				  
                ->setCellValue('B'.$satirno, $satir[$y])
                ->setCellValue('C'.$satirno, $satir[$y+1])
                ->setCellValue('D'.$satirno, $satir[$y+2])
                ->setCellValue('E'.$satirno, $satir[$y+3])
                ->setCellValue('F'.$satirno, $satir[$y+4])
                ->setCellValue('G'.$satirno, $satir[$y+5])
                ->setCellValue('H'.$satirno, $satir[$y+6])
                ->setCellValue('I'.$satirno, $satir[$y+7])
                ;              
              $y=$y+$sutunsayisi;
              break;
             case 1:
              $obxl->setActiveSheetIndexByName('sinavkaygisi')				  
                ->setCellValue('J'.$satirno, $satir[$y])
                ->setCellValue('K'.$satirno, $satir[$y+1])
                ->setCellValue('L'.$satirno, $satir[$y+2])
                ->setCellValue('M'.$satirno, $satir[$y+3])
                ->setCellValue('N'.$satirno, $satir[$y+4])
                ->setCellValue('O'.$satirno, $satir[$y+5])
                ->setCellValue('P'.$satirno, $satir[$y+6])
                ->setCellValue('Q'.$satirno, $satir[$y+7])
                ;              
              $y=$y+$sutunsayisi;
              break;
            }

    }

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