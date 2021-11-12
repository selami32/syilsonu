<?php


$tablo=$onek."etkinlikler";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}


$obxl->setActiveSheetIndexByName('etkinlikler');
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
 
$satirbaslangic=6;
$i=0;	

  $sorgu="select etkinlikkonusu as etk, 	
  (select count(*) from $tablo where etkinlikturu='Seminer' and etkinlikkonusu=etk), 
  (select sum(etkinliksayisi) from $tablo where etkinlikturu='Seminer' and etkinlikkonusu=etk), 
  (select sum(etkinlikkatogretmen) from $tablo where etkinlikturu='Seminer' and etkinlikkonusu=etk), 
  (select sum(etkinlikkatogrenci) from $tablo where etkinlikturu='Seminer' and etkinlikkonusu=etk), 
  (select sum(etkinlikkatveli) from $tablo where etkinlikturu='Seminer' and etkinlikkonusu=etk), 
  

(select count(*) from $tablo where etkinlikturu='Toplantý' and etkinlikkonusu=etk), 
  (select sum(etkinliksayisi) from $tablo where etkinlikturu='Toplantý'  and etkinlikkonusu=etk), 
  (select sum(etkinlikkatogretmen) from $tablo where etkinlikturu='Toplantý' and  etkinlikkonusu=etk), 
  (select sum(etkinlikkatogrenci) from $tablo where etkinlikturu='Toplantý'  and etkinlikkonusu=etk), 
  (select sum(etkinlikkatveli) from $tablo where etkinlikturu='Toplantý' and etkinlikkonusu=etk ), 
  
  
  (select count(*) from $tablo where etkinlikturu='Konferans'  and etkinlikkonusu=etk), 
  (select sum(etkinliksayisi) from $tablo where etkinlikturu='Konferans'  and etkinlikkonusu=etk ), 
  (select sum(etkinlikkatogretmen) from $tablo where etkinlikturu='Konferans'  and etkinlikkonusu=etk), 
  (select sum(etkinlikkatogrenci) from $tablo where etkinlikturu='Konferans'  and etkinlikkonusu=etk), 
  (select sum(etkinlikkatveli) from $tablo where etkinlikturu='Konferans'  and etkinlikkonusu=etk ), 
  
  (select count(*) from $tablo where etkinlikturu='Panel'  and etkinlikkonusu=etk), 
  (select sum(etkinliksayisi) from $tablo where etkinlikturu='Panel' and etkinlikkonusu=etk  ), 
  (select sum(etkinlikkatogretmen) from $tablo where etkinlikturu='Panel'  and etkinlikkonusu=etk), 
  (select sum(etkinlikkatogrenci) from $tablo where etkinlikturu='Panel'  and etkinlikkonusu=etk), 
  (select sum(etkinlikkatveli) from $tablo where etkinlikturu='Panel'   and etkinlikkonusu=etk)
		from $tablo $ilcesorgu $okulsorgu GROUP BY etkinlikkonusu";
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
                    ->setCellValue('K'.$satirno, $satir[10])
                    ->setCellValue('L'.$satirno, $satir[11])
                    ->setCellValue('M'.$satirno, $satir[12])
                    ->setCellValue('N'.$satirno, $satir[13])
                    ->setCellValue('O'.$satirno, $satir[14])
                    ->setCellValue('P'.$satirno, $satir[15])
                    ->setCellValue('q'.$satirno, $satir[16])
                    ->setCellValue('r'.$satirno, $satir[17])
                    ->setCellValue('S'.$satirno, $satir[18])
                    ->setCellValue('T'.$satirno, $satir[19])
                    ->setCellValue('U'.$satirno, $satir[20])
                    ->getRowDimension($satirno)->setRowHeight(-1)       
                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;
            }
			$sayfam->getStyle("A6:U$satirno")->applyFromArray($styleArray);
     
		}
	



?>