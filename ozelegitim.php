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
$tablo=$onek."ozelegitim";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";
?> 

    

var myData = [
<?php

//bu kısım grid için:
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn ASC";
   $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    
if ($sonuc->num_rows==0){
    $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `siniflar`, `zihinkiz`, `zihinerkek`, `gormekiz`, `gormeerkek`, `isitmekiz`, `isitmeerkek`, `ortopedikiz`, `ortopedierkek`, `otistikkiz`, `otistikerkek`, `ustunozelerkek`, `ustunozelkiz`, `bagimliocemkiz`, `bagimliocemerkek`, `toplamkiz`, `toplamerkek`) VALUES
    ($kurumkodu, 'Okul Öncesi', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '1. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '2. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '3. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '4. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '5. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '6. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '7. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '8. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '9. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '10. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '11. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'),
    ($kurumkodu, '12. Sınıf', '0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');";


    $veritabani->query($sorgu);
    echo $veritabani->error;
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". 
			$row['siniflar'] ."','" . 
      intval($row['zihinkiz'])	."','" .
      intval($row['zihinerkek'])	."','" .
      intval($row['gormekiz'])	."','" .
      intval($row['gormeerkek'])	."','" .
      intval($row['isitmekiz'])	."','" .
      intval($row['isitmeerkek'])	."','" .
      intval($row['ortopedikiz'])	."','" .
      intval($row['ortopedierkek'])	."','" .
      intval($row['otistikkiz'])	."','" .
      intval($row['otistikerkek'])	."','" .
      intval($row['ustunozelkiz'])	."','" .
      intval($row['ustunozelerkek'])	."','" .
      intval($row['bagimliocemkiz'])	."','" .
      intval($row['bagimliocemerkek'])	."','" .
      intval($row['toplamkiz'])	."','" .
      intval($row['toplamerkek'])	."'],\n";
	   
    }
     
       
       
    echo $output;

?>
            ];

var Fisimler= new Array("kurumkodu","sinifsayisi", "ogretmensayisi");
  
var formData = [];

<?php
//bu kısım grid altındaki form için:
 $Fisimler=array("kurumkodu","sinifsayisi", "ogretmensayisi");

  $query="select * from $tablo"."_ekbilgi where kurumkodu=$kurumkodu ORDER BY kurumkodu";
   $sonuc = $veritabani->query($query);
   if ($sonuc) $row = $sonuc->fetch_assoc();
    $i=1;
	
	
	
	while ($i<count($row)){
		echo 'formData["'.$Fisimler[$i].'"]="'.temizle($row[$Fisimler[$i]]).'";'."\n";
		$i++;
	}

 $veritabani->close();  
?>


</script>

<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>

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
