<?php


$tablo=$onek."rehberlikfaaliyet";
$okultablo=$onek."okullar";
$kurumkodu=$_GET["kurumkodu"];

if ($ilcesi!="-"){
$ilcesorgu=" WHERE (select ilcesi from $okultablo where kurumkodu=$tablo.kurumkodu)='$ilcesi' ";
}

if ($okulturu!="-"){
  if  ($ilcesorgu!="") { $basaekle=" AND "; } else {$basaekle=" WHERE ";}
  $okulsorgu=$basaekle .  " (select okulturu from $okultablo where kurumkodu=$tablo.kurumkodu)='$okulturu' ";
}

function ogretimyili(){

     if (date("m")<9){
          return date("Y")-1 ."-". date("Y");
     }else{
          return date("Y") ."-". date("Y")+1;

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
 
$okulismisorgu="select okulunadi from $okultablo where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($okulismisorgu);
if ($okulsonuc){
	$satir=$okulsonuc->fetch_array();
	$okulunadi=$satir[0];
}



$obxl->setActiveSheetIndexByName('ilcetakipcizelgesi');
$sayfam=$obxl->getActiveSheet();

$satirbaslangic=7;
$sorgu="select `yapilanfaaliyetinturu`, 
`ozelegitimogretmen`, 
`ozelegitimogrenci`, 
`ozelegitimveli`, 
`ilkokulogretmen`, 
`ilkokulogrenci`, 
`ilkokulveli`, 
`ortaokulogretmen`, 
`ortaokulogrenci`, 
`ortaokulveli`, 
`liseogretmen`, 
`liseogrenci`, 
`liseveli`, 
`toplamogretmen`, 
`toplamogrenci`, 
`toplamveli`


from $tablo where kurumkodu=$kurumkodu ORDER BY sn";

$sonuc=$veritabani->query($sorgu);

	if ($sonuc){

		
          
            $i=0;	
            while ($satir=$sonuc->fetch_array()){
          
                   $satirno=$i+$satirbaslangic;
                          
                $sayfam->setCellValue('A'.$satirno, iutf($satir['yapilanfaaliyetinturu']))
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
                    
                    ;    
                    $i++;          
                  //$y=$y+$sutunsayisi;

            }
            		
		//$sayfam->getStyle("A$satirbaslangic:p$satirno")->applyFromArray($styleArray);

		}
	$sayfam->setCellValue("b2",iutf($okulunadi));
	
	$sayfam->setCellValue("b4",ogretimyili() . iutf(" Eðitim -  Öðretim Yýlý"));

$styleArray = array(
    'font' => array(
        'bold' => true,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
);

$sayfam->getStyle('B4')->applyFromArray($styleArray);
?>