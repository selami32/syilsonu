<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}
?>
<?php
	$adres=$_GET['ad'];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Etkinlikler Tablosu</title>
<style type="text/css">
		body{
			margin-top:0px;
			margin-bottom:0px;
			margin-right:0px;
			margin-left:0px;
		}
        body .x-panel {
            margin-bottom:20px;
        }
        .icon-grid {
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/grid.png) !important;
        }
        #button-grid .x-panel-body {
            border:1px solid #99bbe8;
            border-top:0 none;
        }
        .add {
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/add.gif) !important;
        }
        .option {
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/plugin.gif) !important;
        }
        .remove {
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/delete.gif) !important;
        }
        .save {
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/save.gif) !important;
    </style>
<script type="text/javascript" src="<?php echo $adres; ?>debug.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/xtheme-slate.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>grid-examples.css" />

<!-- GC -->

 	<!-- LIBS -->
 	<script type="text/javascript" src="<?php echo $adres; ?>ext2/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->
<script type="text/javascript" src="<?php echo $adres; ?>ext2/ext-all.js"></script>
<script type="text/javascript" src="<?php echo $adres; ?>GroupSummary.js"></script>
<script type="text/javascript" src="<?php echo $adres; ?>sabitler.js"></script>
<script type="text/javascript">
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
$tablo=$onek."ogrencibilgileri";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";

$sorgu="select * from $onek"."okullar where kurumkodu=$kurumkodu";
$sonuc=$veritabani->query($sorgu);

if ($sonuc){

  $satir=$sonuc->fetch_assoc();
  $okulturu=$satir["okulturu"];
  echo "var okulturu='$okulturu';\n";
  $sonuc->close();
}


?> 
//javascript isimlerde kurumkodu ilcesi falan eklemiyoruz
  var isimler= new Array( 'CinsiyetKiz','CinsiyetErkek','NeredevekiminleyasiyorsunuzAilemle','NeredevekiminleyasiyorsunuzAkrabalarimla','NeredevekiminleyasiyorsunuzArkadaslarimla','NeredevekiminleyasiyorsunuzPansiyonda','NeredevekiminleyasiyorsunuzDiger','AnnevebabanizhayattamiAnnehayatta','AnnevebabanizhayattamiBabaHayatta','AnnevebabanizhayattamiAnneHayattadegil','AnnevebabanizhayattamiBabahayattadegil','AnnevebabanizberabermiAyriyasiyorlar','AnnevebabanizberabermiBeraberleryasiyorlar','AnnebabanizayriyasiyorisekiminlekaliyorsunuzAnneile','AnnebabanizayriyasiyorisekiminlekaliyorsunuzBabaile','AnnebabanizayriyasiyorisekiminlekaliyorsunuzAkrabamile','AnnebabanizayriyasiyorisekiminlekaliyorsunuzArkadaslarimla','AnnebabanizayriyasiyorisekiminlekaliyorsunuzDiger','AnnenizinEgitimDuzeyiOkuryazardegil','AnnenizinEgitimDuzeyiilkokul','AnnenizinEgitimDuzeyiOrtaokul','AnnenizinEgitimDuzeyiLise','AnnenizinEgitimDuzeyiuniversite','BabanizinEgitimDuzeyiOkuryazardegil','BabanizinEgitimDuzeyiilkokul','BabanizinEgitimDuzeyiOrtaokul','BabanizinEgitimDuzeyiLise','BabanizinEgitimDuzeyiuniversite','AnnenizinmeslegiEvhanimi','Annenizinmeslegiisci','AnnenizinmeslegiMemur','Annenizinmeslegiciftci','AnnenizinmeslegiSerbestmeslek','Babanizinmeslegiisci','BabanizinmeslegiMemur','Babanizinmeslegiciftci','BabanizinmeslegiSerbestmeslek','Babanizinmeslegicalismiyor','EvinizdekimlerleberaberyasiyorsunuzAnne','EvinizdekimlerleberaberyasiyorsunuzBaba','EvinizdekimlerleberaberyasiyorsunuzBuyukanne','EvinizdekimlerleberaberyasiyorsunuzDede','EvinizdekimlerleberaberyasiyorsunuzDiger','AilenizinekonomikdurumuDusuk','AilenizinekonomikdurumuOrta','AilenizinekonomikdurumuYuksek','Oturdugunuzyerlesimyeriilmerkezi','Oturdugunuzyerlesimyeriilcemerkezi','OturdugunuzyerlesimyeriKoy');
  

var myData = [];
<?php


$isimler=array('CinsiyetKiz','CinsiyetErkek','NeredevekiminleyasiyorsunuzAilemle','NeredevekiminleyasiyorsunuzAkrabalarimla','NeredevekiminleyasiyorsunuzArkadaslarimla','NeredevekiminleyasiyorsunuzPansiyonda','NeredevekiminleyasiyorsunuzDiger','AnnevebabanizhayattamiAnnehayatta','AnnevebabanizhayattamiBabaHayatta','AnnevebabanizhayattamiAnneHayattadegil','AnnevebabanizhayattamiBabahayattadegil','AnnevebabanizberabermiAyriyasiyorlar','AnnevebabanizberabermiBeraberleryasiyorlar','AnnebabanizayriyasiyorisekiminlekaliyorsunuzAnneile','AnnebabanizayriyasiyorisekiminlekaliyorsunuzBabaile','AnnebabanizayriyasiyorisekiminlekaliyorsunuzAkrabamile','AnnebabanizayriyasiyorisekiminlekaliyorsunuzArkadaslarimla','AnnebabanizayriyasiyorisekiminlekaliyorsunuzDiger','AnnenizinEgitimDuzeyiOkuryazardegil','AnnenizinEgitimDuzeyiilkokul','AnnenizinEgitimDuzeyiOrtaokul','AnnenizinEgitimDuzeyiLise','AnnenizinEgitimDuzeyiuniversite','BabanizinEgitimDuzeyiOkuryazardegil','BabanizinEgitimDuzeyiilkokul','BabanizinEgitimDuzeyiOrtaokul','BabanizinEgitimDuzeyiLise','BabanizinEgitimDuzeyiuniversite','AnnenizinmeslegiEvhanimi','Annenizinmeslegiisci','AnnenizinmeslegiMemur','Annenizinmeslegiciftci','AnnenizinmeslegiSerbestmeslek','Babanizinmeslegiisci','BabanizinmeslegiMemur','Babanizinmeslegiciftci','BabanizinmeslegiSerbestmeslek','Babanizinmeslegicalismiyor','EvinizdekimlerleberaberyasiyorsunuzAnne','EvinizdekimlerleberaberyasiyorsunuzBaba','EvinizdekimlerleberaberyasiyorsunuzBuyukanne','EvinizdekimlerleberaberyasiyorsunuzDede','EvinizdekimlerleberaberyasiyorsunuzDiger','AilenizinekonomikdurumuDusuk','AilenizinekonomikdurumuOrta','AilenizinekonomikdurumuYuksek','Oturdugunuzyerlesimyeriilmerkezi','Oturdugunuzyerlesimyeriilcemerkezi','OturdugunuzyerlesimyeriKoy');


  
//tek satır dönen mysql sorguları için:
$tablo=$onek."ogrencibilgileri";
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY kurumkodu";
   $sonuc = $veritabani->query($query);
    if ($sonuc) $row = $sonuc->fetch_assoc();
    $i=0;

	
	
	while ($i<count($row)-1){
		echo 'myData["'.$isimler[$i].'"]="'.temizle($row[$isimler[$i]]).'";'."\n";
		$i++;
	}
    
     
       
       
    //echo "'".$output."'";
echo "var sayi=$i;\n";
echo "var tablo ='$tablo';";


$veritabani->close(); 
?>
/*
   if (sayi==1){
       myData["okulunadi"]=okulunadi;
       myData["ilcesi"]=ilcesi;
       myData["ogrencisayisikiz"]=0;
       myData["ogrencisayisierkek"]=0;
       myData["ogrencisayisitoplam"]=0;
       myData["rehberogretmensayisi"]=0;
       myData["rehberogretmennorm"]=0;	
   }         
           
*/
//alert(tablo);


</script>

<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>

<script type="text/javascript" src="<?php echo $adres; ?>GroupHeaderPlugin.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>grid-examples.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>

<body>
<script type="text/javascript" src="<?php echo $adres; ?>ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>
<div id="YOform-bolgesi"></div>
<div id="AEform-bolgesi"></div>
<div id="Aform-bolgesi"></div>

<?php

  
?>


</body>
</html>
