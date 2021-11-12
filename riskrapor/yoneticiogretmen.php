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

//alert('ya Âlîm Allah');    

var myData = [
<?php

//bu kısım grid için:
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");

if ($sonuc->num_rows==0){
    $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `okulturu`, `programicerigimadde`, `cokyararli`, `yararli`, `yararliolmadi`, `hicyararliolmadi`, `toplam`) VALUES	
($kurumkodu,  '$okulturu', 'Madde bağımlılığı hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Bağımlılık yapıcı maddeler hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Bağımlılığa neden olan unsurlar hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Bağımlılık süreci hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Bağımlılık yapıcı maddelerin etkileri hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Bağımlılığın oluşumundaki risk etkenleri hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Gençlerin madde kullandığını nasıl anlayabileceğimiz hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Madde bağımlılığını önleme hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Çocuk ve gençler için risk faktörleri hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Çocuğun ya da gencin madde kullandığından şüphelenildiği durumlarda yapılması gerekenler hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Koruyucu önleme faaliyetlerinde okul ve öğretmenin rolü hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Madde kullanan bir öğrencinin okulda kriz geçirmesi halinde yapılması gerekenler hakkındaki bilgiler', '0', '0', '0', '0', '0'),
($kurumkodu,  '$okulturu', 'Madde bağımlılığı ile ilgili hukuki durum hakkında verilen bilgiler', '0', '0', '0', '0', '0');";

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
