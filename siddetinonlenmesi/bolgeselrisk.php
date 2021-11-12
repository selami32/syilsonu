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
<option value='Aile içi çatışma ve şiddet,'>Aile içi çatışma ve şiddet,</option>
<option value='Ailelerin eğitim düzeylerinin düşük olması'>Ailelerin eğitim düzeylerinin düşük olması</option>
<option value='Ailenin çocuğu bırakarak çalışmaya gitmesi.'>Ailenin çocuğu bırakarak çalışmaya gitmesi.</option>
<option value='Akademik başarının ön planda tutulması'>Akademik başarının ön planda tutulması</option>
<option value='Akranları tarafından red edilmesi'>Akranları tarafından red edilmesi</option>
<option value='Ana babalardan biri ya da ikisinin alkol yada madde kullanımı problemlerinin olması.'>Ana babalardan biri ya da ikisinin alkol yada madde kullanımı problemlerinin olması.</option>
<option value='Ana babalardan biri ya da ikisinin ruhsal hastalığının olması '>Ana babalardan biri ya da ikisinin ruhsal hastalığının olması </option>
<option value='Anne ve babanın ayrı yaşaması'>Anne ve babanın ayrı yaşaması</option>
<option value='Aşırı baskıcı tutarsız ana-baba tutumları.'>Aşırı baskıcı tutarsız ana-baba tutumları.</option>
<option value='Aşırı televizyon izleme.'>Aşırı televizyon izleme.</option>
<option value='Aşırı yoksulluk'>Aşırı yoksulluk</option>
<option value='Boşanma,'>Boşanma,</option>
<option value='Çete üyeliği,'>Çete üyeliği,</option>
<option value='Çevrede intiharlar örneklerinin fazla olması'>Çevrede intiharlar örneklerinin fazla olması</option>
<option value='Çocuk ihmali veya istismarı.( Fiziksel, Duygusal, Cinsel İstismar)'>Çocuk ihmali veya istismarı.( Fiziksel, Duygusal, Cinsel İstismar)</option>
<option value='Hedefsizlik ve motivasyon eksikliği.'>Hedefsizlik ve motivasyon eksikliği.</option>
<option value='İlgisiz anne baba tutumları'>İlgisiz anne baba tutumları</option>
<option value='İnternet bağımlılığı'>İnternet bağımlılığı</option>
<option value='İşsizlik, maddi sıkıntılar.'>İşsizlik, maddi sıkıntılar.</option>
<option value='Kendine güvensizlik, gelişmemiş sosyal beceriler.'>Kendine güvensizlik, gelişmemiş sosyal beceriler.</option>
<option value='Kronik, tedavi edilmemiş fiziksel hastalığının ya da engelinin olması,'>Kronik, tedavi edilmemiş fiziksel hastalığının ya da engelinin olması,</option>
<option value='Kuşaklar arası çatışma.'>Kuşaklar arası çatışma.</option>
<option value='Maddenin kötüye kullanımı'>Maddenin kötüye kullanımı</option>
<option value='Okul Başarısızlığı.'>Okul Başarısızlığı.</option>
<option value='Okul çevresindeki internet cafe, oyun salonları vb olması'>Okul çevresindeki internet cafe, oyun salonları vb olması</option>
<option value='Okul kantinlerinin denetiminin yetersizliği'>Okul kantinlerinin denetiminin yetersizliği</option>
<option value='Okuldan kaçma.'>Okuldan kaçma.</option>
<option value='Okulun Fiziki yapısının kötü olması'>Okulun Fiziki yapısının kötü olması</option>
<option value='Olumsuz Öğretmen tutumları.'>Olumsuz Öğretmen tutumları.</option>
<option value='Oturulan yerleşim yerinin sosyal,  kültürel ve fiziki  sorunları '>Oturulan yerleşim yerinin sosyal,  kültürel ve fiziki  sorunları </option>
<option value='Öğrencilerin ilgi ve yetenekleri doğrultusuna üst öğrenime devam etmemeleri'>Öğrencilerin ilgi ve yetenekleri doğrultusuna üst öğrenime devam etmemeleri</option>
<option value='Problem çözme becerilerinin gelişmemesi.'>Problem çözme becerilerinin gelişmemesi.</option>
<option value='Problem çözme ve problemlerle baş etme becerilerinin gelişmemesi.'>Problem çözme ve problemlerle baş etme becerilerinin gelişmemesi.</option>
<option value='Sık sık okuldan kaçma,'>Sık sık okuldan kaçma,</option>
<option value='Sınav kaygısı.'>Sınav kaygısı.</option>
<option value='Sınıf sayılarının kalabalık oluşu.'>Sınıf sayılarının kalabalık oluşu.</option>
<option value='Sosyal güvenlik haklarından mahrumiyet'>Sosyal güvenlik haklarından mahrumiyet</option>
<option value='Sosyoekonomik farklılıkların çok olması.'>Sosyoekonomik farklılıkların çok olması.</option>
<option value='Spor alanlarının ve organizasyonların yetersizliği'>Spor alanlarının ve organizasyonların yetersizliği</option>
<option value='Taşımalı eğitimin yaygın olması'>Taşımalı eğitimin yaygın olması</option>
<option value='Terk edilmiş ya da evsiz olmak'>Terk edilmiş ya da evsiz olmak</option>

</select>

<?php
/* İPTAL ===========================================================
$sql="SELECT DISTINCT riskfaktorleri from $tablo where riskfaktorleri<>'' ORDER BY riskfaktorleri ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);

$riskfaktorleri=array(
'Aile içi iletişimin yetersizliği',
'Parçalanmış aile(Boşanma-ölüm).',
'Aile yapısı(Geniş aile, çocuk sayısının fazla olması)',
'Ailelerin eğitimsizliği',
'Sosyo-ekonomik durum.',
'Ailenin tutarsız disiplin anlayışı',
'Kuşaklar arası çatışma',
'Düzensiz ve dengesiz beslenme',
'Ana-babanın olumsuz model olması(sigara ya da alkol bağımlılığı)',
'Akademik başarısızlık ',
'Aile ile iletişimsizlik ',
'Kişilik özellikleri ',
'Ergenlik dönemi problemleri',
'Arkadaş ilişkileri ile ilgili problemler',
'Okul devamsızlığı',
'İlgi ve yeteneklerini yeterince tanımama.',
'Teknolojinin yanlış kullanımı',
'Motivasyon eksikliği-Hedefsizlik',
'Hiperaktivite, davranım bozukluğu, süreğen hastalıklar ve özel eğitim ',
'Olumsuz aile çevre ilişkileri ',
'Yanlış ve olumsuz örnekler ',
'Olumsuz örneklerin yazılı ve görsel basında gündemde tutulması.',
'Gençlerin zamanlarını olumlu bir şekilde değerlendirebilecekleri, spor alanlarının, sosyal etkinliklerin yetersizliği',
'Öğrenci servislerine dayalı olumsuzluklar',
'Bilgisayar oyunları, ',
'Okulların fiziksel yapılarındaki eksiklikler',
'Okullarda sosyal faaliyetlerdeki yetersizlikler',
'Sınıf mevcutlarının fazlalığı  ',
'Okul aile iletişiminin yetersizliği',
'Eğitim çalışanlarının olumsuz davranış tutumları',
'Okul aile işbirliği yetersizliği'
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
