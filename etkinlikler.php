<?php
session_start();
if(!isset($_SESSION["login"])){
echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
session_destroy();
die();
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
$tablo=$onek."etkinlikler";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";

?> 
    
var myData = [
<?php
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
     
     
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  //Veritabaninda kaç satir oldugunu ögrenerek tüm satirlar için islem yapmasini istedigimizi belirtiyoruz.
			$output .= "['". $row['etkinlikturu'] ."','" . 
			$row['etkinlikkonusu'] ."','" .
			intval($row['etkinliksayisi']) ."','" .
			intval($row['etkinlikkatogretmen']) ."','".
			intval($row['etkinlikkatogrenci']) ."','".
			intval($row['etkinlikkatveli']) ."','".
			intval($row['etkinlikkatdiger']) ."','".
			$row['etkinlikkattoplam'] ."'],\n";
	   
    }
     
       
       
    echo substr($output, 0, strlen($output)-2)."\n";

?>
            ];

</script>

<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<?php $veritabani->close(); ?>
<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
</head>
<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>
<select name="etkinlikturucombo" id="etkinlikturucombo" style="display: none;">
	<option value="Konferans">Konferans</option>
	<option value="Seminer">Seminer</option>
	<option value="Toplantı">Toplantı</option>
	<option value="Panel">Panel</option>

</select>


<select name="etkinlikcombo" id="etkinlikcombo" style="display: none;">
     <option value='Gelişim Dönemleri'>Gelişim Dönemleri </option>
     <option value='Anne-Baba Tutumları'>Anne-Baba Tutumları</option>
     <option value='Disiplin ve Sınırlar'>Disiplin ve Sınırlar</option>
     <option value='Şiddet, İhmal ve İstismar'>Şiddet, İhmal ve İstismar</option>
     <option value='İletişim'>İletişim</option>
     <option value='Verimli Ders Çalışma'>Verimli Ders Çalışma</option>
     <option value='Sınav Sistemi (YGS-LYS)'>Sınav Sistemi (YGS-LYS)</option>
     <option value='Sınav Sistemi (TEOG)'>Sınav Sistemi (TEOG)</option>
     <option value='Sınav Stresi ve Motivasyon'>Sınav Stresi ve Motivasyon</option>
     <option value='Madde Bağımlılığı'>Madde Bağımlılığı</option>
     <option value='Test Çözme Teknikleri'>Test Çözme Teknikleri</option>
     <option value='Rehberlik Hizmetlerinin Tanıtımı'>Rehberlik Hizmetlerinin Tanıtımı</option>
     <option value='Özel Eğitim'>Özel Eğitim</option>
     <option value='Meslek Tanıtımı'>Meslek Tanıtımı</option>
     <option value='Okula Uyum/Oryantasyon'>Okula Uyum/Oryantasyon</option>
     <option value='Öfke Yönetimi'>Öfke Yönetimi</option>
     <option value='Diğer'>Diğer</option>
</select>

</body>
</html>
