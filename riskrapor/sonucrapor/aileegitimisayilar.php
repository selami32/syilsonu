<?php


$tablo=$onek."degerlendirme_aileegitimi";
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
 

$obxl->setActiveSheetIndexByName('egitimsayilari');
$sayfam=$obxl->getActiveSheet();
$satirbaslangic=4;
$sorgu="select (select okulunadi from $okultablo where kurumkodu=$tablo.kurumkodu),
AEegitimsayisi,	
AEkatilimcisayisi

from $tablo $ilcesorgu $okulsorgu ORDER BY kurumkodu";

//$sayfam->setCellValue('A'.$satirno, $sorgu);
$sonuc=$veritabani->query($sorgu);

	if ($sonuc){

		
          
            $i=0;	
            while ($satir=$sonuc->fetch_array()){
          
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('A'.$satirno, iutf($satir[0]))
                    ->setCellValue('D'.$satirno, $satir[1])
                    ->setCellValue('E'.$satirno, $satir[2])                    
                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            		
		$sayfam->getStyle("A$satirbaslangic:e$satirno")->applyFromArray($styleArray);

		}
	

?>