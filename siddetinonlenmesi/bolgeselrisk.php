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
$tablo=$onek."bolgeselrisk";
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
			$output .= "['". temizle($row['riskfaktorleri']) ."','" . 
			temizle($row['yapilancalismalar']) ."','" .
			temizle($row['cozumonerileri']) ."'],\n";
	   
    }
     
       
       
    echo $output;

?>
            ];

</script>

<script type="text/javascript" src="<?php echo $adres; ?>ext2/shared/examples.js"></script><!-- EXAMPLES -->
<script type="text/javascript" src="<?php echo $adres; ?>GroupHeaderPlugin.js"></script>
<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>

</head>

<body>

<div id="grid-bolgesi"></div>
<select name="bolgeselsoruncombo" id="bolgeselsoruncombo" style="display: none;">
<option value='Aile i�i �at��ma ve �iddet,'>Aile i�i �at��ma ve �iddet,</option>
<option value='Ailelerin e�itim d�zeylerinin d���k olmas�'>Ailelerin e�itim d�zeylerinin d���k olmas�</option>
<option value='Ailenin �ocu�u b�rakarak �al��maya gitmesi.'>Ailenin �ocu�u b�rakarak �al��maya gitmesi.</option>
<option value='Akademik ba�ar�n�n �n planda tutulmas�'>Akademik ba�ar�n�n �n planda tutulmas�</option>
<option value='Akranlar� taraf�ndan red edilmesi'>Akranlar� taraf�ndan red edilmesi</option>
<option value='Ana babalardan biri ya da ikisinin alkol yada madde kullan�m� problemlerinin olmas�.'>Ana babalardan biri ya da ikisinin alkol yada madde kullan�m� problemlerinin olmas�.</option>
<option value='Ana babalardan biri ya da ikisinin ruhsal hastal���n�n olmas� '>Ana babalardan biri ya da ikisinin ruhsal hastal���n�n olmas� </option>
<option value='Anne ve baban�n ayr� ya�amas�'>Anne ve baban�n ayr� ya�amas�</option>
<option value='A��r� bask�c� tutars�z ana-baba tutumlar�.'>A��r� bask�c� tutars�z ana-baba tutumlar�.</option>
<option value='A��r� televizyon izleme.'>A��r� televizyon izleme.</option>
<option value='A��r� yoksulluk'>A��r� yoksulluk</option>
<option value='Bo�anma,'>Bo�anma,</option>
<option value='�ete �yeli�i,'>�ete �yeli�i,</option>
<option value='�evrede intiharlar �rneklerinin fazla olmas�'>�evrede intiharlar �rneklerinin fazla olmas�</option>
<option value='�ocuk ihmali veya istismar�.( Fiziksel, Duygusal, Cinsel �stismar)'>�ocuk ihmali veya istismar�.( Fiziksel, Duygusal, Cinsel �stismar)</option>
<option value='Hedefsizlik ve motivasyon eksikli�i.'>Hedefsizlik ve motivasyon eksikli�i.</option>
<option value='�lgisiz anne baba tutumlar�'>�lgisiz anne baba tutumlar�</option>
<option value='�nternet ba��ml�l���'>�nternet ba��ml�l���</option>
<option value='��sizlik, maddi s�k�nt�lar.'>��sizlik, maddi s�k�nt�lar.</option>
<option value='Kendine g�vensizlik, geli�memi� sosyal beceriler.'>Kendine g�vensizlik, geli�memi� sosyal beceriler.</option>
<option value='Kronik, tedavi edilmemi� fiziksel hastal���n�n ya da engelinin olmas�,'>Kronik, tedavi edilmemi� fiziksel hastal���n�n ya da engelinin olmas�,</option>
<option value='Ku�aklar aras� �at��ma.'>Ku�aklar aras� �at��ma.</option>
<option value='Maddenin k�t�ye kullan�m�'>Maddenin k�t�ye kullan�m�</option>
<option value='Okul Ba�ar�s�zl���.'>Okul Ba�ar�s�zl���.</option>
<option value='Okul �evresindeki internet cafe, oyun salonlar� vb olmas�'>Okul �evresindeki internet cafe, oyun salonlar� vb olmas�</option>
<option value='Okul kantinlerinin denetiminin yetersizli�i'>Okul kantinlerinin denetiminin yetersizli�i</option>
<option value='Okuldan ka�ma.'>Okuldan ka�ma.</option>
<option value='Okulun Fiziki yap�s�n�n k�t� olmas�'>Okulun Fiziki yap�s�n�n k�t� olmas�</option>
<option value='Olumsuz ��retmen tutumlar�.'>Olumsuz ��retmen tutumlar�.</option>
<option value='Oturulan yerle�im yerinin sosyal,  k�lt�rel ve fiziki  sorunlar� '>Oturulan yerle�im yerinin sosyal,  k�lt�rel ve fiziki  sorunlar� </option>
<option value='��rencilerin ilgi ve yetenekleri do�rultusuna �st ��renime devam etmemeleri'>��rencilerin ilgi ve yetenekleri do�rultusuna �st ��renime devam etmemeleri</option>
<option value='Problem ��zme becerilerinin geli�memesi.'>Problem ��zme becerilerinin geli�memesi.</option>
<option value='Problem ��zme ve problemlerle ba� etme becerilerinin geli�memesi.'>Problem ��zme ve problemlerle ba� etme becerilerinin geli�memesi.</option>
<option value='S�k s�k okuldan ka�ma,'>S�k s�k okuldan ka�ma,</option>
<option value='S�nav kayg�s�.'>S�nav kayg�s�.</option>
<option value='S�n�f say�lar�n�n kalabal�k olu�u.'>S�n�f say�lar�n�n kalabal�k olu�u.</option>
<option value='Sosyal g�venlik haklar�ndan mahrumiyet'>Sosyal g�venlik haklar�ndan mahrumiyet</option>
<option value='Sosyoekonomik farkl�l�klar�n �ok olmas�.'>Sosyoekonomik farkl�l�klar�n �ok olmas�.</option>
<option value='Spor alanlar�n�n ve organizasyonlar�n yetersizli�i'>Spor alanlar�n�n ve organizasyonlar�n yetersizli�i</option>
<option value='Ta��mal� e�itimin yayg�n olmas�'>Ta��mal� e�itimin yayg�n olmas�</option>
<option value='Terk edilmi� ya da evsiz olmak'>Terk edilmi� ya da evsiz olmak</option>

</select>

<?php
/* �PTAL ===========================================================
$sql="SELECT DISTINCT riskfaktorleri from $tablo where riskfaktorleri<>'' ORDER BY riskfaktorleri ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);

$riskfaktorleri=array(
'Aile i�i ileti�imin yetersizli�i',
'Par�alanm�� aile(Bo�anma-�l�m).',
'Aile yap�s�(Geni� aile, �ocuk say�s�n�n fazla olmas�)',
'Ailelerin e�itimsizli�i',
'Sosyo-ekonomik durum.',
'Ailenin tutars�z disiplin anlay���',
'Ku�aklar aras� �at��ma',
'D�zensiz ve dengesiz beslenme',
'Ana-baban�n olumsuz model olmas�(sigara ya da alkol ba��ml�l���)',
'Akademik ba�ar�s�zl�k ',
'Aile ile ileti�imsizlik ',
'Ki�ilik �zellikleri ',
'Ergenlik d�nemi problemleri',
'Arkada� ili�kileri ile ilgili problemler',
'Okul devams�zl���',
'�lgi ve yeteneklerini yeterince tan�mama.',
'Teknolojinin yanl�� kullan�m�',
'Motivasyon eksikli�i-Hedefsizlik',
'Hiperaktivite, davran�m bozuklu�u, s�re�en hastal�klar ve �zel e�itim ',
'Olumsuz aile �evre ili�kileri ',
'Yanl�� ve olumsuz �rnekler ',
'Olumsuz �rneklerin yaz�l� ve g�rsel bas�nda g�ndemde tutulmas�.',
'Gen�lerin zamanlar�n� olumlu bir �ekilde de�erlendirebilecekleri, spor alanlar�n�n, sosyal etkinliklerin yetersizli�i',
'��renci servislerine dayal� olumsuzluklar',
'Bilgisayar oyunlar�, ',
'Okullar�n fiziksel yap�lar�ndaki eksiklikler',
'Okullarda sosyal faaliyetlerdeki yetersizlikler',
'S�n�f mevcutlar�n�n fazlal���  ',
'Okul aile ileti�iminin yetersizli�i',
'E�itim �al��anlar�n�n olumsuz davran�� tutumlar�',
'Okul aile i�birli�i yetersizli�i'
);

foreach ($riskfaktorleri as $risk){

	echo "<option value='".$risk."'>".$risk."</option>\n";
}

if ($sonuc){
	while ($satir=$sonuc->fetch_array()){
		$risk=$satir['riskfaktorleri'];
		if (in_array($risk, $riskfaktorleri)===false){
			echo "<option value='".$risk."'>".$risk."</option>\n";
		}
	}
}

*/

?>



<?php $veritabani->close(); ?>
</body>
</html>
