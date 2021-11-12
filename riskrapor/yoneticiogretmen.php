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
$tablo=$onek."yoneticiogretmen";
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

//alert('ya �l�m Allah');    

var myData = [
<?php

//bu k�s�m grid i�in:
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");

if ($sonuc->num_rows==0){
    $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `okulturu`, `programicerigimadde`, `cokyararli`, `yararli`, `yararliolmadi`, `hicyararliolmadi`, `toplam`) VALUES	
($kurumkodu,  '$okulturu', 'Madde ba��ml�l��� hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Ba��ml�l�k yap�c� maddeler hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Ba��ml�l��a neden olan unsurlar hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Ba��ml�l�k s�reci hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Ba��ml�l�k yap�c� maddelerin etkileri hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Ba��ml�l���n olu�umundaki risk etkenleri hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Gen�lerin madde kulland���n� nas�l anlayabilece�imiz hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Madde ba��ml�l���n� �nleme hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', '�ocuk ve gen�ler i�in risk fakt�rleri hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', '�ocu�un ya da gencin madde kulland���ndan ��phelenildi�i durumlarda yap�lmas� gerekenler hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Koruyucu �nleme faaliyetlerinde okul ve ��retmenin rol� hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Madde kullanan bir ��rencinin okulda kriz ge�irmesi halinde yap�lmas� gerekenler hakk�ndaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Madde ba��ml�l��� ile ilgili hukuki durum hakk�nda verilen bilgiler', '0', '0', '0', '0', '0');";

 $veritabani->query($sorgu);
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". temizle($row['programicerigimadde']) ."','" . 
			intval($row['cokyararli']) ."','" .
			intval($row['yararli']) ."','" .
			intval($row['yararliolmadi']) ."','".
			intval($row['hicyararliolmadi']) ."','".
			intval($row['toplam']) ."'],\n";
					
	   
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
