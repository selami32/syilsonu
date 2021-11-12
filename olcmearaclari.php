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
$tablo=$onek."olcmearaclari";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";

$sorgu="select * from $onek"."okullar where kurumkodu=$kurumkodu";
$sonuc=$veritabani->query($sorgu);

if ($sonuc){

  $satir=$sonuc->fetch_assoc();
  $okulturu=$satir["okulturu"];
  echo "var okulturu='$okulturu';\n";
  $sonuc->close();
}
?> 

    

var myData = [
<?php

//bu k�s�m grid i�in:
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
if ($sonuc->num_rows==0){
    $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `olcmearaci`, `subesayisi`, `kiz`, `erkek`, `toplam`) VALUES
	($kurumkodu, 'Otobiyografi', '0','0','0','0'),
	($kurumkodu, 'Sosyometri', '0','0','0','0'),
	($kurumkodu, 'Ba�ar�s�zl�k Nedenleri Anketi', '0','0','0','0'),
	($kurumkodu, 'Problem Tarama Listesi (O Tak�m�)', '0','0','0','0'),
	($kurumkodu, 'Problem Tarama Listesi (L Tak�m�)', '0','0','0','0'),
	($kurumkodu, 'Beck Depresyon �l�e�i', '0','0','0','0'),
	($kurumkodu, 'Kimdir Bu-Tekni�i', '0','0','0','0'),
	($kurumkodu, 'Snellen G�z Tarama Testi', '0','0','0','0'),
	($kurumkodu, 'Kime G�re Ben Neyim Tek.', '0','0','0','0'),
	($kurumkodu, 'Bo� Zamanlar� De�. Anketi', '0','0','0','0'),
	($kurumkodu, 'Devams�zl�k Nedenleri Anketi', '0','0','0','0'),
	($kurumkodu, 'Beier C�mle Tamamlama testi', '0','0','0','0'),
	($kurumkodu, 'S�nav Kayg�s� �l�e�i', '0','0','0','0'),
	($kurumkodu, '�al��ma Davran��� De�erlendirme �l�e�i', '0','0','0','0'),
	($kurumkodu, 'Aile Envanteri', '0','0','0','0'),
	($kurumkodu, 'SCL 90', '0','0','0','0'),		
	($kurumkodu, 'Ki�ilik Envanteri', '0','0','0','0'),
	($kurumkodu, 'Stres �l�e�i', '0','0','0','0'),
	($kurumkodu, 'Risk Fakt�rleri anketi', '0','0','0','0'),
	($kurumkodu, 'TKT 7-11', '0','0','0','0'),
	($kurumkodu, 'TYT 6-8', '0','0','0','0'),
	($kurumkodu, 'TYT 9-11', '0','0','0','0'),
	($kurumkodu, 'Sosyal Uyum Envanteri', '0','0','0','0'),
	($kurumkodu, 'Cornel �ndex', '0','0','0','0'),
	($kurumkodu, '�ocuk Depresyon �l�e�i', '0','0','0','0'),
	($kurumkodu, 'Durumluluk S�reklilik Kayg� �l�e�i', '0','0','0','0'),
	($kurumkodu, 'Ebeveyn De�erlendirme �l�e�i', '0','0','0','0'),
	($kurumkodu, 'Ucla Yaln�zl�k �l�e�i', '0','0','0','0'),
	($kurumkodu, 'W Zung Depresyon �l�e�i', '0','0','0','0'),
	($kurumkodu, 'Burdon Dikkat Testi', '0','0','0','0');";

 $veritabani->query($sorgu);
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". temizle($row['olcmearaci']) ."','" . 
			intval($row['subesayisi']) ."','" .
			intval($row['kiz']) ."','" .
			intval($row['erkek']) ."','".
			intval($row['toplam']) ."'],\n";			
	   
    }
     
       
       
    echo $output;
	$sonuc->close();
?>
            ];

<?php


?>
</script>


<script type="text/javascript" src="GroupHeaderPlugin.js"></script>
<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>

<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>

<select name="olcmecombo" id="olcmecombo" style="display: none;">
<?php

$sql="SELECT DISTINCT olcmearaci from $tablo where olcmearaci<>'' ORDER BY olcmearaci ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);

if ($sonuc){
	while ($satir=$sonuc->fetch_array()){

	echo "<option value='".$satir["olcmearaci"]."'>".$satir["olcmearaci"]."</option>\n";

	}
}

?>
</select>
</body>
<?php $veritabani->close();  ?>
</html>
