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
$tablo=$onek."meslekirehberlik";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";
?> 

    

var myData = [
<?php


//bu kısım grid için:
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
if ($sonuc->num_rows==0){
    $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `yonlendirilenokul`,  `kiz`, `erkek`, `toplam`, `grubu`) VALUES
	($kurumkodu, 'Genel Liselere.', '0','0','0','İlköğretim 8. sınıf sonunda yönlendirilen Üst Öğretim Kurumları'),
	($kurumkodu, 'Mesleki ve Teknik Eğitime.', '0','0','0','İlköğretim 8. sınıf sonunda yönlendirilen Üst Öğretim Kurumları'),
	($kurumkodu, 'Güzel sanatlar eğitimine.', '0','0','0','İlköğretim 8. sınıf sonunda yönlendirilen Üst Öğretim Kurumları'),
	($kurumkodu, 'Mesleki Eğitim Merkezlerine.', '0','0','0','İlköğretim 8. sınıf sonunda yönlendirilen Üst Öğretim Kurumları'),
	($kurumkodu, 'Diğer (...).', '0','0','0','İlköğretim 8. sınıf sonunda yönlendirilen Üst Öğretim Kurumları'),
	($kurumkodu, 'Genel Liselere', '0','0','0','Ortaöğretim 9. Sınıf sonunda yapılan yönlendirme (Dikey geçişler)'),
	($kurumkodu, 'Mesleki ve Teknik Liselere', '0','0','0','Ortaöğretim 9. Sınıf sonunda yapılan yönlendirme (Dikey geçişler)'),
	($kurumkodu, 'Mesleki Eğitim Merkezi', '0','0','0','Ortaöğretim 9. Sınıf sonunda yapılan yönlendirme (Dikey geçişler)'),
	($kurumkodu, 'Diğer (...),', '0','0','0','Ortaöğretim 9. Sınıf sonunda yapılan yönlendirme (Dikey geçişler)'),
	($kurumkodu, 'Fen Bilimleri', '0','0','0','Ortaöğretim 9. Sınıf Sonunda Alanlara Yönlendirme (Genel Liseler)'),
	($kurumkodu, 'Sosyal Bilimler', '0','0','0','Ortaöğretim 9. Sınıf Sonunda Alanlara Yönlendirme (Genel Liseler)'),
	($kurumkodu, 'Türkçe-Matematik', '0','0','0','Ortaöğretim 9. Sınıf Sonunda Alanlara Yönlendirme (Genel Liseler)'),
	($kurumkodu, 'Yabancı Dil', '0','0','0','Ortaöğretim 9. Sınıf Sonunda Alanlara Yönlendirme (Genel Liseler)'),
	($kurumkodu, 'Diğer(...)', '0','0','0','Ortaöğretim 9. Sınıf Sonunda Alanlara Yönlendirme (Genel Liseler)'),
	($kurumkodu, 'Fen Bilimleri-Sosyal Bilimler ', '0','0','0','Ortaöğretim 10. sınıf sonunda alanlar arası Yönlendirme (Yatay Geçiş)'),
	($kurumkodu, 'Fen Bilimleri-Türkçe Matematik', '0','0','0','Ortaöğretim 10. sınıf sonunda alanlar arası Yönlendirme (Yatay Geçiş)'),
	($kurumkodu, 'Türkçe Matematik- Fen Bilimleri', '0','0','0','Ortaöğretim 10. sınıf sonunda alanlar arası Yönlendirme (Yatay Geçiş)'),
	($kurumkodu, 'Türkçe Matematik - Sosyal Bilimler ', '0','0','0','Ortaöğretim 10. sınıf sonunda alanlar arası Yönlendirme (Yatay Geçiş)'),
	($kurumkodu, 'Sosyal Bilimler- Türkçe-Matematik', '0','0','0','Ortaöğretim 10. sınıf sonunda alanlar arası Yönlendirme (Yatay Geçiş)'),
	($kurumkodu, 'Sosyal Bilimler- Fen Bilimleri', '0','0','0','Ortaöğretim 10. sınıf sonunda alanlar arası Yönlendirme (Yatay Geçiş)')";

 $veritabani->query($sorgu);
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". 
			temizle($row['yonlendirilenokul']) ."','" . 			
			intval($row['kiz']) ."','" .
			intval($row['erkek']) ."','".
			intval($row['toplam']) ."','".
			$row['grubu'] ."'],\n";			
	   
    }
     
       
       
    echo $output;

?>
            ];

<?php


?>
</script>


<script type="text/javascript" src="GroupHeaderPlugin.js"></script>
<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<?php $veritabani->close(); ?>
<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>

<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>

</body>
</html>
