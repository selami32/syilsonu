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
<script type="text/javascript" src="Ext.ux.BoxSelect.js"></script>
<link href="boxselect.css" media="screen" rel="Stylesheet" type="text/css" />

<script type="text/javascript">
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
$tablo=$onek."yasanansorunlar";
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
			$output .= "['". temizle($row['yasanansorunlar']) ."','" . 
		  temizle($row['cozumonerileri']) ."'],\n";
	   
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

<?php $veritabani->close(); ?>
<select name="yasanansoruncombo" id="yasanansoruncombo" style="display: none;">
<option value='Aile içi çatışma ve şiddet,'>Aile içi çatışma ve şiddet,</option>
<option value='Aile içi Şiddet'>Aile içi Şiddet</option>
<option value='Akademik yetersizlikler'>Akademik yetersizlikler</option>
<option value='Akranları tarafından reddedilme, dışlanma'>Akranları tarafından reddedilme, dışlanma</option>
<option value='Alay etme'>Alay etme</option>
<option value='Aşırı baskıcı tutarsız anne baba tutumları'>Aşırı baskıcı tutarsız anne baba tutumları</option>
<option value='Çatışma ve problem çözmede yetersizlikler'>Çatışma ve problem çözmede yetersizlikler</option>
<option value='Çeteleşme'>Çeteleşme</option>
<option value='Dikkat Eksikliği ve Hiperaktivite'>Dikkat Eksikliği ve Hiperaktivite</option>
<option value='Ekonomik problemler'>Ekonomik problemler</option>
<option value='Fiziksel şiddet uygulama'>Fiziksel şiddet uygulama</option>
<option value='İhmal ve İstismar ile karşılaşılması.'>İhmal ve İstismar ile karşılaşılması.</option>
<option value='İletişim sorunları'>İletişim sorunları</option>
<option value='Küfür etme'>Küfür etme</option>
<option value='Lakap takma'>Lakap takma</option>
<option value='Okul arkadaşları ve öğretmenleri ile uyum problemleri '>Okul arkadaşları ve öğretmenleri ile uyum problemleri </option>
<option value='Okul içi ve bahçesinde disiplinin sağlanamaması'>Okul içi ve bahçesinde disiplinin sağlanamaması</option>
<option value='Okul idaresinin cezalandırıcı ve katı tutumları'>Okul idaresinin cezalandırıcı ve katı tutumları</option>
<option value='Okul idaresinin gevşek, umursamaz disiplin anlayışı'>Okul idaresinin gevşek, umursamaz disiplin anlayışı</option>
<option value='Okul ile ilgisi olmayan bireylerin okula gelmesi'>Okul ile ilgisi olmayan bireylerin okula gelmesi</option>
<option value='Okul kurallarına uymama'>Okul kurallarına uymama</option>
<option value='Okuldan kaçma'>Okuldan kaçma</option>
<option value='Öfke kontrolü problemleri'>Öfke kontrolü problemleri</option>
<option value='Öğrenci giriş ve çıkışlarının yeterince kontrol edilememesi.'>Öğrenci giriş ve çıkışlarının yeterince kontrol edilememesi.</option>
<option value='Öğrencide Ruhsal sorunlar'>Öğrencide Ruhsal sorunlar</option>
<option value='Öğrenciler arası duygusal ilişkilerden kaynaklı sorunlar'>Öğrenciler arası duygusal ilişkilerden kaynaklı sorunlar</option>
<option value='Öğrenciler arasındaki guruplaşmalar.'>Öğrenciler arasındaki guruplaşmalar.</option>
<option value='Öğrencilerin zamanında okula gelmemesi'>Öğrencilerin zamanında okula gelmemesi</option>
<option value='Öğretmen öğrenci iletişim problemleri.'>Öğretmen öğrenci iletişim problemleri.</option>
<option value='Öğretmenler arasındaki davranış ve tutum farklılıkları.'>Öğretmenler arasındaki davranış ve tutum farklılıkları.</option>
<option value='Sınıf disiplinini bozacak davranışlar'>Sınıf disiplinini bozacak davranışlar</option>
<option value='Sosyal etkinliklere yeterince zaman ayrılamaması'>Sosyal etkinliklere yeterince zaman ayrılamaması</option>
<option value='Zararlı madde kullanımı'>Zararlı madde kullanımı</option>
<option value='Zorbalık '>Zorbalık </option>

</select>
</body>
</html>
