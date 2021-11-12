<?php


$tablo=$onek."aileegitimi";
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
 

$obxl->setActiveSheetIndexByName('aileegitimi');
$sayfam=$obxl->getActiveSheet();
$satirbaslangic=4;
$sorgu="select programicerigimadde,
sum( `cokyararli`),	
sum( `yararli`),	
sum( `yararliolmadi`),	
sum( `hicyararliolmadi`),	
sum( `toplam`)

from $tablo $ilcesorgu $okulsorgu GROUP BY programicerigimadde ORDER BY sn";

$sonuc=$veritabani->query($sorgu);

	if ($sonuc){

		
          
            $i=0;	
            while ($satir=$sonuc->fetch_array()){
          
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('A'.$satirno, iutf($satir['programicerigimadde']))
                    ->setCellValue('B'.$satirno, $satir[1])
                    ->setCellValue('D'.$satirno, $satir[2])
                    ->setCellValue('F'.$satirno, $satir[3])
                    ->setCellValue('H'.$satirno, $satir[4])
                    ->setCellValue('J'.$satirno, $satir[5])                    
                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            		
		$sayfam->getStyle("A$satirbaslangic:k$satirno")->applyFromArray($styleArray);

		}
	

?>