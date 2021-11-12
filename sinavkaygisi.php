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
<link rel="stylesheet" type="text/css" href="ext2/resources/css/ext-all.css" />
<script type="text/javascript" src="debug.js"></script>
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
$tablo=$onek."sinavkaygisi";

echo "var tablo='$tablo';\n";
echo "var kurumkodu=$kurumkodu;\n";


$sorgu="select * from ".$onek."okullar where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($sorgu);
$satir=$okulsonuc->fetch_assoc() or die ("veri bulunamad�");
  $okulunadi=$satir['okulunadi'];
  $ilcesi=$satir['ilcesi'];
  $okulturu=$satir['okulturu'];
//veritaban�ndan al�nan verileri javascript de�i�kenlerine aktar:
echo "var okulunadi='$okulunadi';\n";
echo "var ilcesi='$ilcesi';\n";
echo "var okulturu='$okulturu';\n";


?> 
    
var myData = [
<?php

$isimler=array("kurumkodu", "okulunadi", "ilcesi", "okulturu", "sinavlarhkbilgiverilenilkogretimogrencisayisi", "sinavlarhkbilgiverilenilkogretimogretmensayisi", "sinavlarhkbilgiverilenilkogretimailesayisi", "sinavlarhkbilgiverilenilkogretimmahallibasin", "ustogretimhkbilgiverilenilkogretimogrencisayisi", "ustogretimhkbilgiverilenilkogretimogretmensayisi", "ustogretimhkbilgiverilenilkogretimailesayisi", "ustogretimhkbilgiverilenilkogretimmahallibasin", "sinavkaygisibilgiverilenilkogretimogrencisayisi", "sinavkaygisibilgiverilenilkogretimogretmensayisi", "sinavkaygisibilgiverilenilkogretimailesayisi", "sinavkaygisibilgiverilenilkogretimmahallibasin");

$satirbaslari=array('S�navlar hakk�nda bilgi verilen ',
'�st ��retim Programlar� hakk�nda bilgi verilen',
'S�nav kayg�s� ve ba� etme yollar� konusunda bilgi verilen');


  



   $basliksayisi=count($satirbaslari);
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY kurumkodu";
   $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
   $row = $sonuc->fetch_assoc();


     $y=0;
    for($x = 0 ; $x < $basliksayisi; $x++){
      
			$output .= "['". $satirbaslari[$x] ."','" . 
			intval($row[$isimler[$y+4]]) ."','" . 			
			intval($row[$isimler[$y+5]]) ."','" . 			
			intval($row[$isimler[$y+6]]) ."','" . 			
			intval($row[$isimler[$y+7]]) ."'],\n";
			$y=$y+4;
    }
     
       
       
    echo $output;

?>
            ];
            

</script>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<?php $veritabani->close();  ?>
<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>
<body>

<div id="grid-bolgesi"></div>

</body>
</html>