<?php
session_start();
if(!isset($_SESSION["login"])){

session_destroy();
die("Bu sayfayi goruntuleme yetkiniz yoktur.");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Formlar</title>
<?php 
$adres=$_GET["ad"];
?>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/xtheme-slate.css" />
<script type="text/javascript" src="<?php echo $adres; ?>debug.js"></script>

<script type="text/javascript">
<!--

<?php
include "baglanti.php";
include "veritabani.php";

$tablo=$onek."okullar";
$kurumkodu=$_GET["kurumkodu"];
$kod=$_GET["k"];
$yazkurumkodu="<script type='text/javascript'>var kurumkodu=$kurumkodu;</script>";
echo "var adres='$adres';\n";
?>
//-->
</script>  
  
    <!-- GC -->
 	<!-- LIBS -->
<script type="text/javascript" src="<?php echo $adres; ?>ext2/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->


<script type="text/javascript" src="<?php echo $adres; ?>ext2/ext-all.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>giris.css" />
<script type="text/javascript" src="<?php echo $adres; ?>sabitler.js"></script>
 
<?php


    
 if ($kurumkodu==1) { 
   $sorgu="select parola,girilentablo from $tablo where kurumkodu=1";
    $sonuc=$veritabani->query($sorgu);
    $satir=$sonuc->fetch_array();
    
    $rsg=$satir[1];
    $parola=$satir[0];
    $dbkod=md5($parola.$rsg); 
	echo $yazkurumkodu;

    if( trim($dbkod) == trim($kod)) echo '<script type="text/javascript" src="yonetimgiris.js"></script>'; 
    
 }else{
	echo $yazkurumkodu;
     echo '<script type="text/javascript" src="formlar.js"></script>';
 }
 ?>
 

<!-- Common Styles for the examples -->
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/shared/examples.css" />

</head>

<body>
<script type="text/javascript" src="<?php echo $adres; ?>ext2/shared/examples.js"></script><!-- EXAMPLES -->


</body>
</html>