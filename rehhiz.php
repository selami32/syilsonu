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
<link rel="stylesheet" type="text/css" href="GroupHeaderPlugin.css" />
    <!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="ext2/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->

<script type="text/javascript" src="ext2/ext-all.js"></script>
<script type="text/javascript" src="GroupSummary.js"></script>
<script type="text/javascript" src="sabitler.js"></script>
<script type="text/javascript" src="GroupHeaderPlugin.js"></script>
 

<script type="text/javascript">
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
$tablo=$onek."rehhiz";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";

$sorgu="select * from ".$onek."okullar where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($sorgu);
$satir=$okulsonuc->fetch_assoc() or die ("veri bulunamadı");
  $okulunadi=$satir['okulunadi'];
  $ilcesi=$satir['ilcesi'];
  $okulturu=$satir['okulturu'];
//veritabanından alınan verileri javascript değişkenlerine aktar:
echo "var okulunadi='$okulunadi';\n";
echo "var ilcesi='$ilcesi';\n";
echo "var okulturu='$okulturu';\n";


?> 
    
var myData = [
<?php

$isimler=array("kurumkodu", "okulunadi", "ilcesi", "ogrencigorusmelerianaokulu", "veligorusmelerianaokulu", "aileveliziyaretlerianaokulu", "bireyselpsikolojikdanismaanaokulu", "bireyselegitselrehberlikanaokulu", "bireyselmeslekirehberlikanaokulu", "gruppsikolojigrupsayisianaokulu", "gruppsikolojiogrencisayisianaokulu", "gruplaegitselgrupsayisianaokulu", "gruplaegitselogrencisayisianaokulu", "gruplameslekigrupsayisianaokulu", "gruplameslekiogrencisayisianaokulu", "ogrencigorusmeleriilkokul", "veligorusmeleriilkokul", "aileveliziyaretleriilkokul", "bireyselpsikolojikdanismailkokul", "bireyselegitselrehberlikilkokul", "bireyselmeslekirehberlikilkokul", "gruppsikolojigrupsayisiilkokul", "gruppsikolojiogrencisayisiilkokul", "gruplaegitselgrupsayisiilkokul", "gruplaegitselogrencisayisiilkokul", "gruplameslekigrupsayisiilkokul", "gruplameslekiogrencisayisiilkokul", "ogrencigorusmeleriortaokul", "veligorusmeleriortaokul", "aileveliziyaretleriortaokul", "bireyselpsikolojikdanismaortaokul", "bireyselegitselrehberlikortaokul", "bireyselmeslekirehberlikortaokul", "gruppsikolojigrupsayisiortaokul", "gruppsikolojiogrencisayisiortaokul", "gruplaegitselgrupsayisiortaokul", "gruplaegitselogrencisayisiortaokul", "gruplameslekigrupsayisiortaokul", "gruplameslekiogrencisayisiortaokul", "ogrencigorusmelerilise", "veligorusmelerilise", "aileveliziyaretlerilise", "bireyselpsikolojikdanismalise", "bireyselegitselrehberliklise", "bireyselmeslekirehberliklise", "gruppsikolojigrupsayisilise", "gruppsikolojiogrencisayisilise", "gruplaegitselgrupsayisilise", "gruplaegitselogrencisayisilise", "gruplameslekigrupsayisilise", "gruplameslekiogrencisayisilise");

$satirbaslari=array("Anaokulu",
"İlkokul",
"Ortaokul",
"Lise");


  

  

    $basliksayisi=count($satirbaslari);
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY kurumkodu";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    $row = $sonuc->fetch_assoc();


     $y=0;
    for($x = 0 ; $x < $basliksayisi; $x++)
    {
      
			$output .= "['". $satirbaslari[$x] ."','" . intval($row[$isimler[$y+3]]) ."','" . intval($row[$isimler[$y+4]]) ."','". intval($row[$isimler[$y+5]])
			 ."','". intval($row[$isimler[$y+6]])
			 ."','". intval($row[$isimler[$y+7]])
			 ."','". intval($row[$isimler[$y+8]])
			 ."','". intval($row[$isimler[$y+9]])
			 ."','". intval($row[$isimler[$y+10]])
			 ."','". intval($row[$isimler[$y+11]])
			 ."','". intval($row[$isimler[$y+12]])
			 ."','". intval($row[$isimler[$y+13]])
			 ."','". intval($row[$isimler[$y+14]])
			 ."'],\n";
			   $y=$y+12;
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

<iframe id="gonderphp" name="gonderphp" style="display:none;visibility:hidden" src="gonder.php"></iframe>

</body>
</html>
