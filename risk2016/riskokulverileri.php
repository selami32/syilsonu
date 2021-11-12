<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<?php
	$adres=$_GET['ad'];
?>
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
$tablo=$onek."riskokulverileri";
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

    

var myData = [
<?php

//bu kısım grid için:
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
if ($sonuc->num_rows==0){
    $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `riskverisi`, `kiz`, `erkek`, `kizoran`, `erkekoran`, `okultoplam`, `okuloran`,`okulturu`) VALUES	
($kurumkodu, 'OKUL MEVCUDU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '1- ANNE/BABA AYRI', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '2- ANNE VEFAT', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '3- BABA VEFAT', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '4- ANNE ÜVEY', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '5-  BABA ÜVEY', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '6- SADECE ANNE İLE YAŞAYAN', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '7- SADECE BABA İLE YAŞAYAN', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '8- AİLEDE ŞİDDET GÖREN ÖĞRENCİLER', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '9- FİZYOLOJİK İHTİYACIN KARŞILANMADIĞI', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '10- PSİKOLOJİK İHTİYACIN KARŞILANMADIĞI', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '11- MADDİ YOKSUNLUK', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '12- OKUL DIŞI ZAMANLARDA  ÇALIŞAN ÖĞRENCİLER', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '13- SIK DEVAMSIZLIK YAPANLAR', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '14- OKUL YURTLARINDA VE/VEYA PANSİYONDA KALAN ÖĞRENCİLER', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '15- BAŞKASININ YANINDA KALAN ', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '16- AİLEDE ALKOL KULLANIMI OLAN ', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '17- AİLEDE SİGARA KULLANIMI OLAN ', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '18-ANNE/BABASI CEZA EVİNDE OLAN ÖĞRENCİLER', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '19- FAZLA KALABALIK AİLE ORTAMI OLAN ÖĞRENCİLER', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '20- BABASI YURT DIŞINDA ÇALIŞAN ÖĞRENCİLER', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '21- ANNESİ OKUMA YAZMA BİLMEYEN', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '22- BABASI OKUMA YAZMA BİLMEYEN', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '23- ANNESİ OKUMA YAZMA BİLEN', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '24- BABASI OKUMA YAZMA BİLEN', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '25- ANNESİ İLKOKUL MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '26- BABASI İLKOKUL MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '27- ANNESİ ORTAOKUL MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '28- BABASI ORTAOKUL MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '29- ANNESİ İLKÖĞRETİM MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '30- BABASI İLKÖĞRETİM MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '31- ANNESİ LİSE MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '32- BABASI LİSE MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '33- ANNESİ YÜKSEKOKUL ÜNİVERSİTE VE ÜSTÜ MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '34- BABASI YÜKSEKOKUL ÜNİVERSİTE VE ÜSTÜ MEZUNU', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '35-SOSYAL HİZMETLER YURDUNDA KALAN ÖĞRENCİLER', '0','0','0','0','0','0','$okulturu'),
($kurumkodu, '36-SINIF TEKRARI YAPAN ÖĞRENCİLER', '0','0','0','0','0','0','$okulturu')
;";

 $veritabani->query($sorgu);
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". temizle($row['riskverisi']) ."','" . 
			intval($row['kiz']) ."','" .
			intval($row['erkek']) ."','" .
			floatval($row['kizoran']) ."','".
			floatval($row['erkekoran']) ."','".
			intval($row['okultoplam']) ."','".
			floatval($row['okuloran']) ."'],\n";			
	   
    }
     
       
       
    echo $output;
	$sonuc->close();
?>
            ];

<?php


?>
</script>


<script type="text/javascript" src="<?php echo $adres; ?>GroupHeaderPlugin.js"></script>
<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>grid-examples.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>

<body>
<script type="text/javascript" src="<?php echo $adres; ?>ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>

</body>
<?php $veritabani->close();  ?>
</html>
