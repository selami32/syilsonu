<?php

   $styleArray = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'F0000000'),
        ),
      ),
    );
    
$tablo=$onek."rehberogretmen";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}


$sorgu="select *, 
(select concat(ilcesi, ' ',okulunadi) from $okultablo where $okultablo.kurumkodu=$tablo.kurumkodu) as okulunadi
 from $tablo $ilcesorgu $okulsorgu";
$sonuc=$veritabani->query($sorgu);


$satirno=1;
$obxl->setActiveSheetIndexByName('rehberogretmen');
$sayfam=$obxl->getActiveSheet();

while ($satir=$sonuc->fetch_assoc()){
    $satirno++;
 
    $sayfam->setCellValue('A'.$satirno, $satirno-1)
          ->setCellValue('B'.$satirno, iutf($satir['adisoyadi']))
          ->setCellValue('C'.$satirno, iutf($satir['cinsiyeti']))
          ->setCellValue('D'.$satirno, iutf($satir['gorevebaslamatarihi']))
          ->setCellValue('E'.$satirno, iutf($satir['buokuldagorevebaslamatarihi']))
          ->setCellValue('F'.$satirno, iutf($satir['gorevturu']))
          ->setCellValue('G'.$satirno, iutf($satir['okulunadi']))
          ->setCellValue('H'.$satirno, iutf($satir['mezunokul']))
          ->setCellValue('I'.$satirno, iutf($satir['tezkonusu']))
          ->setCellValue('J'.$satirno, iutf($satir['eposta']))
          ->setCellValue('K'.$satirno, iutf($satir['ceptelefonu']))
          ->getRowDimension($satirno)->setRowHeight(-1);
 
      $dsorgu="select * from  $tablo"."_egitimler where aldigiegitimler<>'' and adisoyadi='".$satir['adisoyadi']."'";
    //  echo $dsorgu;
      $dsonuc=$veritabani->query($dsorgu);
      $veregitimler='';
      if ($dsonuc){
      
          while ($dsatir=$dsonuc->fetch_assoc()){
                 $veregitimler=$veregitimler.$dsatir['aldigiegitimler'].chr(10);
          }
      $sayfam->setCellValue('L'.$satirno, iutf(substr($veregitimler,0,strlen($veregitimler)-2)));

      }
 			$sayfam->getStyle('H'.$satirno)->getAlignment()->setWrapText(true);
 			$sayfam->getStyle('I'.$satirno)->getAlignment()->setWrapText(true);
 			$sayfam->getStyle('L'.$satirno)->getAlignment()->setWrapText(true);

}
//Ya Âlîm Yâ Allah
    $sayfam->getStyle("A2:L$satirno")->applyFromArray($styleArray);

?>