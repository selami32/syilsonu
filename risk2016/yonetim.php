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
<title>Yönetim</title>
<?php 
	$adres=$_GET["ad"];
?>
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
        .grid {
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/grid.png) !important;
        }
        .cross{
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/cross.gif) !important;
        }
</style>
<script type="text/javascript" src="<?php echo $adres; ?>debug.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/xtheme-slate.css" />
<!-- GC -->
<!-- LIBS -->
<script type="text/javascript" src="<?php echo $adres; ?>ext2/adapter/ext/ext-base.js"></script>
<!-- ENDLIBS -->

<script type="text/javascript" src="<?php echo $adres; ?>ext2/ext-all.js"></script>
<script type="text/javascript" src="<?php echo $adres; ?>sabitler.js"></script>
<script type="text/javascript">
//Ext.BLANK_IMAGE_URL = adres+'ext2/resources/images/default/s.gif';
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
$tablo=$onek."okullar";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";
echo "var adres='$adres';\n";

?> 
    
var myData = [
<?php
   $query="select * from $tablo ORDER BY sirano";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
     
    for($x = 0 ; $x < $sonuc->num_rows ; $x++){
    $row = $sonuc->fetch_assoc();  //Veritabaninda kaç satir oldugunu ögrenerek tüm satirlar için islem yapmasini istedigimizi belirtiyoruz.
    $output .= "['". $row['kurumkodu'] ."','" . 
    $row['okulturu'] ."','" .
    $row['okulunadi'] ."','" .
    $row['ilcesi'] ."','".
    $row['parola'] ."','".
    $row['girilentablo'] ."'],\n";
	   
    }
     
       
       
    echo $output;

?>
            ];



</script>

<?php

echo '<script type="text/javascript" src="yonetim.js"></script>'."\n";
 
?>

<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>grid-examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>

<body>
<div id="grid-bolgesi"></div>
<select name="okulturucombo" id="okulturucombo" style="display: none;">
	<option value="ilkokul">İlkokul</option>
	<option value="ortaokul">Ortaokul</option>
	<option value="lise">Lise</option>
	<option value="okuloncesi">Okul öncesi</option>

</select>

<select name="okulcombo" id="okulcombo" style="display: none;">
	<option value="-">-</option>
	<option value="ilkokul">İlkokul</option>
	<option value="ortaokul">Ortaokul</option>
	<option value="lise">Lise</option>
	<option value="okuloncesi">Okul öncesi</option>

</select>

<select name="ilcesicombo" id="ilcesicombo" style="display: none;">
<option value="-">-</option>

<?php

$sql="select distinct ilcesi from $tablo";
$sonuc=$veritabani->query($sql) or die("veri bulunamadı");

if ($sonuc){
    
  while ($satir=$sonuc->fetch_assoc()){
      $ilcesi=$satir["ilcesi"];
      if (trim($ilcesi)!="") echo '<option value="'.$ilcesi.'">'.$ilcesi.'</option>'."\n";     
      

  }

}

$veritabani->close(); 
?>
</select>
</body>
</html>
