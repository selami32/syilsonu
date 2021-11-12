<?php


$tablo=$onek."sorunalan";
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
"(okulturu = 'ilkokul' or okulturu = 'ortaokul' or okulturu='okuloncesi')",
"okulturu = 'lise'"
);

for ($x=0;$x<count($sorguseti);$x++){
    $sorgu="select sum(`sagliksorunlarikiz`), count(`sagliksorunlarikiz`),	sum( `sagliksorunlarierkek`), count( `sagliksorunlarierkek`),	sum( `sagliksorunlaritoplam`), count( `sagliksorunlaritoplam`),	sum( `okullailgilisorunlarkiz`), count( `okullailgilisorunlarkiz`),	sum( `okullailgilisorunlarerkek`), count( `okullailgilisorunlarerkek`),	sum( `okullailgilisorunlartoplam`), count( `okullailgilisorunlartoplam`),	sum( `aileilgilisorunlarkiz`), count( `aileilgilisorunlarkiz`),	sum( `aileilgilisorunlarerkek`), count( `aileilgilisorunlarerkek`),	sum( `aileilgilisorunlartoplam`), count( `aileilgilisorunlartoplam`),	sum( `kisiselsorunlarkiz`), count( `kisiselsorunlarkiz`),	sum( `kisiselsorunlarerkek`), count( `kisiselsorunlarerkek`),	sum( `kisiselsorunlartoplam`), count( `kisiselsorunlartoplam`),	sum( `arkadasliksorunlarikiz`), count( `arkadasliksorunlarikiz`),	sum( `arkadasliksorunlarierkek`), count( `arkadasliksorunlarierkek`),	sum( `arkadasliksorunlaritoplam`), count( `arkadasliksorunlaritoplam`),	sum( `sosyoekonomiksorunlarkiz`), count( `sosyoekonomiksorunlarkiz`),	sum( `sosyoekonomiksorunlarerkek`), count( `sosyoekonomiksorunlarerkek`),	sum( `sosyoekonomiksorunlartoplam`), count( `sosyoekonomiksorunlartoplam`),	sum( `digerkiz`), count( `digerkiz`),	sum( `digererkek`), count( `digererkek`),	sum( `digertoplam`), count( `digertoplam`),	sum( `kiztoplam`), count( `kiztoplam`),	sum( `erkektoplam`), count( `erkektoplam`),	sum( `geneltoplam`), count( `geneltoplam`)
    from $tablo where $sorguseti[$x] $ilcesorgu";


    $sonuc=$veritabani->query($sorgu);
    $satirbaslangic=5;
    $toplamsatir=7;
    $satir=$sonuc->fetch_array();
    $sutunsayisi=4;

    $y=0;
    for ($i=0;$i<$toplamsatir;$i++){		
          $satirno=$i+$satirbaslangic;
          switch ($x){
            case 0:
              $obxl->setActiveSheetIndexByName('sorunalan')				  
                ->setCellValue('B'.$satirno, $satir[$y])
                ->setCellValue('C'.$satirno, $satir[$y+1])
                ->setCellValue('D'.$satirno, $satir[$y+2])
                ->setCellValue('E'.$satirno, $satir[$y+3])
                ;              
              $y=$y+$sutunsayisi;
              break;
             case 1:
              $obxl->setActiveSheetIndexByName('sorunalan')				  
                ->setCellValue('F'.$satirno, $satir[$y])
                ->setCellValue('G'.$satirno, $satir[$y+1])
                ->setCellValue('H'.$satirno, $satir[$y+2])
                ->setCellValue('I'.$satirno, $satir[$y+3])
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