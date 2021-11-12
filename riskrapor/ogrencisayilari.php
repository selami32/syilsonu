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
$tablo=$onek."ogrencisayilari";
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
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn ASC";
   $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    
if ($sonuc->num_rows==0){
    $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `okulturu`, `subesayisisinif4`, `subesayisisinif6`, `subesayisisinif9`, `kizsinif4`, `erkeksinif4`, `kizsinif6`, `erkeksinif6`, `kizsinif9`, `erkeksinif9`, `kiztoplam`, `erkektoplam`) VALUES
    ($kurumkodu, '$okulturu', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');";


    $veritabani->query($sorgu);
    echo $veritabani->error;
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". 			 
      intval($row['subesayisisinif4'])	."','" .
      intval($row['subesayisisinif6'])	."','" .
      intval($row['subesayisisinif9'])	."','" .
      intval($row['kizsinif4'])	."','" .
      intval($row['erkeksinif4'])	."','" .
      intval($row['kizsinif6'])	."','" .
      intval($row['erkeksinif6'])	."','" .
      intval($row['kizsinif9'])	."','" .
      intval($row['erkeksinif9'])	."','" .
      intval($row['kiztoplam'])	."','" .
      intval($row['erkektoplam'])	."'],\n";
	   
    }
     
       
       
    echo $output;

?>
            ];



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

 $veritabani->close();  
?>


</body>
</html>
