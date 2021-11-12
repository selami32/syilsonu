<?php


$tablo=$onek."olcmearaclari";

//Ya Âlîm Yâ Allah
$styleArray = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'F0000000'),
        ),
      ),
    );
 
$sorguseti=array(
"okulturu = 'ilkokul' or okulturu = 'ortaokul'   ",
"okulturu = 'lise' "
);

$obxl->setActiveSheetIndexByName('Olcme');
$sayfam=$obxl->getActiveSheet();
$satirbaslangic=7;
for ($x=0;$x<count($sorguseti);$x++){
	$sorgu="select olcmearaci as olcmear,	sum(subesayisi) as subesayisi, sum(kiz), count(kiz),	sum(erkek),  count(erkek),	sum(toplam),count(toplam)
		from $tablo where $sorguseti[$x] GROUP BY olcmear";
	$sonuc=$veritabani->query($sorgu);

	if ($sonuc){

		
		switch ($x){
        case 0:
          
            $i=0;	
            while ($satir=$sonuc->fetch_array()){
          
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('A'.$satirno, iutf($satir[0]))
                    ->setCellValue('B'.$satirno, $satir['subesayisi'])
                    ->setCellValue('C'.$satirno, $satir[2])
                    ->setCellValue('D'.$satirno, $satir[3])
                    ->setCellValue('E'.$satirno, $satir[4])
                    ->setCellValue('F'.$satirno, $satir[5])
                    ->setCellValue('G'.$satirno, $satir[6])
                    ->setCellValue('H'.$satirno, $satir[7])
                    ->getRowDimension($satirno)->setRowHeight(-1)       

                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            $sayfam->getStyle("A7:O$satirno")->applyFromArray($styleArray);
            break;
		
        case 1:
          
            $i=0;	
            while ($satir=$sonuc->fetch_array()){
          
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('I'.$satirno, $satir[1])
                    ->setCellValue('J'.$satirno, $satir[2])
                    ->setCellValue('K'.$satirno, $satir[3])
                    ->setCellValue('L'.$satirno, $satir[4])
                    ->setCellValue('M'.$satirno, $satir[5])
                    ->setCellValue('N'.$satirno, $satir[6])
                    ->setCellValue('O'.$satirno, $satir[7])
                    ->getRowDimension($satirno)->setRowHeight(-1)       

                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            $sayfam->getStyle("A7:O$satirno")->applyFromArray($styleArray);
            break;
		

		}
	}
}


?>