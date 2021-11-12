<?php


$tablo=$onek."ozelegitim";
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
 

$obxl->setActiveSheetIndexByName('ozelEgitim');
$sayfam=$obxl->getActiveSheet();
$satirbaslangic=9;
$sorgu="select siniflar,	count(*), 	sum( `zihinkiz`),	sum( `zihinerkek`),	sum( `gormekiz`),	sum( `gormeerkek`),	sum( `isitmekiz`),	sum( `isitmeerkek`),	sum( `ortopedikiz`),	sum( `ortopedierkek`),	sum( `otistikkiz`),	sum( `otistikerkek`),	sum( `ustunozelerkek`),	sum( `ustunozelkiz`),	sum( `bagimliocemkiz`),	sum( `bagimliocemerkek`),	sum( `toplamkiz`),	sum( `toplamerkek`)
from $tablo $ilcesorgu $okulsorgu  GROUP BY siniflar  ORDER BY sn";

$sonuc=$veritabani->query($sorgu);

	if ($sonuc){

		
          
            $i=0;	
            while ($satir=$sonuc->fetch_array()){
          
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('A'.$satirno, iutf($satir[0]))
                    ->setCellValue('C'.$satirno, $satir[1])
                    ->setCellValue('D'.$satirno, $satir[2])
                    ->setCellValue('E'.$satirno, $satir[3])
                    ->setCellValue('F'.$satirno, $satir[4])
                    ->setCellValue('G'.$satirno, $satir[5])
                    ->setCellValue('H'.$satirno, $satir[6])
                    ->setCellValue('I'.$satirno, $satir[7])
                    ->setCellValue('J'.$satirno, $satir[8])
                    ->setCellValue('K'.$satirno, $satir[9])
                    ->setCellValue('L'.$satirno, $satir[10])
                    ->setCellValue('M'.$satirno, $satir[11])
                    ->setCellValue('N'.$satirno, $satir[12])
                    ->setCellValue('O'.$satirno, $satir[13])
                    ->setCellValue('P'.$satirno, $satir[14])
                    ->setCellValue('Q'.$satirno, $satir[15])
                    ->setCellValue('R'.$satirno, $satir[16])
                    ->setCellValue('S'.$satirno, $satir[17])
                    ->mergeCells("A$satirno:B$satirno")
                    ->getRowDimension($satirno)->setRowHeight(-1)       

                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            		

		}
	
$sorgu="select sum(sinifsayisi) as sinsay, sum(ogretmensayisi) as ogrsay from $tablo"."_ekbilgi";
$ekbilgisonuc=$veritabani->query($sorgu);

if($ekbilgisonuc){
    $ekbilgisatir=$ekbilgisonuc->fetch_assoc();
     $sayfam->setCellValue('B3', iutf($ekbilgisatir["sinsay"]))
              ->setCellValue('B6', iutf($ekbilgisatir["ogrsay"]));
    $ekbilgisonuc->close();
    $ekbilgisatir="";
}

$sayfam->getStyle("A9:S$satirno")->applyFromArray($styleArray);
?>