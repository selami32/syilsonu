<?php
include "baglanti.php";
include "veritabani.php";



$kurumkodu=$_GET["kurumkodu"];
$okulunadi=$_GET["okulunadi"];


$satir="<tr style='height:18.2pt'>
  <td width=38 style='width:28.45pt;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 0cm 0cm 0cm;height:18.2pt'>
  <p class=MsoNormal>sira</p>
  </td>
  <td width=81 style='width:60.95pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:18.2pt'>
  <p class=MsoNormal>&nbsp;etkinlikadi</p>
  </td>
  <td width=84 style='width:62.85pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:18.2pt'>
  <p class=MsoNormal>&nbsp;etkinliksayisi</p>
  </td>
  <td width=92 style='width:68.7pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 0cm 0cm 0cm;
  height:18.2pt'>
  <p class=MsoNormal>&nbsp;katilanyonetici</p>
  </td>
  <td width=100 style='width:75.2pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:18.2pt'>
  <p class=MsoNormal>&nbsp;katilanogretmen</p>
  </td>
  <td width=132 style='width:99.25pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:18.2pt'>
  <p class=MsoNormal>&nbsp;katilanrehberogretmen</p>
  </td>
  <td width=141 style='width:105.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:18.2pt'>
  <p class=MsoNormal>&nbsp;katilanogrenciilkogretim</p>
  </td>
  <td width=149 style='width:111.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:18.2pt'>
  <p class=MsoNormal>&nbsp;katilanogrenciortaogretim</p>
  </td>
  <td width=69 style='width:51.7pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 0cm 0cm 0cm;
  height:18.2pt'>
  <p class=MsoNormal>&nbsp;katilanaile</p>
  </td>
  <td width=81 style='width:60.9pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 0cm 0cm 0cm;
  height:18.2pt'>
  <p class=MsoNormal>&nbsp;katilandiger</p>
  </td>
 </tr>";
$sorguek='';
if ($kurumkodu!=''){

$sorguek="  kurumkodu=$kurumkodu and ";
}

$isimler=array("etkinlikadi", "etkinliksayisi", "katilanyonetici", "katilanogretmen", "katilanrehberogretmen", "katilanogrenciilkogretim", "katilanogrenciortaogretim", "katilanaile", "katilandiger");
$sorgu='select etkinlikadi, sum(etkinliksayisi), 
sum(katilanyonetici), 
sum(katilanogretmen), 
sum(katilanrehberogretmen), 
sum(katilanogrenciilkogretim), sum(katilanogrenciortaogretim), sum(katilanaile), 
sum(katilandiger) from '.$onek.'etkinliklerv2 where '.$sorguek.' etkinliksayisi<>0 group by etkinlikadi ORDER BY sn';


//echo $sorgu;
//sorgu calistir:
$sonuc=$veritabani->query($sorgu); //or die("veri bulanamadý");
//sablon dosyanin icerigini aliyoruz:
$content=file_get_contents('raporsablon.htm'); 


//ilk tablodaki bilgileri iþliyoruz:
$x=0;

while ($x < $sonuc->num_rows){
	$x++;	
	$row = $sonuc->fetch_assoc(); 

	$gecicisatir=$satir;
	$gecicisatir=str_replace($isimler,$row,$gecicisatir);
	$gecicisatir=str_replace("sira",$x,$gecicisatir);
	$satirlar=$satirlar.$gecicisatir;
  
}
$sonuc->close();
$content=str_replace("satireklenecekyer", $satirlar, $content);

//diðer tablodan da bilgi alýyoruz:
$digersatir="<tr>
  <td width=179 valign=top style='width:134.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:10.0pt;'>okulunadi</span></p>
  </td>
  <td width=141 valign=top style='width:105.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:10.0pt;'>isbirligi</span></p>
  </td>
  <td width=207 valign=top style='width:155.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><span style='font-size:10.0pt;'>eylemguclukler</span></p>
  </td>
  <td width=207 valign=top style='width:155.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><span style='font-size:10.0pt;'>uygulamaguclukler</span></p>
  </td>
  <td width=228 valign=top style='width:171.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><span style='font-size:10.0pt;'>gorusoneriler</span></p>
  </td>
 </tr>";
$isimler=array("okulunadi","isbirligi", "eylemguclukler", "uygulamaguclukler", "gorusoneriler");

$okulsorgu="CONCAT(".$onek."okullar.ilcesi, ' ', ".$onek."okullar.okulunadi)";
$sorguek=' '.$onek.'okullar.kurumkodu='.$onek.'etkinliklerv2_ekbilgi.kurumkodu ';

if ($kurumkodu!=''){
    $okulsorgu="(SELECT concat(ilcesi, ' ', okulunadi) from ".$onek."okullar where kurumkodu=$kurumkodu )";
    $sorguek=" ".$onek."etkinliklerv2_ekbilgi.kurumkodu=$kurumkodu limit 1";
    $okuladiyeri='…………………………………………………OKULU';
    $content=str_replace($okuladiyeri,trUpper($okulunadi),$content);

}


$sorgu="SELECT $okulsorgu as okulunadi, ".$onek."etkinliklerv2_ekbilgi.isbirligi, ".$onek."etkinliklerv2_ekbilgi.eylemguclukler, ".$onek."etkinliklerv2_ekbilgi.uygulamaguclukler, ".
$onek."etkinliklerv2_ekbilgi.gorusoneriler from ".$onek."okullar, ".$onek."etkinliklerv2_ekbilgi where $sorguek ";

//echo $sorgu;
$sonuc=$veritabani->query($sorgu) or die("veri bulanamadý");


//ikinci tablodaki verileri iþliyoruz:
$x=0;
$satirlar="";

while ($x < $sonuc->num_rows){
	$x++;	
	$row = $sonuc->fetch_assoc(); 

	$gecicisatir=$digersatir;
	$gecicisatir=str_replace($isimler,$row,$gecicisatir);	
	
	$satirlar=$satirlar.$gecicisatir;
  
}


$sonuc->close();
//echo $satirlar;
$content=str_replace("digereklenecekyer", $satirlar, $content);



$veritabani->close();
$dosya="maddebagimliligi.doc";
/* bu kýsým dosya yazma yetkileri olmadýðý için iptal

$file = fopen($dosya, "w") or die("dosya açýlamadý!");
fwrite($file, $content); 
fclose($file); */

header("Content-Disposition: attachment; filename=" . urlencode($dosya));    
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");             
header("Content-Length: " . strlen($content));
flush(); // this doesn't really matter.

echo $content;

/* 
bu kýsým da:
$fp = fopen($file, "r"); 
while (!feof($fp))
{
    echo fread($fp, 65536); 
    flush(); // this is essential for large downloads
}  
//fclose($fp); 

$content="";

$adres="http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
$dosyalinki=str_replace("etkinliklerv2_rapor.php",$dosya,$adres);

echo $dosyalinki;
*/
?>