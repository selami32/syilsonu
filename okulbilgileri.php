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
<title></title>
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
$tablo=$onek."okullar";

echo "var kurumkodu=$kurumkodu;\n";
//echo var tablo= aşağıda
$sorgu="select * from $tablo where kurumkodu=$kurumkodu";
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
var isimler= new Array("kurumkodu", "ili", "ilcesi", "okulunadi", "ogrenimsekli", "ogretimyili", "adresi", 
"telefonfaks", "postakodu", "internetadresi", "eposta", "ogrencisayisikiz", "ogrencisayisierkek", 
"ogrencisayisitoplam", "rehberogretmensayisi", "rehberogretmennorm");

    
var myData = [];

<?php


$isimler=array("kurumkodu", "ili", "ilcesi", "okulunadi", "ogrenimsekli", "ogretimyili", "adresi", "telefonfaks", "postakodu", "internetadresi", "eposta", "ogrencisayisikiz", "ogrencisayisierkek", "ogrencisayisitoplam", "rehberogretmensayisi", "rehberogretmennorm");


  
//tek satır dönen mysql sorguları için:
$tablo=$onek."okulbilgileri";
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY kurumkodu";
   $sonuc = $veritabani->query($query);
    if ($sonuc) $row = $sonuc->fetch_assoc();
    $i=1;

	
	
	while ($i<count($row)-1){
		echo 'myData["'.$isimler[$i].'"]="'.temizle($row[$isimler[$i]]).'";'."\n";
		$i++;
	}
    
     
       
       
    //echo "'".$output."'";
echo "var sayi=$i;\n";
echo "var tablo ='$tablo';";
$veritabani->close(); 
?>

   if (sayi==1){
       myData["okulunadi"]=okulunadi;
       myData["ilcesi"]=ilcesi;
       myData["ogrencisayisikiz"]=0;
       myData["ogrencisayisierkek"]=0;
       myData["ogrencisayisitoplam"]=0;
       myData["rehberogretmensayisi"]=0;
       myData["rehberogretmennorm"]=0;	
   }         

</script>



<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->

<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>


<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
</head>
<body>

<div id="grid-bolgesi"></div>


</body>
</html>
