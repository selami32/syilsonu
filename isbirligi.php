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
$tablo=$onek."isbirligi";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";
?> 
    
var myData = [
<?php
   $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
     
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". $row['kurum'] ."','" . 
			$row['konusu'] ."'],\n";
			   
    }
     
       
       
    echo $output;

?>
            ];

</script>
<?php $veritabani->close(); ?>
<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>


<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
</head>
<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>

<select name="isbirligicombo" id="isbirligicombo" style="display: none;">
	<option value='Valilik'>Valilik</option>
	<option value='Emniyet Müdürlüğü'>Emniyet Müdürlüğü</option>
	<option value='Belediye Başkanlığı'>Belediye Başkanlığı</option>
	<option value='Kaymakamlık'>Kaymakamlık</option>
	<option value='Jandarma Komutanlığı'>Jandarma Komutanlığı</option>
	<option value='İl Sağlık Müdürlüğü'>İl Sağlık Müdürlüğü</option>
	<option value='Aile ve Sosyal Politikalar İl Müdürlüğü'>Aile ve Sosyal Politikalar İl Müdürlüğü</option>
	<option value='Milli Eğitim Müdürlüğü'>Milli Eğitim Müdürlüğü</option>
	<option value='Muhtarlık'>Muhtarlık</option>
	<option value='İş Kurumu İl Müdürlüğü'>İş Kurumu İl Müdürlüğü</option>
	<option value='Çevre ve Orman İl Müdürlüğü'>Çevre ve Orman İl Müdürlüğü</option>
	<option value='İl Afet ve Acil Durum Müdürlüğü'>İl Afet ve Acil Durum Müdürlüğü</option>
	<option value='Halk Eğitimi Merkezi Müdürlüğü'>Halk Eğitimi Merkezi Müdürlüğü</option>
	<option value='Üniversiteler'>Üniversiteler</option>
	<option value='Sivil Toplum Kuruluşları'>Sivil Toplum Kuruluşları</option>
	<option value='Rehberlik ve Araştırma Merkezi Müdürlüğü'>Rehberlik ve Araştırma Merkezi Müdürlüğü</option>
	<option value='Sosyal Yardımlaşma ve Dayanışma Vakfı Başkanlığı'>Sosyal Yardımlaşma ve Dayanışma Vakfı Başkanlığı</option>
	<option value='Müftülük'>Müftülük</option>
</select>
</body>
</html>
