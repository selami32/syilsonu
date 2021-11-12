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
    <link rel="stylesheet" type="text/css" href="ext2/resources/css/ext-all.css" />
<script type="text/javascript" src="debug.js"></script>
    <!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="ext2/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->

    <script type="text/javascript" src="ext2/ext-all.js"></script>
<script type="text/javascript" src="GroupSummary.js"></script>
<script type="text/javascript" src="sabitler.js"></script>
<script type="text/javascript" src="datepickerfix.js"></script>


<script type="text/javascript">
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
if ($kurumkodu=="")$kurumkodu=191061;

echo "var kurumkodu=$kurumkodu;\n";

$sorgu="select * from $onek"."okullar where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($sorgu);
$satir=$okulsonuc->fetch_assoc() or die ("veri bulunamadı");
$okulunadi=$satir['okulunadi'];
$ilcesi=$satir['ilcesi'];
$okulturu=$satir['okulturu'];
$tablo=$onek."rehberogretmen";

//veritabanından alınan verileri javascript değişkenlerine aktar:
echo "var gorevyeri='$okulunadi';\n";
echo "var ilcesi='$ilcesi';\n";
echo "var okulturu='$okulturu';\n";
echo "var tablo='$tablo';\n";

?> 
var isimler= new Array("kurumkodu", "adisoyadi", "cinsiyeti", "gorevebaslamatarihi", "buokuldagorevebaslamatarihi", "gorevturu", "mezunokul", "tezkonusu", "eposta", "ceptelefonu");

    
var myData = [];
var rehberogretmensayisi=0;

<?php


$isimler=array("kurumkodu", "adisoyadi", "cinsiyeti", "gorevebaslamatarihi", "buokuldagorevebaslamatarihi", "gorevturu", "mezunokul", "tezkonusu", "eposta", "ceptelefonu");


  
//tek satır dönen mysql sorguları için:

   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY kurumkodu";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    $i=1;
	$row = $sonuc->fetch_assoc();
	
	$adisoyadi=$row["adisoyadi"];
	
	while ($i<count($row)){
    echo 'myData["'.$isimler[$i].'"]="'.temizle($row[$isimler[$i]]).'";'."\n";
    $i++;
	}
    
     
    echo "var sayi=".$i.";";   
?>
var storeData = [
<?php       
    //echo "'".$output."'";
// alttaki verebileceği eğitimler için:

if (trim($adisoyadi)!=""){
  $query="select * from $tablo"."_egitimler where adisoyadi='$adisoyadi' ORDER BY sn ASC";
     $sonuc = $veritabani->query($query) ;
  
	if ($sonuc) {   
		for($x = 0 ; $x < $sonuc->num_rows ; $x++){
		$row = $sonuc->fetch_assoc();  //Veritabaninda kaç satir oldugunu ögrenerek tüm satirlar için islem yapmasini istedigimizi belirtiyoruz.
		$output .= "['". temizle($row['aldigiegitimler']) ."'],\n";
		   
		}
		echo $output;
	}
}
?>

];

            

</script>



<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->

<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>

<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
</head>
<body>

<div id="grid-bolgesi"></div>

<select name="ogretmencombo" id="ogretmencombo" style="display: none;">
<?php

$sql="SELECT adisoyadi from $tablo where adisoyadi<>'' and kurumkodu=$kurumkodu ORDER BY adisoyadi ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);


if ($sonuc){
  $rehberogretmensayisi=$sonuc->num_rows;
	while ($satir=$sonuc->fetch_assoc()){

	echo "<option value='".$satir["adisoyadi"]."'>".$satir["adisoyadi"]."</option>\n";
  
 
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
