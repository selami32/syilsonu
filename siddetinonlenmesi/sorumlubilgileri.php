<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}
?>
<html>
<head>
<?php
	$adres=$_GET['ad'];
?>
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
        }
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/ext-all.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/xtheme-slate.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>grid-examples.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/shared/examples.css" />

	<script type="text/javascript" src="debug.js"></script>
    <!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="<?php echo $adres; ?>ext2/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->

    <script type="text/javascript" src="<?php echo $adres; ?>ext2/ext-all.js"></script>

<script type="text/javascript" src="<?php echo $adres; ?>sabitler.js"></script>



<script type="text/javascript">
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
if ($kurumkodu=="")$kurumkodu=191061;

echo "var kurumkodu=$kurumkodu;\n";

$sorgu="select * from $onek"."okullar where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($sorgu);
$satir=$okulsonuc->fetch_assoc() or die ("veri bulunamad�");
$okulunadi=$satir['okulunadi'];
$ilcesi=$satir['ilcesi'];
$okulturu=$satir['okulturu'];
$tablo=$onek."sorumlubilgileri";


//veritaban�ndan al�nan verileri javascript de�i�kenlerine aktar:
echo "var gorevyeri='$okulunadi';\n";
echo "var ilcesi='$ilcesi';\n";
echo "var okulturu='$okulturu';\n";
echo "var tablo='$tablo';\n";
echo "var adres='$adres';\n";

?> 
var isimler= new Array("kurumkodu", "adisoyadi", "telefon", "faks", "eposta");
var myData = [];
myData["adisoyadi"]=" ";
myData["telefon"]="";
myData["faks"]="";
myData["eposta"]="";
<?php


$isimler=array("kurumkodu", "adisoyadi", "telefon", "faks", "eposta");


  
//tek sat�r d�nen mysql sorgular� i�in:

   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY kurumkodu";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    $i=1;
	$row = $sonuc->fetch_assoc();
	
	$adisoyadi=$row["adisoyadi"];
	
	while ($i<count($row)){
		echo 'myData["'.$isimler[$i].'"]="'.temizle($row[$isimler[$i]]).'";'."\n";
		$i++;
	}
    
     
    //echo "var sayi=".$i.";";   
?>
<?php       
    //echo "'".$output."'";
// alttaki  uyeler i�in:


  $query="select * from $tablo"."_uyeler where kurumkodu='$kurumkodu' ORDER BY sn ASC";
     $sonuc = $veritabani->query($query) ;
  
  if ($sonuc->num_rows==0){
    $sorgu= " INSERT INTO `$tablo"."_uyeler` (`kurumkodu`, `adisoyadi`, `kurumu`, `unvani`, `telefon`, `faks`, `eposta`) VALUES
    ($kurumkodu, '', '','Okul M�d�r�','','',''),
    ($kurumkodu, '', '','M�d�r Yrd.','','',''),
    ($kurumkodu, '', '','Rehber ��retmen','','',''),
    ($kurumkodu, '', '','S�n�f Rehber ��rt.','','',''),
    ($kurumkodu, '', '','S�n�f Rehber ��rt.','','',''),
    ($kurumkodu, '', '','S�n�f Rehber ��rt.','','',''),
    ($kurumkodu, '', '','Okul Aile Birli�i Tem.','','',''),
    ($kurumkodu, '', '','��renci','','','');";

    $veritabani->query($sorgu);
    echo $veritabani->error;
}
 
?>
var storeData = [
<?php 
	if ($sonuc) {   
		for($x = 0 ; $x < $sonuc->num_rows ; $x++){
		$row = $sonuc->fetch_assoc();  //Veritabaninda ka� satir oldugunu �grenerek t�m satirlar i�in islem yapmasini istedigimizi belirtiyoruz.
		$output .= "['". 	temizle($row['adisoyadi'])."','" . 
							temizle($row['kurumu']) ."','" .
							temizle($row['unvani']) ."','" .
							temizle($row['telefon']) ."','" .
							temizle($row['faks']) ."','" .
							temizle($row['eposta']) ."'],\n";
		
		   
		}
		echo $output;
	}
?>
];

            

</script>



<script type="text/javascript" src="<?php echo $adres; ?>ext2/shared/examples.js"></script><!-- EXAMPLES -->

<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>


</head>
<body>

<div id="grid-bolgesi"></div>

<select name="ogretmencombo" id="ogretmencombo" style="display: none;">
<?php
/*
$sql="SELECT adisoyadi from $tablo where adisoyadi<>'' and kurumkodu=$kurumkodu ORDER BY adisoyadi ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);


if ($sonuc){
  $rehberogretmensayisi=$sonuc->num_rows;
	while ($satir=$sonuc->fetch_assoc()){

	echo "<option value='".$satir["adisoyadi"]."'>".$satir["adisoyadi"]."</option>\n";
  
 
	}
}
*/
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
