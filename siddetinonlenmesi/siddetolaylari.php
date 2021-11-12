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
<?php
	$adres=$_GET['ad'];
?>
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
<script type="text/javascript" src="<?php echo $adres; ?>debug.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/xtheme-slate.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>grid-examples.css" />

<!-- GC -->

 	<!-- LIBS -->
 	<script type="text/javascript" src="<?php echo $adres; ?>ext2/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->

<script type="text/javascript" src="<?php echo $adres; ?>ext2/ext-all.js"></script>
<script type="text/javascript" src="<?php echo $adres; ?>GroupSummary.js"></script>
<script type="text/javascript" src="<?php echo $adres; ?>sabitler.js"></script>
<script type="text/javascript">
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
$tablo=$onek."siddetolaylari";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";
echo "var adres='$adres';\n";

$sorgu="select * from $onek"."okullar where kurumkodu=$kurumkodu";
$sonuc=$veritabani->query($sorgu);
if ($sonuc){

	$satir=$sonuc->fetch_assoc();
	$okulturu=$satir["okulturu"];
	$sonuc->close();
	
}

echo "var okulturu='$okulturu';\n";

?> 
  
var myData = [
<?php
$query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
$sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
     
    for($x = 0 ; $x< $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  
			$output .= "['". temizle($row['konu']) ."','" . 
			intval($row['olaysayisi']) ."','" .
			intval($row['karisanogrencisayisi']) ."','" .
			temizle($row['yapilancalismalar']) ."'],\n";
	   
    }
     
       
       
    echo $output;

?>
            ];

</script>


<script type="text/javascript" src="<?php echo $adres; ?>GroupHeaderPlugin.js"></script>
<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>

</head>

<body>
<script type="text/javascript" src="<?php echo $adres; ?>ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>
<select name="davraniscombo" id="davraniscombo" style="display: none;">
	<option value='Alay etme'>Alay etme</option>
	<option value='Arkadaşlarının eşya ve malına zarar verme'>Arkadaşlarının eşya ve malına zarar verme</option>
	<option value='Cinsel Taciz'>Cinsel Taciz</option>
	<option value='Çalma'>Çalma</option>
	<option value='Dedikodu'>Dedikodu</option>
	<option value='Dersin işlenişine engel olmak'>Dersin işlenişine engel olmak</option>
	<option value='Fiziksel'>Fiziksel</option>
	<option value='Gasp'>Gasp</option>
	<option value='Hakaret'>Hakaret</option>
	<option value='Küfür'>Küfür</option>
	<option value='Lakap takma'>Lakap takma</option>
	<option value='Madde kullanımı'>Madde kullanımı</option>
	<option value='Okul eşyalarına zarar verme'>Okul eşyalarına zarar verme</option>
	<option value='Okula kesici, delici alet getirme'>Okula kesici, delici alet getirme</option>
	<option value='Öğretmenlere fiziksel saldırı'>Öğretmenlere fiziksel saldırı</option>
	<option value='Öğretmenlere hakaret'>Öğretmenlere hakaret</option>
	<option value='Öğretmenlere küfür'>Öğretmenlere küfür</option>
	<option value='Sataşma'>Sataşma</option>
	<option value='Şiddet'>Şiddet</option>
	<option value='Tehdit'>Tehdit</option>
	<option value='Yaralama'>Yaralama</option>
	<option value='Zorbalık'>Zorbalık</option>
</select>



<?php
/* İPTAL====================================================
$sql="SELECT DISTINCT konu from $tablo where konu<>'' ORDER BY konu ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);

$siddetolaylari=array(
'Fiziksel şiddet(Yumruk, tekme, tokat vb.)',
'Zorbalık',
'Tehdit',
'Sataşma',
'Eşyaya/mala zarar verme',
'Okula silah/kesici/delici alet getirme',
'Ateşli kesici delici silahla yaralama',
'Madde kullanımı(alkol, uyuşturucu,ilaç vb)',
'Cinsel taciz',
'Çalma',
'Gasp',
'Çete oluşturma/katılma',
'Dedikodu/lakap takma'
);

foreach ($siddetolaylari as $siddet){

	echo "<option value='".$siddet."'>".$siddet."</option>\n";
}

if ($sonuc){
	while ($satir=$sonuc->fetch_array()){
		$siddetolayi=$satir['konu'];
		if (in_array($siddetolayi, $siddetolaylari)===false){
			echo "<option value='".$siddetolayi."'>".$siddetolayi."</option>\n";
		}
	}
}

*/

?>


<?php $veritabani->close(); ?>
</body>
</html>
