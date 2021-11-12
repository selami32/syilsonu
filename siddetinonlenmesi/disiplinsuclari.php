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
$tablo=$onek."disiplinsuclari";
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
			intval($row['ilkogretimuyarma']) ."','" .
			intval($row['ilkogretimkinama']) ."','" .
			intval($row['ilkogretimokuldeg']) ."','".
			intval($row['ortaogretimmahrukinama']) ."','".
			intval($row['ortaogretimkisauzak']) ."','".
			intval($row['ortaogretimtasdikname']) ."','".
			intval($row['ortaogretimorgunegitimdisi']) ."'],\n";
	   
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
<option value=''>***a) Uyarma yaptırımını gerektiren davranışlar: </option>
<option value='1) Derse ve diğer etkinliklere vaktinde gelmemek ve geçerli bir neden olmaksızın bu davranışı tekrar etmek.'>1) Derse ve diğer etkinliklere vaktinde gelmemek ve geçerli bir neden olmaksızın bu davranışı tekrar etmek.</option>
<option value='2) Okula özürsüz devamsızlığını, özür bildirim formu ya da raporla belgelendirmemek, bunu alışkanlık hâline getirmek, okul yönetimi tarafından verilen izin süresini özürsüz uzatmak.'>2) Okula özürsüz devamsızlığını, özür bildirim formu ya da raporla belgelendirmemek, bunu alışkanlık hâline getirmek, okul yönetimi tarafından verilen izin süresini özürsüz uzatmak.</option>
<option value='3) Yatılı bölge ortaokullarında öğrenci dolaplarını farklı amaçlarla kullanmak, yasaklanmış malzemeyi dolapta bulundurmak ve yönetime bilgi vermeden dolabını bir başkasına devretmek.'>3) Yatılı bölge ortaokullarında öğrenci dolaplarını farklı amaçlarla kullanmak, yasaklanmış malzemeyi dolapta bulundurmak ve yönetime bilgi vermeden dolabını bir başkasına devretmek.</option>
<option value='4) Okula, yönetimce yasaklanmış malzeme getirmek ve bunları kullanmak. '>4) Okula, yönetimce yasaklanmış malzeme getirmek ve bunları kullanmak. </option>
<option value='5) Yalan söylemeyi alışkanlık hâline getirmek.'>5) Yalan söylemeyi alışkanlık hâline getirmek.</option>
<option value='6) Duvarları, sıraları ve okul çevresini kirletmek.'>6) Duvarları, sıraları ve okul çevresini kirletmek.</option>
<option value='7) Görgü kurallarına uymamak.'>7) Görgü kurallarına uymamak.</option>
<option value='8) (Okul kütüphanesinden veya laboratuvarlardan aldığı kitap, araç-gereç ve malzemeyi zamanında teslim etmemek veya geri vermemek.'>8) (Okul kütüphanesinden veya laboratuvarlardan aldığı kitap, araç-gereç ve malzemeyi zamanında teslim etmemek veya geri vermemek.</option>
<option value=''>***b) Kınama yaptırımını gerektiren davranışlar: </option>
<option value='1) Yöneticilere, öğretmenlere, görevlilere ve arkadaşlarına kaba ve saygısız davranmak.'>1) Yöneticilere, öğretmenlere, görevlilere ve arkadaşlarına kaba ve saygısız davranmak.</option>
<option value='2) Okulun kurallarını dikkate almayarak, kuralları ve ders ortamını bozmak, ders ve ders dışı etkinliklerin yapılmasını engellemek.'>2) Okulun kurallarını dikkate almayarak, kuralları ve ders ortamını bozmak, ders ve ders dışı etkinliklerin yapılmasını engellemek.</option>
<option value='3)  Kopya çekmek veya çekilmesine yardımcı olmak,'>3)  Kopya çekmek veya çekilmesine yardımcı olmak,</option>
<option value=' Resmî evrakta değişiklik yapmak'> Resmî evrakta değişiklik yapmak</option>
<option value='4) Okulda bulunduğu hâlde törenlere özürsüz olarak katılmamak ve törenlerde uygun olmayan davranışlarda bulunmak.'>4) Okulda bulunduğu hâlde törenlere özürsüz olarak katılmamak ve törenlerde uygun olmayan davranışlarda bulunmak.</option>
<option value='5) Kılık-kıyafete ilişkin mevzuat hükümlerine uymamak,'>5) Kılık-kıyafete ilişkin mevzuat hükümlerine uymamak,</option>
<option value='6) Tütün ve tütün mamullerini bulundurmak veya içmek,'>6) Tütün ve tütün mamullerini bulundurmak veya içmek,</option>
<option value='7) Okulda kavga etmek.'>7) Okulda kavga etmek.</option>
<option value='8) Okulun araç-gerecine zarar vermek.'>8) Okulun araç-gerecine zarar vermek.</option>
<option value='9) Okulu, çevresini ve eşyasını kirletmek,'>9) Okulu, çevresini ve eşyasını kirletmek,</option>
<option value='10) Başkasına ait eşyayı izinsiz almak veya kullanmak,'>10) Başkasına ait eşyayı izinsiz almak veya kullanmak,</option>
<option value='11) Öğrencilerin eşya ve araç-gerecine kasıtlı olarak zarar vermek.'>11) Öğrencilerin eşya ve araç-gerecine kasıtlı olarak zarar vermek.</option>
<option value='12) Yapması gereken görevleri yapmamak,'>12) Yapması gereken görevleri yapmamak,</option>
<option value='13) Okul ile ilgili mekân ve malzemeyi izinsiz ve eğitimin amaçları dışında kullanmak.'>13) Okul ile ilgili mekân ve malzemeyi izinsiz ve eğitimin amaçları dışında kullanmak.</option>
<option value='14) Yatılı okullarda pansiyonu gece izinsiz terk etmek veya pansiyona geç gelmek'>14) Yatılı okullarda pansiyonu gece izinsiz terk etmek veya pansiyona geç gelmek</option>
<option value='15)Yalan söylemek,'>15)Yalan söylemek,</option>
<option value='16) Okul kütüphanesi, atölye, laboratuvar, pansiyon veya diğer bölümlerden aldığı kitap, araç-gereç ve malzemeyi zamanında vermemek, eksik vermek veya kötü kullanmak'>16) Okul kütüphanesi, atölye, laboratuvar, pansiyon veya diğer bölümlerden aldığı kitap, araç-gereç ve malzemeyi zamanında vermemek, eksik vermek veya kötü kullanmak</option>
<option value='17) Yasaklanmış, müstehcen yayınları okula ve okula bağlı yerlere sokmak veya yanında bulundurmak,'>17) Yasaklanmış, müstehcen yayınları okula ve okula bağlı yerlere sokmak veya yanında bulundurmak,</option>
<option value='18) Üzerinde kumar oynamaya yarayan araç-gereç bulundurmak,'>18) Üzerinde kumar oynamaya yarayan araç-gereç bulundurmak,</option>
<option value='19) Bilişim araçlarını amacı dışında kullanmak,'>19) Bilişim araçlarını amacı dışında kullanmak,</option>
<option value='20) Alınan sağlık ve güvenlik tedbirlerine uymamak.'>20) Alınan sağlık ve güvenlik tedbirlerine uymamak.</option>
<option value=''>***(2) Okuldan kısa süreli uzaklaştırma cezasını gerektiren fiil ve davranışlar;</option>
<option value='a) Kişilere, arkadaşlarına söz ve davranışlarla sarkıntılık, hakaret ve iftira etmek veya başkalarını bu gibi davranışlara kışkırtmak, '>a) Kişilere, arkadaşlarına söz ve davranışlarla sarkıntılık, hakaret ve iftira etmek veya başkalarını bu gibi davranışlara kışkırtmak, </option>
<option value='b) Pansiyonu terk ederek gece izinsiz dışarıda kalmak, '>b) Pansiyonu terk ederek gece izinsiz dışarıda kalmak, </option>
<option value='c) Kişileri veya grupları dil, ırk, cinsiyet, siyasi düşünce, felsefi ve dini inançlarına göre ayırmayı, kınamayı, kötülemeyi amaçlayan davranışlarda bulunmak veya ayrımcılığı körükleyici semboller taşımak,'>c) Kişileri veya grupları dil, ırk, cinsiyet, siyasi düşünce, felsefi ve dini inançlarına göre ayırmayı, kınamayı, kötülemeyi amaçlayan davranışlarda bulunmak veya ayrımcılığı körükleyici semboller taşımak,</option>
<option value='ç) İzinsiz gösteri veya toplantı düzenlemek, bu tür gösteri veya toplantılara katılmak ve bu amaçla yapılan etkinliklerde bulunmak,'>ç) İzinsiz gösteri veya toplantı düzenlemek, bu tür gösteri veya toplantılara katılmak ve bu amaçla yapılan etkinliklerde bulunmak,</option>
<option value='d) Her türlü ortamda kumar oynamak veya oynatmak,'>d) Her türlü ortamda kumar oynamak veya oynatmak,</option>
<option value='e) Verilen görevlerin yapılmasına engel olmak,'>e) Verilen görevlerin yapılmasına engel olmak,</option>
<option value='f) Başkalarına hakaret etmek, '>f) Başkalarına hakaret etmek, </option>
<option value='g) Yasaklanmış veya müstehcen yayın, kitap, dergi, broşür, gazete, bildiri, beyanname, ilan ve benzerlerini dağıtmak, duvarlara ve diğer yerlere asmak, yapıştırmak, yazmak; bu amaçlar için okul araç-gerecini ve eklentilerini kullanmak,'>g) Yasaklanmış veya müstehcen yayın, kitap, dergi, broşür, gazete, bildiri, beyanname, ilan ve benzerlerini dağıtmak, duvarlara ve diğer yerlere asmak, yapıştırmak, yazmak; bu amaçlar için okul araç-gerecini ve eklentilerini kullanmak,</option>
<option value='ğ) Bilişim araçları yoluyla eğitim ve öğretim faaliyetleriyle kişilere zarar vermek,'>ğ) Bilişim araçları yoluyla eğitim ve öğretim faaliyetleriyle kişilere zarar vermek,</option>
<option value='h) Özürsüz devamsızlık yapmayı, okula geldiği hâlde özürsüz eğitim ve öğretim faaliyetlerine, törenlere ve diğer sosyal etkinliklere katılmamayı, geç katılmayı veya erken ayrılmayı alışkanlık haline getirmek,'>h) Özürsüz devamsızlık yapmayı, okula geldiği hâlde özürsüz eğitim ve öğretim faaliyetlerine, törenlere ve diğer sosyal etkinliklere katılmamayı, geç katılmayı veya erken ayrılmayı alışkanlık haline getirmek,</option>
<option value='ı) Kavga etmek, başkalarına fiili şiddet uygulamak,'>ı) Kavga etmek, başkalarına fiili şiddet uygulamak,</option>
<option value='i) Okul binası, eklenti ve donanımlarına, arkadaşlarının araç-gerecine siyasi, ideolojik veya müstehcen amaçlı yazılar yazmak, resim veya semboller çizmek,'>i) Okul binası, eklenti ve donanımlarına, arkadaşlarının araç-gerecine siyasi, ideolojik veya müstehcen amaçlı yazılar yazmak, resim veya semboller çizmek,</option>
<option value='j) Toplu kopya çekmek veya çekilmesine yardımcı olmak,'>j) Toplu kopya çekmek veya çekilmesine yardımcı olmak,</option>
<option value='k) Sarhoşluk veren zararlı maddeleri bulundurmak veya kullanmak.'>k) Sarhoşluk veren zararlı maddeleri bulundurmak veya kullanmak.</option>
<option value=''>***c) Okul Değiştirme yaptırımını gerektiren davranışlar:</option>
<option value='1) Anayasanın başlangıcında belirtilen temel ilkelere dayalı millî, demokratik, lâik ve sosyal bir hukuk devleti niteliklerine aykırı davranışlarda bulunmak veya başkalarını da bu tür davranışlara zorlamak. * Türk Bayrağına, ülkeyi, milleti ve devleti temsil eden sembollere saygısızlık etmek,  * Millî ve manevi değerleri söz, yazı, resim veya başka bir şekilde aşağılamak; bu değerlere küfür ve hakaret etmek,'>1) Anayasanın başlangıcında belirtilen temel ilkelere dayalı millî, demokratik, lâik ve sosyal bir hukuk devleti niteliklerine aykırı davranışlarda bulunmak veya başkalarını da bu tür davranışlara zorlamak. * Türk Bayrağına, ülkeyi, milleti ve devleti temsil eden sembollere saygısızlık etmek,  * Millî ve manevi değerleri söz, yazı, resim veya başka bir şekilde aşağılamak; bu değerlere küfür ve hakaret etmek,</option>
<option value='2) Sarkıntılık, hakaret, iftira, tehdit ve taciz etmek veya başkalarını bu gibi davranışlara kışkırtmak.'>2) Sarkıntılık, hakaret, iftira, tehdit ve taciz etmek veya başkalarını bu gibi davranışlara kışkırtmak.</option>
<option value='3) Okula yaralayıcı, öldürücü aletler getirmek ve bunları bulundurmak.'>3) Okula yaralayıcı, öldürücü aletler getirmek ve bunları bulundurmak.</option>
<option value='4) Okul ve çevresinde kasıtlı olarak yangın çıkarmak.'>4) Okul ve çevresinde kasıtlı olarak yangın çıkarmak.</option>
<option value='5) Okul sınırları içinde herhangi bir yeri, izinsiz olarak eğitim ve öğretim amaçları dışında kullanmak veya kullanılmasına yardımcı olmak,'>5) Okul sınırları içinde herhangi bir yeri, izinsiz olarak eğitim ve öğretim amaçları dışında kullanmak veya kullanılmasına yardımcı olmak,</option>
<option value='6) Eğitim ve öğretim ortamında siyasi partilerin, bu partilere bağlı yan kuruluşların, derneklerin, sendikaların ve benzeri kuruluşların siyasi ve ideolojik görüşleri doğrultusunda eylem düzenlemek, başkalarını bu gibi eylemleri düzenlemeye kışkırtmak, düzenlenmiş eylemlere etkin biçimde katılmak,'>6) Eğitim ve öğretim ortamında siyasi partilerin, bu partilere bağlı yan kuruluşların, derneklerin, sendikaların ve benzeri kuruluşların siyasi ve ideolojik görüşleri doğrultusunda eylem düzenlemek, başkalarını bu gibi eylemleri düzenlemeye kışkırtmak, düzenlenmiş eylemlere etkin biçimde katılmak,</option>
<option value='Siyasi partilere, bu partilere bağlı yan kuruluşlara, derneklere, sendikalara ve benzeri kuruluşlara üye olmak, üye kaydetmek, para toplamak ve bağışta bulunmaya zorlamak'>Siyasi partilere, bu partilere bağlı yan kuruluşlara, derneklere, sendikalara ve benzeri kuruluşlara üye olmak, üye kaydetmek, para toplamak ve bağışta bulunmaya zorlamak</option>
<option value='7) Herhangi bir kurum ve örgüt adına yardım ve para toplamak. '>7) Herhangi bir kurum ve örgüt adına yardım ve para toplamak. </option>
<option value='8) Kişi veya grupları dil, ırk, cinsiyet, siyasî düşünce ve inançlarına göre ayırmak, kınamak, kötülemek ve bu tür eylemlere katılmak. '>8) Kişi veya grupları dil, ırk, cinsiyet, siyasî düşünce ve inançlarına göre ayırmak, kınamak, kötülemek ve bu tür eylemlere katılmak. </option>
<option value='9) Başkasının malına zarar vermek, haberi olmadan almayı alışkanlık hâline getirmek. '>9) Başkasının malına zarar vermek, haberi olmadan almayı alışkanlık hâline getirmek. </option>
<option value='10) Okulun bina, eklenti ve donanımlarını, taşınır ve taşınmaz mallarını kasıtlı olarak tahrip etmek. '>10) Okulun bina, eklenti ve donanımlarını, taşınır ve taşınmaz mallarını kasıtlı olarak tahrip etmek. </option>
<option value='11) Ders, sınav, uygulama ve diğer faaliyetlerin yapılmasını engellemek veya arkadaşlarını bu eylemlere katılmaya kışkırtmak,'>11) Ders, sınav, uygulama ve diğer faaliyetlerin yapılmasını engellemek veya arkadaşlarını bu eylemlere katılmaya kışkırtmak,</option>
<option value='12) Okul içinde ve dışında okul yöneticilerine, öğretmenlere ve diğer personele karşı saldırıda bulunmak, bu gibi hareketleri düzenlemek veya kışkırtmak.'>12) Okul içinde ve dışında okul yöneticilerine, öğretmenlere ve diğer personele karşı saldırıda bulunmak, bu gibi hareketleri düzenlemek veya kışkırtmak.</option>
<option value='13) Yatılı bölge ortaokullarında gece izinsiz olarak dışarıda kalmayı alışkanlık hâline getirmek.'>13) Yatılı bölge ortaokullarında gece izinsiz olarak dışarıda kalmayı alışkanlık hâline getirmek.</option>
<option value='14) Okul ile ilişiği olmayan kişileri okulda veya okula ait yerlerde barındırmak. '>14) Okul ile ilişiği olmayan kişileri okulda veya okula ait yerlerde barındırmak. </option>
<option value='15) Kendi yerine başkalarını sınava katmak, başkasının yerine sınava girmek. '>15) Kendi yerine başkalarını sınava katmak, başkasının yerine sınava girmek. </option>
<option value='Zor kullanarak veya tehditle kopya çekmek veya çekilmesini sağlamak,'>Zor kullanarak veya tehditle kopya çekmek veya çekilmesini sağlamak,</option>
<option value='16) Başkalarını, alkol veya bağımlılık yapan maddeleri kullanmaya teşvik etmek.'>16) Başkalarını, alkol veya bağımlılık yapan maddeleri kullanmaya teşvik etmek.</option>
<option value='17) Kılık ve kıyafet yönetmeliğine uymamakta ısrar etmek. '>17) Kılık ve kıyafet yönetmeliğine uymamakta ısrar etmek. </option>
<option value='18) Okul çalışanlarının görevlerini yapmalarına engel olmak,'>18) Okul çalışanlarının görevlerini yapmalarına engel olmak,</option>
<option value='19) Hırsızlık yapmak, yaptırmak ve yapılmasına yardımcı olmak,'>19) Hırsızlık yapmak, yaptırmak ve yapılmasına yardımcı olmak,</option>
<option value='20) Okul tarafından verilen belgelerde değişiklik yapmak; sahte belge düzenlemek; üzerinde değişiklik yapılmış belgeleri kullanmak veya bu belgelerin sağladığı haklardan yararlanmak ve başkalarını yararlandırmak,'>20) Okul tarafından verilen belgelerde değişiklik yapmak; sahte belge düzenlemek; üzerinde değişiklik yapılmış belgeleri kullanmak veya bu belgelerin sağladığı haklardan yararlanmak ve başkalarını yararlandırmak,</option>
<option value='21) Bağımlılık yapan zararlı maddeleri bulundurmak veya kullanmak'>21) Bağımlılık yapan zararlı maddeleri bulundurmak veya kullanmak</option>
<option value='22) Bilişim araçları yoluyla eğitim ve öğretimi engellemek, kişilere ağır derecede maddi ve manevi zarar vermek,'>22) Bilişim araçları yoluyla eğitim ve öğretimi engellemek, kişilere ağır derecede maddi ve manevi zarar vermek,</option>
<option value='23) İzin almadan okulla ilgili; bilgi vermek, basın toplantısı yapmak, bildiri yayınlamak ve dağıtmak, faaliyet tertip etmek veya bu kapsamdaki faaliyetlerde etkin rol almak'>23) İzin almadan okulla ilgili; bilgi vermek, basın toplantısı yapmak, bildiri yayınlamak ve dağıtmak, faaliyet tertip etmek veya bu kapsamdaki faaliyetlerde etkin rol almak</option>
<option value=''>***(4) Örgün eğitim dışına çıkarma cezasını gerektiren davranışlar;</option>
<option value='a) Türk Bayrağına, ülkeyi, milleti ve devleti temsil eden sembollere hakaret etmek,'>a) Türk Bayrağına, ülkeyi, milleti ve devleti temsil eden sembollere hakaret etmek,</option>
<option value='b) Türkiye Cumhuriyeti´nin devleti ve milletiyle bölünmez bütünlüğü ilkesine ve Türkiye Cumhuriyetinin insan haklarına ve Anayasanın başlangıcında belirtilen temel ilkelere dayalı millî, demokratik, laik ve sosyal bir hukuk devleti niteliklerine aykırı miting, forum, direniş, yürüyüş, boykot ve işgal gibi ferdi veya toplu eylemler düzenlemek; düzenlenmesini kışkırtmak ve düzenlenmiş bu gibi eylemlere etkin olarak katılmak veya katılmaya zorlamak,'>b) Türkiye Cumhuriyeti´nin devleti ve milletiyle bölünmez bütünlüğü ilkesine ve Türkiye Cumhuriyetinin insan haklarına ve Anayasanın başlangıcında belirtilen temel ilkelere dayalı millî, demokratik, laik ve sosyal bir hukuk devleti niteliklerine aykırı miting, forum, direniş, yürüyüş, boykot ve işgal gibi ferdi veya toplu eylemler düzenlemek; düzenlenmesini kışkırtmak ve düzenlenmiş bu gibi eylemlere etkin olarak katılmak veya katılmaya zorlamak,</option>
<option value='c) Kişileri veya grupları; dil, ırk, cinsiyet, siyasi düşünce, felsefi ve dini inançlarına göre ayırmayı, kınamayı, kötülemeyi amaçlayan bölücü ve yıkıcı toplu eylemler düzenlemek, katılmak, bu eylemlerin organizasyonunda yer almak, '>c) Kişileri veya grupları; dil, ırk, cinsiyet, siyasi düşünce, felsefi ve dini inançlarına göre ayırmayı, kınamayı, kötülemeyi amaçlayan bölücü ve yıkıcı toplu eylemler düzenlemek, katılmak, bu eylemlerin organizasyonunda yer almak, </option>
<option value='ç) Kurul ve komisyonların çalışmasını tehdit veya zor kullanarak engellemek,'>ç) Kurul ve komisyonların çalışmasını tehdit veya zor kullanarak engellemek,</option>
<option value='d) Bağımlılık yapan zararlı maddelerin ticaretini yapmak,'>d) Bağımlılık yapan zararlı maddelerin ticaretini yapmak,</option>
<option value='e) Okul ve eklentilerinde güvenlik güçlerince aranan kişileri saklamak ve barındırmak,'>e) Okul ve eklentilerinde güvenlik güçlerince aranan kişileri saklamak ve barındırmak,</option>
<option value='f) Eğitim ve öğretim ortamını işgal etmek, '>f) Eğitim ve öğretim ortamını işgal etmek, </option>
<option value='g) Okul içinde ve dışında tek veya toplu hâlde okulun yönetici, öğretmen, eğitici personel, memur ve diğer personeline karşı saldırıda bulunmak, bu gibi hareketleri düzenlemek veya kışkırtmak, '>g) Okul içinde ve dışında tek veya toplu hâlde okulun yönetici, öğretmen, eğitici personel, memur ve diğer personeline karşı saldırıda bulunmak, bu gibi hareketleri düzenlemek veya kışkırtmak, </option>
<option value='ğ) Okul çalışanlarının görevlerini yapmalarına engel olmak için fiili saldırıda bulunmak ve başkalarını bu yöndeki eylemlere kışkırtmak, '>ğ) Okul çalışanlarının görevlerini yapmalarına engel olmak için fiili saldırıda bulunmak ve başkalarını bu yöndeki eylemlere kışkırtmak, </option>
<option value='h) Okulun taşınır veya taşınmaz mallarını kasıtlı olarak tahrip etmek,'>h) Okulun taşınır veya taşınmaz mallarını kasıtlı olarak tahrip etmek,</option>
<option value='ı) Yaralayıcı, öldürücü her türlü alet, silah, patlayıcı maddeleri kullanmak suretiyle bir kimseyi yaralamaya teşebbüs etmek, yaralamak, öldürmek, maddi veya manevi zarara yol açmak,'>ı) Yaralayıcı, öldürücü her türlü alet, silah, patlayıcı maddeleri kullanmak suretiyle bir kimseyi yaralamaya teşebbüs etmek, yaralamak, öldürmek, maddi veya manevi zarara yol açmak,</option>
<option value='i) Kişi veya kişilere her ne sebeple olursa olsun eziyet etmek; işkence yapmak veya yaptırmak, cinsel istismar ve bu konuda kanunların suç saydığı fiilleri işlemek,'>i) Kişi veya kişilere her ne sebeple olursa olsun eziyet etmek; işkence yapmak veya yaptırmak, cinsel istismar ve bu konuda kanunların suç saydığı fiilleri işlemek,</option>
<option value='j) Çete kurmak, çetede yer almak, yol kesmek, adam kaçırmak; kapkaç ve gasp yapmak, fidye ve haraç almak,'>j) Çete kurmak, çetede yer almak, yol kesmek, adam kaçırmak; kapkaç ve gasp yapmak, fidye ve haraç almak,</option>
<option value='k) Yasa dışı örgütlerin ve kuruluşların, siyasi ve ideolojik görüşleri doğrultusunda propaganda yapmak, eylem düzenlemek, başkalarını bu gibi eylemleri düzenlemeye kışkırtmak, düzenlenmiş eylemlere etkin biçimde katılmak, bu kuruluşlara üye olmak, üye kaydetmek; para toplamak ve bağışta bulunmaya zorlamak,'>k) Yasa dışı örgütlerin ve kuruluşların, siyasi ve ideolojik görüşleri doğrultusunda propaganda yapmak, eylem düzenlemek, başkalarını bu gibi eylemleri düzenlemeye kışkırtmak, düzenlenmiş eylemlere etkin biçimde katılmak, bu kuruluşlara üye olmak, üye kaydetmek; para toplamak ve bağışta bulunmaya zorlamak,</option>
<option value='l) Bilişim araçları yoluyla; bölücü, yıkıcı, ahlak dışı ve şiddeti özendiren sesli, sözlü, yazılı ve görüntülü içerikler oluşturmak, bunları çoğaltmak, yaymak ve ticaretini yapmak. '>l) Bilişim araçları yoluyla; bölücü, yıkıcı, ahlak dışı ve şiddeti özendiren sesli, sözlü, yazılı ve görüntülü içerikler oluşturmak, bunları çoğaltmak, yaymak ve ticaretini yapmak. </option>

</select>

<?php
/* İPTAL =================================
$sql="SELECT DISTINCT konu from $tablo where konu<>'' ORDER BY konu ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);

$disiplinolaylari=array(
'Kılık Kıyafet Yönetmeliği İhlali',
'Okul İdare ve Öğretmenlerine Hakaret, Saldırı',
'Öğretmen ve Arkadaşlara Saygısızlık',
'Okulda Alkol-Sigara Bulundurma',
'Ders Akışını Engelleme',
'Hırsızlık Yapma',
'Kavga',
'Okul eşyalarına Zarar Verme',
'Okul Kurallarına Uymama',
'Resmi Belgede Sahtecilik'
);

foreach ($disiplinolaylari as $disiplin){

	echo "<option value='".$disiplin."'>".$disiplin."</option>\n";
}

if ($sonuc){
	while ($satir=$sonuc->fetch_array()){
		$disiplinolayi=$satir['konu'];
		if (in_array($disiplinolayi, $disiplinolaylari)===false){
			echo "<option value='".$disiplinolayi."'>".$disiplinolayi."</option>\n";
		}
	}
}



?>
*/
?>

<?php $veritabani->close(); ?>
</body>
</html>
