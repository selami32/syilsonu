<?php
if (!$onek) $onek="ys_";
// Yâ Âlîm Yâ Allah
$tablo=$onek."okulbilgileri";
$okultablo=$onek."okullar";

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}



$sorgu="select 
okulturu as okultur,
sum(rehberogretmensayisi), 
(sum(rehberogretmennorm)-sum(rehberogretmensayisi)), 
sum(rehberogretmennorm), 
(select count(rehberogretmensayisi) from $tablo where rehberogretmensayisi>0 and okulturu=okultur), 
(select count(rehberogretmensayisi) from $tablo where rehberogretmensayisi=0 and okulturu=okultur), 
count(*), 
(select sum(ogrencisayisitoplam) from $tablo where rehberogretmensayisi>0 and okulturu=okultur),  
(select sum(ogrencisayisitoplam) from $tablo where rehberogretmensayisi=0 and okulturu=okultur),
sum(ogrencisayisitoplam)
  from $tablo $ilcesorgu $okulsorgu GROUP BY okulturu";

//echo $sorgu ;die();

$sonuc=$veritabani->query($sorgu);
$satirno=4;

$sheet=$obxl->setActiveSheetIndexByName("okuldurum");

if ($sonuc){
	while ($satir=$sonuc->fetch_array()){

			
						
			$sheet->setCellValue('A'.$satirno, iutf($satir[0]))
            ->setCellValue('B'.$satirno, iutf($satir[1]))
            ->setCellValue('C'.$satirno, iutf($satir[2]))	
            ->setCellValue('D'.$satirno, iutf($satir[3]))	
            ->setCellValue('E'.$satirno, iutf($satir[4]))	
            ->setCellValue('F'.$satirno, iutf($satir[5]))	
            ->setCellValue('G'.$satirno, iutf($satir[6]))	
            ->setCellValue('H'.$satirno, iutf($satir[7]))	
            ->setCellValue('I'.$satirno, iutf($satir[8]))	
            ->setCellValue('J'.$satirno, iutf($satir[9]))	
            ;

			$satirno++;
	}
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
$satirno--;

//$sheet->getStyle("A4:J$satirno")->applyFromArray($styleArray);



?>