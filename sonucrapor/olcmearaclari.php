<?php


$tablo=$onek."olcmearaclari";
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

$sorguseti=array(
"(okulturu = 'ilkokul' or okulturu = 'ortaokul') and olcmearaci=olcmear  ",
"okulturu = 'lise' and olcmearaci=olcmear"
);

$duzeltmesql="delete from $tablo where subesayisi=0";
$veritabani->query($duzeltmesql);
$duzeltmesql="OPTIMIZE TABLE $tablo";
$veritabani->query($duzeltmesql);


$sorgu="select olcmearaci as olcmear, 
(select sum(subesayisi) from $tablo where $sorguseti[0]),
(select sum(kiz) from $tablo where  $sorguseti[0]),
(select count(kiz) from $tablo where  $sorguseti[0]),
(select sum(erkek) from $tablo where  $sorguseti[0]),
(select count(erkek) from $tablo where  $sorguseti[0]),
(select sum(toplam) from $tablo where  $sorguseti[0]),
(select count(toplam) from $tablo where  $sorguseti[0])
from $tablo $ilcesorgu  
GROUP BY olcmear
";

$sorgu2="select olcmearaci as olcmear,
(select sum(subesayisi) from $tablo where $sorguseti[1]),
(select sum(kiz) from $tablo where  $sorguseti[1]),
(select count(kiz) from $tablo where  $sorguseti[1]),
(select sum(erkek) from $tablo where  $sorguseti[1]),
(select count(erkek) from $tablo where  $sorguseti[1]),
(select sum(toplam) from $tablo where  $sorguseti[1]),
(select count(toplam) from $tablo where  $sorguseti[1]) 
from $tablo $ilcesorgu
GROUP BY olcmear
";

//echo $sorgu;

$obxl->setActiveSheetIndexByName('Olcme');
$sayfam=$obxl->getActiveSheet();
$satirbaslangic=7;
$i=0;
//	$sorgu="select olcmearaci as olcmear,	sum(subesayisi) as subesayisi, sum(kiz), count(kiz),	sum(erkek),  count(erkek),	sum(toplam),count(toplam)
//		from $tablo where $sorguseti[$x] GROUP BY olcmear";
$sonuc=$veritabani->query($sorgu);

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
                    ->getRowDimension($satirno)->setRowHeight(-1)       

                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            $sayfam->getStyle("A7:O$satirno")->applyFromArray($styleArray);
     $sonuc->close();       
		}
		
$i=0;
$satirno=0;
$sonuc=$veritabani->query($sorgu2);

	if ($sonuc){

		
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
            
		}



?>