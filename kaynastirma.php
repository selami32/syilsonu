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
            background-image:url(ext2/shared/icons/fam/grid.png) !important;
        }
        #button-grid .x-panel-body {
            border:1px solid #99bbe8;
            border-top:0 none;
        }
        .add {
            background-image:url(ext2/shared/icons/fam/add.gif) !important;
        }
        .option {
            background-image:url(ext2/shared/icons/fam/plugin.gif) !important;
        }
        .remove {
            background-image:url(ext2/shared/icons/fam/delete.gif) !important;
        }
        .save {
            background-image:url(ext2/shared/icons/save.gif) !important;
        }
    </style>
<script type="text/javascript" src="debug.js"></script>
<link rel="stylesheet" type="text/css" href="ext2/resources/css/ext-all.css" />
<!-- GC -->
<!-- LIBS -->
<script type="text/javascript" src="ext2/adapter/ext/ext-base.js"></script>
<!-- ENDLIBS -->

<script type="text/javascript" src="ext2/ext-all.js"></script>
<script type="text/javascript" src="GroupSummary.js"></script>
<script type="text/javascript" src="sabitler.js"></script>
<script type="text/javascript">
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
$tablo=$onek."kaynastirma";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";
?> 

    

var myData = [
<?php

//bu k?s?m grid i?in:
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
   $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    
if ($sonuc->num_rows==0){
    $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `siniflar`, `zihinkiz`, `zihinerkek`, `dehbkiz`, `dehberkek`, `ustunkiz`, `ustunerkek`, `gormekiz`, `gormeerkek`, `ozgulkiz`, `ozgulerkek`, `isitmekiz`, `isitmeerkek`, `ortopedikiz`, `ortopedierkek`, `konusmakiz`, `konusmaerkek`, `spastikkiz`, `spastikerkek`, `otistikkiz`, `otistikerkek`, `birdenfazlakiz`, `birdenfazlaerkek`) VALUES
    ($kurumkodu, 'Okul ?ncesi', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '1. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '2. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '3. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '4. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '5. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '6. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '7. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '8. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '9. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '10. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '11. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '12. S?n?f', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');";


    $veritabani->query($sorgu);
    echo $veritabani->error;
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". 
			$row['siniflar'] ."','" . 
      intval($row['zihinkiz'])	 ."','" .
      intval($row['zihinerkek'])	 ."','" .
      intval($row['dehbkiz'])	 ."','" .
      intval($row['dehberkek'])	 ."','" .
      intval($row['ustunkiz'])	 ."','" .
      intval($row['ustunerkek'])	 ."','" .
      intval($row['gormekiz'])	 ."','" .
      intval($row['gormeerkek'])	 ."','" .
      intval($row['ozgulkiz'])	 ."','" .
      intval($row['ozgulerkek'])	 ."','" .
      intval($row['isitmekiz'])	 ."','" .
      intval($row['isitmeerkek'])	 ."','" .
      intval($row['ortopedikiz'])	 ."','" .
      intval($row['ortopedierkek'])	 ."','" .
      intval($row['konusmakiz'])	 ."','" .
      intval($row['konusmaerkek'])	 ."','" .
      intval($row['spastikkiz'])	 ."','" .
      intval($row['spastikerkek'])	 ."','" .
      intval($row['otistikkiz'])	 ."','" .
      intval($row['otistikerkek'])	."','" .
      intval($row['birdenfazlakiz'])	 ."','" .
      intval($row['birdenfazlaerkek'])	."'],\n";

			
	   
    }
     
       
       
    echo $output;

?>
            ];


</script>

<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<?php $veritabani->close(); ?>
<script type="text/javascript" src="GroupHeaderPlugin.js"></script>
<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>

<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>
<div id="form-bolgesi"></div>



</body>
</html>
