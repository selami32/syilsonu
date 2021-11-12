<?php


$tablo=$onek."degerlendirme";
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
 

$obxl->setActiveSheetIndexByName('6.SINIFLAR');
$sayfam=$obxl->getActiveSheet();
$satirbaslangic=4;
$sorgu="select (select okulunadi from $okultablo where kurumkodu=$tablo.kurumkodu),
oturum,	
subesayisisinif6,	
kizsinif6,	
erkeksinif6	

from $tablo $ilcesorgu $okulsorgu  ORDER BY sn";

//$sayfam->setCellValue('A4', $sorgu);
$sonuc=$veritabani->query($sorgu);

	if ($sonuc){

		
          
            $i=0;	
            while ($satir=$sonuc->fetch_array()){
          
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('A'.$satirno, iutf($satir[0]))
                    ->setCellValue('B'.$satirno, $satir[1])
                    ->setCellValue('C'.$satirno, $satir[2])
                    ->setCellValue('D'.$satirno, $satir[3])
                    ->setCellValue('E'.$satirno, $satir[4])
                    ->setCellValue('F'.$satirno, $satir[4]+$satir[3])
                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            		
		$sayfam->getStyle("A$satirbaslangic:F$satirno")->applyFromArray($styleArray);

		}
	

?>