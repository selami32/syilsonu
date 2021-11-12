<?php


$tablo=$onek."disiplinsuclari";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}


$obxl->setActiveSheetIndexByName('disiplin');
$sayfam=$obxl->getActiveSheet();

//Ya Âlîm Yâ Allah
$styleArray = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'F0000000'),
        ),
      ),
    );
 
$satirbaslangic=7;
$i=0;	
$satirno=0;

  $sorgu="select konu as kon, 	
  (select count(*) from $tablo where (okulturu='ilkokul' or okulturu='ortaokul') and konu=kon), 
  (select sum(ilkogretimuyarma) from $tablo where (okulturu='ilkokul' or okulturu='ortaokul') and konu=kon), 
  (select sum(ilkogretimkinama) from $tablo where (okulturu='ilkokul' or okulturu='ortaokul') and konu=kon), 
  (select sum(ilkogretimokuldeg) from $tablo where (okulturu='ilkokul' or okulturu='ortaokul') and konu=kon), 


 (select count(*) from $tablo where okulturu='lise' and konu=kon), 
  (select sum(ortaogretimmahrukinama) from $tablo where okulturu='lise' and konu=kon), 
  (select sum(ortaogretimkisauzak) from $tablo where okulturu='lise' and konu=kon), 
  (select sum(ortaogretimtasdikname	) from $tablo where okulturu='lise' and konu=kon), 
  (select sum(ortaogretimorgunegitimdisi) from $tablo where okulturu='lise' and konu=kon)
  	from $tablo $ilcesorgu $okulsorgu GROUP BY konu";
	$sonuc=$veritabani->query($sorgu);
//echo $sorgu;
	if ($sonuc){

		
		
            
            while ($satir=$sonuc->fetch_array()){
			
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('A'.$satirno, iutf($satir[0]))
                    ->setCellValue('B'.$satirno, $satir[1])
                    ->setCellValue('C'.$satirno, $satir[2])
                    ->setCellValue('D'.$satirno, $satir[3])
                    ->setCellValue('E'.$satirno, $satir[4])
                    ->setCellValue('F'.$satirno, $satir[5])
                    ->setCellValue('G'.$satirno, $satir[6])
                    ->setCellValue('H'.$satirno, $satir[7])
                    ->setCellValue('I'.$satirno, $satir[8])
                    ->setCellValue('J'.$satirno, $satir[9])
  
                    ->getRowDimension($satirno)->setRowHeight(-1)       
                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;
            }
			$sayfam->getStyle("A7:J$satirno")->applyFromArray($styleArray);
     
		}
	



?>