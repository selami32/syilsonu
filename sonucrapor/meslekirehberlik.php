<?php


$tablo=$onek."meslekirehberlik";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" AND (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" AND ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}

//Ya Âlîm Yâ Allah
$sorguseti=array(
"grubu = 'Ýlköðretim 8. sýnýf sonunda yönlendirilen Üst Öðretim Kurumlarý' ",
"grubu = 'Ortaöðretim 9. Sýnýf sonunda yapýlan yönlendirme (Dikey geçiþler)' ",
"grubu = 'Ortaöðretim 9. Sýnýf Sonunda Alanlara Yönlendirme (Genel Liseler)' ",
"grubu = 'Ortaöðretim 10. sýnýf sonunda alanlar arasý Yönlendirme (Yatay Geçiþ)' "
);

$sayfam=$obxl->setActiveSheetIndexByName('mesleki rehberlik');
$satirbaslangic=array(4,11,17,24,32);
$sutunsayisi=6;

$duzeltmesql="update $tablo set kiz='' where kiz=0";
$veritabani->query($duzeltmesql);

$duzeltmesql="update $tablo set erkek='' where erkek=0";
$veritabani->query($duzeltmesql);

$duzeltmesql="update $tablo set toplam='' where toplam=0";
$veritabani->query($duzeltmesql);


for ($x=0;$x<count($sorguseti);$x++){
    $sorgu="select sum(`kiz`), count( DISTINCT  `kiz`)-1, sum(`erkek`), count(`erkek`), sum(`toplam`), count(`toplam`)
    from $tablo where $sorguseti[$x] $ilcesorgu $okulsorgu GROUP BY yonlendirilenokul";

//echo $sorgu;
    $sonuc=$veritabani->query($sorgu);
    //if ($sonuc) 
     

    $i=0;
    
    //for ($i=0;$i<$toplamsatir[$x];$i++){		
    while ($satir=$sonuc->fetch_array()){
    
               $satirno=$i+$satirbaslangic[$x]; 
                $sayfam->setCellValue('B'.$satirno, $satir[0])
                  ->setCellValue('C'.$satirno, $satir[1])
                  ->setCellValue('D'.$satirno, $satir[2])
                  ->setCellValue('E'.$satirno, $satir[3])
                  ->setCellValue('F'.$satirno, $satir[4])
                  ->setCellValue('G'.$satirno, $satir[5])
                  ;    
                  $i++;          
                //$y=$y+$sutunsayisi;

    }

}
if ($sonuc) $sonuc->close();
$modullericinokultipi='Mesleki ve teknik Eðitimde Modüller Arasý Geçiþler (Yatay Geçiþler)';

$sorgu="select yonlendirilenokul, sum(`kiz`), count(`kiz`), sum(`erkek`), count(`erkek`), sum(`toplam`), count(`toplam`)
    from $tablo where grubu='$modullericinokultipi' $ilcesorgu $okulsorgu GROUP BY yonlendirilenokul";

$modulsonuc=$veritabani->query($sorgu);

if ($modulsonuc->num_rows>0){
 
    $sayfam->mergeCells('A30:A31')
           ->mergeCells('B30:F30')
           ->mergeCells('G30:G31')
           ->setCellValue('A30', iutf($modullericinokultipi))
           ->setCellValue('B30', iutf('Genel Toplam'))
           ->setCellValue('G30', iutf('Veri Giren Okul Sayýsý'))
           ->setCellValue('B31', iutf('K'))
           ->setCellValue('C31', iutf('Veri Giren Okul Sayýsý'))
           ->setCellValue('D31', iutf('E'))
           ->setCellValue('E31', iutf('Veri Giren Okul Sayýsý'))
           ->setCellValue('F31', iutf('T'))
           ->setCellValue('G30', iutf('Veri Giren Okul Sayýsý'))
           ->getRowDimension(31)->setRowHeight(26)       
            ;
          

    $styleArray = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'F0000000'),
        ),
      ),
    );
    $i=0;
//    $sayfam->getStyle("A30:G31")->applyFromArray($styleArray);
    $sayfam->getStyle('B30')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        while ($satir=$modulsonuc->fetch_array()){
        
                   $satirno=$i+$satirbaslangic[$x];
                    			  
                $sayfam->setCellValue('A'.$satirno, iutf($satir[0]))
                        ->setCellValue('B'.$satirno, $satir[1])
                        ->setCellValue('C'.$satirno, $satir[2])
                        ->setCellValue('D'.$satirno, $satir[3])
                        ->setCellValue('E'.$satirno, $satir[4])
                        ->setCellValue('F'.$satirno, $satir[5])
                        ->setCellValue('G'.$satirno, $satir[6])
                        ->getRowDimension($satirno)->setRowHeight(-1)       

                        ;    
                        $i++;          
                    //$y=$y+$sutunsayisi;

        }
    $sayfam->getStyle("A30:G$satirno")->applyFromArray($styleArray);

$modulsonuc->close();
}


?>