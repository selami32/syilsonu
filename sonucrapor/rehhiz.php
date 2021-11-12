<?php

//$obxl = PHPExcel_IOFactory::load("rehberogretmenraportaslak.xls");
/** Load $inputFileName to a PHPExcel Object  **/

$tablo=$onek."rehhiz";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}

//Ya Âlîm Yâ Allah
$sorgu="select sum(`ogrencigorusmelerianaokulu`),	sum( `veligorusmelerianaokulu`),	sum( `aileveliziyaretlerianaokulu`),	sum( `bireyselpsikolojikdanismaanaokulu`),	sum( `bireyselegitselrehberlikanaokulu`),	sum( `bireyselmeslekirehberlikanaokulu`),	sum( `gruppsikolojigrupsayisianaokulu`),	sum( `gruppsikolojiogrencisayisianaokulu`),	sum( `gruplaegitselgrupsayisianaokulu`),	sum( `gruplaegitselogrencisayisianaokulu`),	sum( `gruplameslekigrupsayisianaokulu`),	sum( `gruplameslekiogrencisayisianaokulu`),	sum( `ogrencigorusmeleriilkokul`),	sum( `veligorusmeleriilkokul`),	sum( `aileveliziyaretleriilkokul`),	sum( `bireyselpsikolojikdanismailkokul`),	sum( `bireyselegitselrehberlikilkokul`),	sum( `bireyselmeslekirehberlikilkokul`),	sum( `gruppsikolojigrupsayisiilkokul`),	sum( `gruppsikolojiogrencisayisiilkokul`),	sum( `gruplaegitselgrupsayisiilkokul`),	sum( `gruplaegitselogrencisayisiilkokul`),	sum( `gruplameslekigrupsayisiilkokul`),	sum( `gruplameslekiogrencisayisiilkokul`),	sum( `ogrencigorusmeleriortaokul`),	sum( `veligorusmeleriortaokul`),	sum( `aileveliziyaretleriortaokul`),	sum( `bireyselpsikolojikdanismaortaokul`),	sum( `bireyselegitselrehberlikortaokul`),	sum( `bireyselmeslekirehberlikortaokul`),	sum( `gruppsikolojigrupsayisiortaokul`),	sum( `gruppsikolojiogrencisayisiortaokul`),	sum( `gruplaegitselgrupsayisiortaokul`),	sum( `gruplaegitselogrencisayisiortaokul`),	sum( `gruplameslekigrupsayisiortaokul`),	sum( `gruplameslekiogrencisayisiortaokul`),	sum( `ogrencigorusmelerilise`),	sum( `veligorusmelerilise`),	sum( `aileveliziyaretlerilise`),	sum( `bireyselpsikolojikdanismalise`),	sum( `bireyselegitselrehberliklise`),	sum( `bireyselmeslekirehberliklise`),	sum( `gruppsikolojigrupsayisilise`),	sum( `gruppsikolojiogrencisayisilise`),	sum( `gruplaegitselgrupsayisilise`),	sum( `gruplaegitselogrencisayisilise`),	sum( `gruplameslekigrupsayisilise`),	sum( `gruplameslekiogrencisayisilise`) from $tablo $ilcesorgu";
$sonuc=$veritabani->query($sorgu);
$satirno=6;
$satir=$sonuc->fetch_array();
$ekleme=array(0,12,24,36);


for ($i=0;$i<4;$i++){		
		$satirno=$i+6;
		for ($y=0;$y<12;$y++){			
			$obxl->setActiveSheetIndexByName('Rehhiz')				  
				  ->setCellValue(chr(66+$y).$satirno, $satir[$y+$ekleme[$i]]);
		}	  
}


$styleArray = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'F0000000'),
		),
	),
);

//$sheet=$obxl->setActiveSheetIndexByName("okullar");
//$sheet->getStyle("A4:C$satirno")->applyFromArray($styleArray);



?>