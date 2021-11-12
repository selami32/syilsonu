<?php

//Yâ Alîm Yâ Allah
$tablo=$onek."riskokulverileri";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}


$okulismisorgu="select okulunadi from $okultablo where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($okulismisorgu);
if ($okulsonuc){
	$satir=$okulsonuc->fetch_array();
	$okulunadi=$satir[0];
}

$obxl->setActiveSheetIndexByName('riskrapor');
$sayfam=$obxl->getActiveSheet();

$sayfam->setCellValue("d2",iutf($okulunadi));

/*Ya Âlîm Yâ Allah
$styleArray = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'F0000000'),
        ),
      ),
    );
 */
 
$sutunbaslangic=1;
$i=0;	
$satirnolar=array(
array(5,5,6,6,7,8),
array(12,12,13,13,14,15)
);

$satirnokontrol=0;

$sutunlar=array( 
array('B','C','B','C','B','B'),	
array('D','E','D','E','D','D'),	
array('F','G','F','G','F','F'),	
array('H','I','H','I','H','H'),	
array('J','K','J','K','J','J'),	
array('L','M','L','M','L','L'),	
array('N','O','N','O','N','N'),	
array('P','Q','P','Q','P','P'),	
array('R','S','R','S','R','R'),	
array('T','U','T','U','T','T'),	
array('V','W','V','W','V','V'),	
array('X','Y','X','Y','X','X'),	
array('Z','AA','Z','AA','Z','Z'),	
array('AB','AC','AB','AC','AB','AB'),	
array('AD','AE','AD','AE','AD','AD'),	
array('AF','AG','AF','AG','AF','AF'),	
array('AH','AI','AH','AI','AH','AH'),	
array('AJ','AK','AJ','AK','AJ','AJ'),	
array('AL','AM','AL','AM','AL','AL'),	
array('AN','AO','AN','AO','AN','AN')
); 

$sutunindex=0;
$satirindex=0;
$sifirlandi="";

  $sorgu="select  `kiz`, `erkek`, `kizoran`, `erkekoran`, `okultoplam`, `okuloran` from  $tablo where riskverisi<>'OKUL MEVCUDU' and kurumkodu=$kurumkodu order by sn asc";
  //die($sorgu);
  
	$sonuc=$veritabani->query($sorgu);
//echo $sorgu;
	if ($sonuc){

		
		
            
            while ($satir=$sonuc->fetch_array()){
			
                  // $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue($sutunlar[$sutunindex][0].$satirnolar[$satirindex][0], $satir[0])
                    ->setCellValue($sutunlar[$sutunindex][1].$satirnolar[$satirindex][1], $satir[1])
                    ->setCellValue($sutunlar[$sutunindex][2].$satirnolar[$satirindex][2], $satir[2])
                    ->setCellValue($sutunlar[$sutunindex][3].$satirnolar[$satirindex][3], $satir[3])
                    ->setCellValue($sutunlar[$sutunindex][4].$satirnolar[$satirindex][4], $satir[4])
                    ->setCellValue($sutunlar[$sutunindex][5].$satirnolar[$satirindex][5], $satir[5])                 

                       
                    ;    
                    $sutunindex++;
						if ($sutunindex+1>count($sutunlar)) {
							if ($sifirlandi=='evet') break;
							//echo 'maraba';
							$sifirlandi='evet';
							$sutunindex=0;
							$satirindex++;
						}				
								
						
						
                  //$y=$y+$sutunsayisi;
            }
			//$sayfam->getStyle("A7:J$satirno")->applyFromArray($styleArray);
     
		}

$sutunindex=16;
$satirindex=1;
$sifirlandi="";

$sorgu="select  `kiz`, `erkek`, `kizoran`, `erkekoran`, `okultoplam`, `okuloran` from  $tablo where riskverisi='OKUL MEVCUDU' and kurumkodu=$kurumkodu order by sn asc";
  //die($sorgu);
  
	$sonuc=$veritabani->query($sorgu);
//echo $sorgu;
	if ($sonuc){

		
		
            
            while ($satir=$sonuc->fetch_array()){
			
                  // $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue($sutunlar[$sutunindex][0].$satirnolar[$satirindex][0], $satir[0])
                    ->setCellValue($sutunlar[$sutunindex][1].$satirnolar[$satirindex][1], $satir[1])
                    ->setCellValue($sutunlar[$sutunindex][2].$satirnolar[$satirindex][2], $satir[2])
                    ->setCellValue($sutunlar[$sutunindex][3].$satirnolar[$satirindex][3], $satir[3])
                    ->setCellValue($sutunlar[$sutunindex][4].$satirnolar[$satirindex][4], $satir[4])
                    ->setCellValue($sutunlar[$sutunindex][5].$satirnolar[$satirindex][5], $satir[5])                 

                       
                    ;    
                    $sutunindex++;
						if ($sutunindex+1>count($sutunlar)) {
							if ($sifirlandi=='evet') break;
							//echo 'maraba';
							$sifirlandi='evet';
							$sutunindex=0;
							$satirindex++;
						}				
								
						
						
                  //$y=$y+$sutunsayisi;
            }
			//$sayfam->getStyle("A7:J$satirno")->applyFromArray($styleArray);
     
		}



?>