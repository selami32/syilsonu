<?php


$tablo=$onek."kaynastirma";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
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
 

$obxl->setActiveSheetIndexByName('kaynastirma');
$sayfam=$obxl->getActiveSheet();
$satirbaslangic=6;
$sorgu="select siniflar,	count(*), 	
sum( `zihinkiz`),	
sum( `zihinerkek`),	
sum( `dehbkiz`),	
sum( `dehberkek`),	
sum( `ustunkiz`),	
sum( `ustunerkek`),	
sum( `gormekiz`),	
sum( `gormeerkek`),	
sum( `ozgulkiz`),	
sum( `ozgulerkek`),	
sum( `isitmekiz`),	
sum( `isitmeerkek`),	
sum( `ortopedikiz`),	
sum( `ortopedierkek`),	
sum( `konusmakiz`),	
sum( `konusmaerkek`),	
sum( `spastikkiz`),	
sum( `spastikerkek`),	
sum( `otistikkiz`),	
sum( `otistikerkek`),
sum( `birdenfazlakiz`),	
sum( `birdenfazlaerkek`)

from $tablo $ilcesorgu $okulsorgu GROUP BY siniflar ORDER BY sn";

$sonuc=$veritabani->query($sorgu);

	if ($sonuc){

		
          
            $i=0;	
            while ($satir=$sonuc->fetch_array()){
          
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('A'.$satirno, iutf($satir['siniflar']))
                    ->setCellValue('B'.$satirno, $satir[1])
                    ->setCellValue('C'.$satirno, $satir[2])
                    ->setCellValue('D'.$satirno, $satir[3])
                    ->setCellValue('E'.$satirno, $satir[4])
                    ->setCellValue('F'.$satirno, $satir[5])
                    ->setCellValue('G'.$satirno, $satir[6])
                    ->setCellValue('H'.$satirno, $satir[7])
                    ->setCellValue('I'.$satirno, $satir[8])
                    ->setCellValue('J'.$satirno, $satir[9])
                    ->setCellValue('K'.$satirno, $satir[10])
                    ->setCellValue('L'.$satirno, $satir[11])
                    ->setCellValue('M'.$satirno, $satir[12])
                    ->setCellValue('N'.$satirno, $satir[13])
                    ->setCellValue('O'.$satirno, $satir[14])
                    ->setCellValue('P'.$satirno, $satir[15])
                    ->setCellValue('Q'.$satirno, $satir[16])
                    ->setCellValue('R'.$satirno, $satir[17])
                    ->setCellValue('S'.$satirno, $satir[18])
                    ->setCellValue('T'.$satirno, $satir[19])
                    ->setCellValue('U'.$satirno, $satir[20])
                    ->setCellValue('V'.$satirno, $satir[21])
				->setCellValue('W'.$satirno, $satir[22])
                    ->setCellValue('X'.$satirno, $satir[23])
                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            		
		$sayfam->getStyle("A$satirbaslangic:X$satirno")->applyFromArray($styleArray);

		}
	

?>