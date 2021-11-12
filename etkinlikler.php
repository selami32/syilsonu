<?php
session_start();
if(!isset($_SESSION["login"])){
echo "Bu sayfay� g�r�nt�leme yetkiniz yoktur.";
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
			$row = $sonuc->fetch_assoc();  //Veritabaninda ka� satir oldugunu �grenerek t�m satirlar i�in islem yapmasini istedigimizi belirtiyoruz.
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
	<option value="Toplant�">Toplant�</option>
	<option value="Panel">Panel</option>

</select>


<select name="etkinlikcombo" id="etkinlikcombo" style="display: none;">
     <option value='Geli�im D�nemleri'>Geli�im D�nemleri </option>
     <option value='Anne-Baba Tutumlar�'>Anne-Baba Tutumlar�</option>
     <option value='Disiplin ve S�n�rlar'>Disiplin ve S�n�rlar</option>
     <option value='�iddet, �hmal ve �stismar'>�iddet, �hmal ve �stismar</option>
     <option value='�leti�im'>�leti�im</option>
     <option value='Verimli Ders �al��ma'>Verimli Ders �al��ma</option>
     <option value='S�nav Sistemi (YGS-LYS)'>S�nav Sistemi (YGS-LYS)</option>
     <option value='S�nav Sistemi (TEOG)'>S�nav Sistemi (TEOG)</option>
     <option value='S�nav Stresi ve Motivasyon'>S�nav Stresi ve Motivasyon</option>
     <option value='Madde Ba��ml�l���'>Madde Ba��ml�l���</option>
     <option value='Test ��zme Teknikleri'>Test ��zme Teknikleri</option>
     <option value='Rehberlik Hizmetlerinin Tan�t�m�'>Rehberlik Hizmetlerinin Tan�t�m�</option>
     <option value='�zel E�itim'>�zel E�itim</option>
     <option value='Meslek Tan�t�m�'>Meslek Tan�t�m�</option>
     <option value='Okula Uyum/Oryantasyon'>Okula Uyum/Oryantasyon</option>
     <option value='�fke Y�netimi'>�fke Y�netimi</option>
     <option value='Di�er'>Di�er</option>
</select>

</body>
</html>
