<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}
// Yâ Âlîm Yâ Allah
include 'baglanti.php';
include 'veritabani.php';

function satirsayisi($tablo){
  
  $sql="select * from $tablo";
  $sonuc=$veritabani->query("$sql");
	
  return $sonuc->num_rows;
}

function satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis) {
    if (!$sorgu) {$satir=str_ireplace("Selami"," ",$satir); $content = str_ireplace($degis,$satir,$content); return $content; }
    $gecicisatir="";
    $satirlar="";
    
    while ($sonuc=$sorgu->fetch_array())
    {
    
      $sonuc= preg_replace ("/\r\n|\n\r|\n|\r/","\par ",$sonuc);

      $gecicisatir=$satir;
      for ($i=0;$i<$toplamalan;$i++){
  
    
       $gecicisatir = preg_replace("'Selami'", $sonuc[$i],$gecicisatir,1);   
    
      }
      $satirlar=$satirlar.$gecicisatir;
    }
      $content = str_ireplace($degis,$satirlar,$content);
      return $content;
}


$kurumkodu=$_POST["kurumkodu"];
if (!$kurumkodu) $kurumkodu=$_GET["kurumkodu"];

if (!$kurumkodu) die("kurum kodu yoktu");
//dosyanýn içini okuyup deðiþkene atayan kod:
$content= file_get_contents('siddet.rtf'); 




//il eylem planý çalýþmalar
$satir='\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid4462447 {\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid11405088\charrsid11405088 Selami}{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid9256107\charrsid11405088 \cell }{
\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid11405088\charrsid11405088 Selami}{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid9256107\charrsid11405088 \cell }{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid11405088\charrsid11405088 Selami}{\rtlch\fcs1 \af1 \ltrch\fcs0 
\f1\insrsid9256107\charrsid11405088 \cell }\pard \ltrpar\qc \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid5638298 {\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid11405088\charrsid11405088 Selami}{\rtlch\fcs1 \af1 
\ltrch\fcs0 \f1\insrsid9256107\charrsid11405088 \cell }{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid11405088\charrsid11405088 Selami}{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid9256107\charrsid11405088 \cell }{\rtlch\fcs1 \af1 \ltrch\fcs0 
\f1\insrsid11405088\charrsid11405088 Selami}{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid9256107\charrsid11405088 \cell }\pard \ltrpar\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\rtlch\fcs1 \af1 \ltrch\fcs0 
\f1\insrsid9256107\charrsid11405088 \trowd \irow2\irowband2\lastrow \ltrrow\ts11\trgaph70\trrh230\trleft0\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth3\trwWidth15047\trftsWidthB3\trftsWidthA3\trautofit1\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid5638298\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind108\tblindtype3 \clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth4320\clshdrawnil \cellx4320\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth2880\clshdrawnil \cellx7200\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth3390\clshdrawnil \cellx10590\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1432\clshdrawnil \cellx12022\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1590\clshdrawnil \cellx13612\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1435\clshdrawnil \cellx15047\row }\pard \ltrpar';

$tablo=$onek."calismalar";
$sql="select `yasanansorun`, `sorunayonelikcalismalar`, `gerceklestirenkurum`, `ogrencisayisi`, `annebabasayisi`, `personelsayisi` from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=6;
$degis="calis_malar";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";

// bölgesel risk

$satir='\qj \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid5638298 {\rtlch\fcs1 \ab\af1 \ltrch\fcs0 \f1\insrsid13332197 Selami}{\rtlch\fcs1 \ab\af1 \ltrch\fcs0 \f1\insrsid13332197\charrsid13332197 \cell }{\rtlch\fcs1 
\ab\af1 \ltrch\fcs0 \f1\insrsid13332197 Selami}{\rtlch\fcs1 \ab\af1 \ltrch\fcs0 \f1\insrsid13332197\charrsid13332197 \cell }{\rtlch\fcs1 \ab\af1 \ltrch\fcs0 \f1\insrsid13332197 Selami}{\rtlch\fcs1 \ab\af1 \ltrch\fcs0 \f1\insrsid13332197\charrsid13332197 
\cell }\pard \ltrpar\ql \li0\ri0\sa200\sl276\slmult1\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\rtlch\fcs1 \ai\af1 \ltrch\fcs0 \i\f1\insrsid13332197\charrsid5638298 \trowd \irow2\irowband2\lastrow \ltrrow
\ts11\trgaph70\trrh427\trleft0\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth1\trftsWidthB3\trftsWidthA3\trautofit1\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid13332197\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind108\tblindtype3 \clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth5954\clshdrawnil \cellx5954\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth4252\clshdrawnil \cellx10206\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth5322\clshdrawnil \cellx15528\row }\pard \ltrpar';

$tablo=$onek."bolgeselrisk";
$sql="select riskfaktorleri, yapilancalismalar, cozumonerileri from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=3;
$degis="bolgesel_risk";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";


/*/yaþanan sorunlar

$satir='\qj \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid5638298 {\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid2249896\charrsid2249896 
Selami}{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid8593974\charrsid2249896 \cell }{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid2249896\charrsid2249896 Selami}{\rtlch\fcs1 \af1 \ltrch\fcs0 \f1\insrsid8593974\charrsid2249896 \cell }\pard \ltrpar
\ql \li0\ri0\widctlpar\intbl\wrapdefault\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\rtlch\fcs1 \af1 \ltrch\fcs0 \b\f1\insrsid8593974\charrsid5638298 \trowd \irow1\irowband1\lastrow \ltrrow\ts11\trgaph70\trleft0\trbrdrt\brdrs\brdrw10 \trbrdrl
\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth1\trftsWidthB3\trftsWidthA3\trautofit1\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tblrsid5638298\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol\tblind108\tblindtype3 \clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl
\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth7380\clshdrawnil \cellx7380\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth7740\clshdrawnil \cellx15120\row }\pard \ltrpar';

$tablo=$onek."yasanansorunlar";
$sql="select yasanansorunlar, cozumonerileri from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=2;
$degis="n_sorunlar";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";
*/

//þiddet olaylarý
$satir='\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid16195536 {\f1\insrsid4998556 Selami}{\f1\insrsid6255319\charrsid5638298 \cell }\pard 
\qc \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid5638298 {\f1\insrsid4998556 Selami}{\f1\insrsid6255319\charrsid5638298 \cell }{\f1\insrsid4998556 Selami}{\f1\insrsid6255319\charrsid5638298 \cell }\pard 
\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid4998556 {\f1\insrsid4998556 Selami}{\f1\insrsid6255319\charrsid5638298 \cell }\pard \ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {
\b\f1\insrsid6255319\charrsid5638298 \trowd \irow1\irowband1\lastrow \ts11\trgaph70\trleft0\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth1\trftsWidthB3\trftsWidthA3\trautofit1\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol \clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr
\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth4860\clshdrawnil \cellx4860\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth910\clshdrawnil \cellx5810\clvertalc\clbrdrt
\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1123\clshdrawnil \cellx6933\clvertalc\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth8227\clshdrawnil \cellx15160\row }\pard';

$tablo=$onek."siddetolaylari";
$sql="select konu, olaysayisi, karisanogrencisayisi, yapilancalismalar from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=4;
$degis="sid_ol";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";


//disiplin suçlarý
$satir='\ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid7565929 {\f1\insrsid4263348 Selami}{\f1\insrsid10226422\charrsid13581380 \cell }\pard 
\qc \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0\pararsid5638298 {\f1\insrsid4263348 Selami}{\f1\insrsid10226422\charrsid13581380 \cell }{\f1\insrsid4263348 Selami}{\f1\insrsid10226422\charrsid13581380 \cell }{\f1\insrsid4263348 
Selami}{\f1\insrsid10226422\charrsid13581380 \cell }{\f1\insrsid4263348 Selami}{\f1\cf1\insrsid10226422\charrsid13581380 \cell }{\f1\insrsid4263348 Selami}{\f1\cf1\insrsid10226422\charrsid13581380 \cell }{\f1\insrsid4263348 Selami}{
\f1\cf1\insrsid10226422\charrsid13581380 \cell }{\f1\insrsid4263348 Selami}{\f1\cf1\insrsid10226422\charrsid13581380 \cell }\pard \ql \li0\ri0\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright\rin0\lin0 {\f1\insrsid10226422\charrsid13581380 
\trowd \irow3\irowband3\lastrow \ts11\trgaph70\trrh171\trleft0\trkeep\trbrdrt\brdrs\brdrw10 \trbrdrl\brdrs\brdrw10 \trbrdrb\brdrs\brdrw10 \trbrdrr\brdrs\brdrw10 \trbrdrh\brdrs\brdrw10 \trbrdrv\brdrs\brdrw10 
\trftsWidth1\trftsWidthB3\trftsWidthA3\trpaddl108\trpaddr108\trpaddfl3\trpaddft3\trpaddfb3\trpaddfr3\tbllkhdrrows\tbllklastrow\tbllkhdrcols\tbllklastcol \clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth7740\clshdrawnil \cellx7740\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth900\clshdrawnil \cellx8640\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth900\clshdrawnil \cellx9540\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth900\clshdrawnil \cellx10440\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx11520\clvertalt\clbrdrt\brdrs\brdrw10 
\clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx12600\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 
\cltxlrtb\clftsWidth3\clwWidth1080\clshdrawnil \cellx13680\clvertalt\clbrdrt\brdrs\brdrw10 \clbrdrl\brdrs\brdrw10 \clbrdrb\brdrs\brdrw10 \clbrdrr\brdrs\brdrw10 \cltxlrtb\clftsWidth3\clwWidth900\clshdrawnil \cellx14580\row }\pard';

$tablo=$onek."disiplinsuclari";
$sql="select konu,	ilkogretimuyarma,	ilkogretimkinama,	ilkogretimokuldeg,	ortaogretimmahrukinama,	ortaogretimkisauzak,	ortaogretimtasdikname,	ortaogretimorgunegitimdisi from $tablo where kurumkodu=$kurumkodu";
$sorgu=$veritabani->query("$sql");
$toplamalan=8;
$degis="disip_lin";
$content=satireklemeozel($content, $sorgu, $satir,$toplamalan, $degis);
$satir="";


$veritabani->close();
/*========================================================
                çýktý alýnýyor
 ======================================================== */         
$dosya=$kurumkodu.".rtf";

header("Content-Disposition: attachment; filename=" . urlencode($dosya));    
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");             
header("Content-Length: " . strlen($content));
flush(); // this doesn't really matter.

echo $content;

$content="";
?>