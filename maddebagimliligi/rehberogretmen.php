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
    <link rel="stylesheet" type="text/css" href="ext2/resources/css/ext-all.css" />
    <link rel="stylesheet" type="text/css" href="ext2/resources/css/xtheme-gray.css" />
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
if ($kurumkodu=="")$kurumkodu=724197;
$tablo=$onek."rehberogretmen";

echo "var kurumkodu=$kurumkodu;\n";
echo "var onek='$onek';\n";

$sorgu="select * from ".$onek."okullar where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($sorgu);
$satir=$okulsonuc->fetch_assoc() or die ("veri bulunamadı");
$okulunadi=$satir['okulunadi'];
$ilcesi=$satir['ilcesi'];
$okulturu=$satir['okulturu'];
//veritabanından alınan verileri javascript değişkenlerine aktar:
echo "var gorevyeri='$okulunadi';\n";
echo "var ilcesi='$ilcesi';\n";
echo "var okulturu='$okulturu';\n";
echo "var tablo='$tablo';\n";

?> 
var isimler= new Array("kurumkodu", "tckimlik", "adisoyadi", "eposta", "gorevunvani", "gorevyeri", "okulturu", "ceptelefonu", "ili", "ilcesi", "hizmetsuresi", "TKT-7-11", "TYT-6-8", "TKT-9-11", "risk", "psikososyal", "7-19aile", "diger");

var rehberogretmensayisi=0;    
var myData = [];

<?php


$isimler=array("kurumkodu", "tckimlik", "adisoyadi", "eposta", "gorevunvani", "gorevyeri", "okulturu", "ceptelefonu", "ili", "ilcesi", "hizmetsuresi", "TKT-7-11", "TYT-6-8", "TKT-9-11", "risk", "psikososyal", "7-19aile", "diger");


  
//tek satır dönen mysql sorguları için:

   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY kurumkodu";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    $i=1;
	$row = $sonuc->fetch_assoc();
	$adisoyadi=$row['adisoyadi'];
	$tckimlik=$row["tckimlik"];
	
	while ($i<count($row)-1){
    echo 'myData["'.$isimler[$i].'"]="'.temizle($row[$isimler[$i]]).'";'."\n";
    $i++;
	}
    
    echo "var adisoyadi='$adisoyadi';\n"; 
    echo "var sayi=".$i.";";   
?>
var storeData = [
<?php       
    //echo "'".$output."'";
// alttaki verebileceği eğitimler için:


  $query="select * from $tablo"."_egitimler where tckimlik=$tckimlik ORDER BY sn";
     $sonuc = $veritabani->query($query) ;
  
if ($sonuc) {   
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
    $row = $sonuc->fetch_assoc();  //Veritabaninda kaç satir oldugunu ögrenerek tüm satirlar için islem yapmasini istedigimizi belirtiyoruz.
    $output .= "['". temizle($row['verebilecegiegitimler']) ."'],\n";
	   
    }
    echo $output;
}
    
?>

];

if (sayi==1)  {
 myData["gorevyeri"]=gorevyeri;
 myData["ili"]="Kastamonu";
 myData["ilcesi"]=ilcesi;
}
            

</script>



<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->

<script type="text/javascript" src="rehberogretmen.js"></script>


<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
</head>
<body>

<div id="grid-bolgesi"></div>
<select name="ogretmencombo" id="ogretmencombo" style="display: none;">
<?php

$sql="SELECT adisoyadi from $tablo where adisoyadi<>'' and kurumkodu=$kurumkodu ORDER BY adisoyadi ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);
$rehberogretmensayisi=0;
if ($sonuc){
	while ($satir=$sonuc->fetch_assoc()){

	echo "<option value='".$satir["adisoyadi"]."'>".$satir["adisoyadi"]."</option>\n";
  $rehberogretmensayisi++;
 
	}
}

$veritabani->close();
?>
</select>

<script type="text/javascript">

<?php
  if ($rehberogretmensayisi>0){
      echo "var rehberogretmensayisi=$rehberogretmensayisi;";
  }
?>
</script>

</body>
</html>
