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
<option value='Aile i�i �at��ma ve �iddet,'>Aile i�i �at��ma ve �iddet,</option>
<option value='Aile i�i �iddet'>Aile i�i �iddet</option>
<option value='Akademik yetersizlikler'>Akademik yetersizlikler</option>
<option value='Akranlar� taraf�ndan reddedilme, d��lanma'>Akranlar� taraf�ndan reddedilme, d��lanma</option>
<option value='Alay etme'>Alay etme</option>
<option value='A��r� bask�c� tutars�z anne baba tutumlar�'>A��r� bask�c� tutars�z anne baba tutumlar�</option>
<option value='�at��ma ve problem ��zmede yetersizlikler'>�at��ma ve problem ��zmede yetersizlikler</option>
<option value='�etele�me'>�etele�me</option>
<option value='Dikkat Eksikli�i ve Hiperaktivite'>Dikkat Eksikli�i ve Hiperaktivite</option>
<option value='Ekonomik problemler'>Ekonomik problemler</option>
<option value='Fiziksel �iddet uygulama'>Fiziksel �iddet uygulama</option>
<option value='�hmal ve �stismar ile kar��la��lmas�.'>�hmal ve �stismar ile kar��la��lmas�.</option>
<option value='�leti�im sorunlar�'>�leti�im sorunlar�</option>
<option value='K�f�r etme'>K�f�r etme</option>
<option value='Lakap takma'>Lakap takma</option>
<option value='Okul arkada�lar� ve ��retmenleri ile uyum problemleri '>Okul arkada�lar� ve ��retmenleri ile uyum problemleri </option>
<option value='Okul i�i ve bah�esinde disiplinin sa�lanamamas�'>Okul i�i ve bah�esinde disiplinin sa�lanamamas�</option>
<option value='Okul idaresinin cezaland�r�c� ve kat� tutumlar�'>Okul idaresinin cezaland�r�c� ve kat� tutumlar�</option>
<option value='Okul idaresinin gev�ek, umursamaz disiplin anlay���'>Okul idaresinin gev�ek, umursamaz disiplin anlay���</option>
<option value='Okul ile ilgisi olmayan bireylerin okula gelmesi'>Okul ile ilgisi olmayan bireylerin okula gelmesi</option>
<option value='Okul kurallar�na uymama'>Okul kurallar�na uymama</option>
<option value='Okuldan ka�ma'>Okuldan ka�ma</option>
<option value='�fke kontrol� problemleri'>�fke kontrol� problemleri</option>
<option value='��renci giri� ve ��k��lar�n�n yeterince kontrol edilememesi.'>��renci giri� ve ��k��lar�n�n yeterince kontrol edilememesi.</option>
<option value='��rencide Ruhsal sorunlar'>��rencide Ruhsal sorunlar</option>
<option value='��renciler aras� duygusal ili�kilerden kaynakl� sorunlar'>��renciler aras� duygusal ili�kilerden kaynakl� sorunlar</option>
<option value='��renciler aras�ndaki gurupla�malar.'>��renciler aras�ndaki gurupla�malar.</option>
<option value='��rencilerin zaman�nda okula gelmemesi'>��rencilerin zaman�nda okula gelmemesi</option>
<option value='��retmen ��renci ileti�im problemleri.'>��retmen ��renci ileti�im problemleri.</option>
<option value='��retmenler aras�ndaki davran�� ve tutum farkl�l�klar�.'>��retmenler aras�ndaki davran�� ve tutum farkl�l�klar�.</option>
<option value='S�n�f disiplinini bozacak davran��lar'>S�n�f disiplinini bozacak davran��lar</option>
<option value='Sosyal etkinliklere yeterince zaman ayr�lamamas�'>Sosyal etkinliklere yeterince zaman ayr�lamamas�</option>
<option value='Zararl� madde kullan�m�'>Zararl� madde kullan�m�</option>
<option value='Zorbal�k '>Zorbal�k </option>

</select>
</body>
</html>
