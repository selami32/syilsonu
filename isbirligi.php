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
	<option value='Emniyet M�d�rl���'>Emniyet M�d�rl���</option>
	<option value='Belediye Ba�kanl���'>Belediye Ba�kanl���</option>
	<option value='Kaymakaml�k'>Kaymakaml�k</option>
	<option value='Jandarma Komutanl���'>Jandarma Komutanl���</option>
	<option value='�l Sa�l�k M�d�rl���'>�l Sa�l�k M�d�rl���</option>
	<option value='Aile ve Sosyal Politikalar �l M�d�rl���'>Aile ve Sosyal Politikalar �l M�d�rl���</option>
	<option value='Milli E�itim M�d�rl���'>Milli E�itim M�d�rl���</option>
	<option value='Muhtarl�k'>Muhtarl�k</option>
	<option value='�� Kurumu �l M�d�rl���'>�� Kurumu �l M�d�rl���</option>
	<option value='�evre ve Orman �l M�d�rl���'>�evre ve Orman �l M�d�rl���</option>
	<option value='�l Afet ve Acil Durum M�d�rl���'>�l Afet ve Acil Durum M�d�rl���</option>
	<option value='Halk E�itimi Merkezi M�d�rl���'>Halk E�itimi Merkezi M�d�rl���</option>
	<option value='�niversiteler'>�niversiteler</option>
	<option value='Sivil Toplum Kurulu�lar�'>Sivil Toplum Kurulu�lar�</option>
	<option value='Rehberlik ve Ara�t�rma Merkezi M�d�rl���'>Rehberlik ve Ara�t�rma Merkezi M�d�rl���</option>
	<option value='Sosyal Yard�mla�ma ve Dayan��ma Vakf� Ba�kanl���'>Sosyal Yard�mla�ma ve Dayan��ma Vakf� Ba�kanl���</option>
	<option value='M�ft�l�k'>M�ft�l�k</option>
</select>
</body>
</html>
