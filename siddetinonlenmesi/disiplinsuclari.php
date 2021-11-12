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
<option value=''>***a) Uyarma yapt�r�m�n� gerektiren davran��lar: </option>
<option value='1) Derse ve di�er etkinliklere vaktinde gelmemek ve ge�erli bir neden olmaks�z�n bu davran��� tekrar etmek.'>1) Derse ve di�er etkinliklere vaktinde gelmemek ve ge�erli bir neden olmaks�z�n bu davran��� tekrar etmek.</option>
<option value='2) Okula �z�rs�z devams�zl���n�, �z�r bildirim formu ya da raporla belgelendirmemek, bunu al��kanl�k h�line getirmek, okul y�netimi taraf�ndan verilen izin s�resini �z�rs�z uzatmak.'>2) Okula �z�rs�z devams�zl���n�, �z�r bildirim formu ya da raporla belgelendirmemek, bunu al��kanl�k h�line getirmek, okul y�netimi taraf�ndan verilen izin s�resini �z�rs�z uzatmak.</option>
<option value='3) Yat�l� b�lge ortaokullar�nda ��renci dolaplar�n� farkl� ama�larla kullanmak, yasaklanm�� malzemeyi dolapta bulundurmak ve y�netime bilgi vermeden dolab�n� bir ba�kas�na devretmek.'>3) Yat�l� b�lge ortaokullar�nda ��renci dolaplar�n� farkl� ama�larla kullanmak, yasaklanm�� malzemeyi dolapta bulundurmak ve y�netime bilgi vermeden dolab�n� bir ba�kas�na devretmek.</option>
<option value='4) Okula, y�netimce yasaklanm�� malzeme getirmek ve bunlar� kullanmak. '>4) Okula, y�netimce yasaklanm�� malzeme getirmek ve bunlar� kullanmak. </option>
<option value='5) Yalan s�ylemeyi al��kanl�k h�line getirmek.'>5) Yalan s�ylemeyi al��kanl�k h�line getirmek.</option>
<option value='6) Duvarlar�, s�ralar� ve okul �evresini kirletmek.'>6) Duvarlar�, s�ralar� ve okul �evresini kirletmek.</option>
<option value='7) G�rg� kurallar�na uymamak.'>7) G�rg� kurallar�na uymamak.</option>
<option value='8) (Okul k�t�phanesinden veya laboratuvarlardan ald��� kitap, ara�-gere� ve malzemeyi zaman�nda teslim etmemek veya geri vermemek.'>8) (Okul k�t�phanesinden veya laboratuvarlardan ald��� kitap, ara�-gere� ve malzemeyi zaman�nda teslim etmemek veya geri vermemek.</option>
<option value=''>***b) K�nama yapt�r�m�n� gerektiren davran��lar: </option>
<option value='1) Y�neticilere, ��retmenlere, g�revlilere ve arkada�lar�na kaba ve sayg�s�z davranmak.'>1) Y�neticilere, ��retmenlere, g�revlilere ve arkada�lar�na kaba ve sayg�s�z davranmak.</option>
<option value='2) Okulun kurallar�n� dikkate almayarak, kurallar� ve ders ortam�n� bozmak, ders ve ders d��� etkinliklerin yap�lmas�n� engellemek.'>2) Okulun kurallar�n� dikkate almayarak, kurallar� ve ders ortam�n� bozmak, ders ve ders d��� etkinliklerin yap�lmas�n� engellemek.</option>
<option value='3)  Kopya �ekmek veya �ekilmesine yard�mc� olmak,'>3)  Kopya �ekmek veya �ekilmesine yard�mc� olmak,</option>
<option value=' Resm� evrakta de�i�iklik yapmak'> Resm� evrakta de�i�iklik yapmak</option>
<option value='4) Okulda bulundu�u h�lde t�renlere �z�rs�z olarak kat�lmamak ve t�renlerde uygun olmayan davran��larda bulunmak.'>4) Okulda bulundu�u h�lde t�renlere �z�rs�z olarak kat�lmamak ve t�renlerde uygun olmayan davran��larda bulunmak.</option>
<option value='5) K�l�k-k�yafete ili�kin mevzuat h�k�mlerine uymamak,'>5) K�l�k-k�yafete ili�kin mevzuat h�k�mlerine uymamak,</option>
<option value='6) T�t�n ve t�t�n mamullerini bulundurmak veya i�mek,'>6) T�t�n ve t�t�n mamullerini bulundurmak veya i�mek,</option>
<option value='7) Okulda kavga etmek.'>7) Okulda kavga etmek.</option>
<option value='8) Okulun ara�-gerecine zarar vermek.'>8) Okulun ara�-gerecine zarar vermek.</option>
<option value='9) Okulu, �evresini ve e�yas�n� kirletmek,'>9) Okulu, �evresini ve e�yas�n� kirletmek,</option>
<option value='10) Ba�kas�na ait e�yay� izinsiz almak veya kullanmak,'>10) Ba�kas�na ait e�yay� izinsiz almak veya kullanmak,</option>
<option value='11) ��rencilerin e�ya ve ara�-gerecine kas�tl� olarak zarar vermek.'>11) ��rencilerin e�ya ve ara�-gerecine kas�tl� olarak zarar vermek.</option>
<option value='12) Yapmas� gereken g�revleri yapmamak,'>12) Yapmas� gereken g�revleri yapmamak,</option>
<option value='13) Okul ile ilgili mek�n ve malzemeyi izinsiz ve e�itimin ama�lar� d���nda kullanmak.'>13) Okul ile ilgili mek�n ve malzemeyi izinsiz ve e�itimin ama�lar� d���nda kullanmak.</option>
<option value='14) Yat�l� okullarda pansiyonu gece izinsiz terk etmek veya pansiyona ge� gelmek'>14) Yat�l� okullarda pansiyonu gece izinsiz terk etmek veya pansiyona ge� gelmek</option>
<option value='15)Yalan s�ylemek,'>15)Yalan s�ylemek,</option>
<option value='16) Okul k�t�phanesi, at�lye, laboratuvar, pansiyon veya di�er b�l�mlerden ald��� kitap, ara�-gere� ve malzemeyi zaman�nda vermemek, eksik vermek veya k�t� kullanmak'>16) Okul k�t�phanesi, at�lye, laboratuvar, pansiyon veya di�er b�l�mlerden ald��� kitap, ara�-gere� ve malzemeyi zaman�nda vermemek, eksik vermek veya k�t� kullanmak</option>
<option value='17) Yasaklanm��, m�stehcen yay�nlar� okula ve okula ba�l� yerlere sokmak veya yan�nda bulundurmak,'>17) Yasaklanm��, m�stehcen yay�nlar� okula ve okula ba�l� yerlere sokmak veya yan�nda bulundurmak,</option>
<option value='18) �zerinde kumar oynamaya yarayan ara�-gere� bulundurmak,'>18) �zerinde kumar oynamaya yarayan ara�-gere� bulundurmak,</option>
<option value='19) Bili�im ara�lar�n� amac� d���nda kullanmak,'>19) Bili�im ara�lar�n� amac� d���nda kullanmak,</option>
<option value='20) Al�nan sa�l�k ve g�venlik tedbirlerine uymamak.'>20) Al�nan sa�l�k ve g�venlik tedbirlerine uymamak.</option>
<option value=''>***(2) Okuldan k�sa s�reli uzakla�t�rma cezas�n� gerektiren fiil ve davran��lar;</option>
<option value='a) Ki�ilere, arkada�lar�na s�z ve davran��larla sark�nt�l�k, hakaret ve iftira etmek veya ba�kalar�n� bu gibi davran��lara k��k�rtmak, '>a) Ki�ilere, arkada�lar�na s�z ve davran��larla sark�nt�l�k, hakaret ve iftira etmek veya ba�kalar�n� bu gibi davran��lara k��k�rtmak, </option>
<option value='b) Pansiyonu terk ederek gece izinsiz d��ar�da kalmak, '>b) Pansiyonu terk ederek gece izinsiz d��ar�da kalmak, </option>
<option value='c) Ki�ileri veya gruplar� dil, �rk, cinsiyet, siyasi d���nce, felsefi ve dini inan�lar�na g�re ay�rmay�, k�namay�, k�t�lemeyi ama�layan davran��larda bulunmak veya ayr�mc�l��� k�r�kleyici semboller ta��mak,'>c) Ki�ileri veya gruplar� dil, �rk, cinsiyet, siyasi d���nce, felsefi ve dini inan�lar�na g�re ay�rmay�, k�namay�, k�t�lemeyi ama�layan davran��larda bulunmak veya ayr�mc�l��� k�r�kleyici semboller ta��mak,</option>
<option value='�) �zinsiz g�steri veya toplant� d�zenlemek, bu t�r g�steri veya toplant�lara kat�lmak ve bu ama�la yap�lan etkinliklerde bulunmak,'>�) �zinsiz g�steri veya toplant� d�zenlemek, bu t�r g�steri veya toplant�lara kat�lmak ve bu ama�la yap�lan etkinliklerde bulunmak,</option>
<option value='d) Her t�rl� ortamda kumar oynamak veya oynatmak,'>d) Her t�rl� ortamda kumar oynamak veya oynatmak,</option>
<option value='e) Verilen g�revlerin yap�lmas�na engel olmak,'>e) Verilen g�revlerin yap�lmas�na engel olmak,</option>
<option value='f) Ba�kalar�na hakaret etmek, '>f) Ba�kalar�na hakaret etmek, </option>
<option value='g) Yasaklanm�� veya m�stehcen yay�n, kitap, dergi, bro��r, gazete, bildiri, beyanname, ilan ve benzerlerini da��tmak, duvarlara ve di�er yerlere asmak, yap��t�rmak, yazmak; bu ama�lar i�in okul ara�-gerecini ve eklentilerini kullanmak,'>g) Yasaklanm�� veya m�stehcen yay�n, kitap, dergi, bro��r, gazete, bildiri, beyanname, ilan ve benzerlerini da��tmak, duvarlara ve di�er yerlere asmak, yap��t�rmak, yazmak; bu ama�lar i�in okul ara�-gerecini ve eklentilerini kullanmak,</option>
<option value='�) Bili�im ara�lar� yoluyla e�itim ve ��retim faaliyetleriyle ki�ilere zarar vermek,'>�) Bili�im ara�lar� yoluyla e�itim ve ��retim faaliyetleriyle ki�ilere zarar vermek,</option>
<option value='h) �z�rs�z devams�zl�k yapmay�, okula geldi�i h�lde �z�rs�z e�itim ve ��retim faaliyetlerine, t�renlere ve di�er sosyal etkinliklere kat�lmamay�, ge� kat�lmay� veya erken ayr�lmay� al��kanl�k haline getirmek,'>h) �z�rs�z devams�zl�k yapmay�, okula geldi�i h�lde �z�rs�z e�itim ve ��retim faaliyetlerine, t�renlere ve di�er sosyal etkinliklere kat�lmamay�, ge� kat�lmay� veya erken ayr�lmay� al��kanl�k haline getirmek,</option>
<option value='�) Kavga etmek, ba�kalar�na fiili �iddet uygulamak,'>�) Kavga etmek, ba�kalar�na fiili �iddet uygulamak,</option>
<option value='i) Okul binas�, eklenti ve donan�mlar�na, arkada�lar�n�n ara�-gerecine siyasi, ideolojik veya m�stehcen ama�l� yaz�lar yazmak, resim veya semboller �izmek,'>i) Okul binas�, eklenti ve donan�mlar�na, arkada�lar�n�n ara�-gerecine siyasi, ideolojik veya m�stehcen ama�l� yaz�lar yazmak, resim veya semboller �izmek,</option>
<option value='j) Toplu kopya �ekmek veya �ekilmesine yard�mc� olmak,'>j) Toplu kopya �ekmek veya �ekilmesine yard�mc� olmak,</option>
<option value='k) Sarho�luk veren zararl� maddeleri bulundurmak veya kullanmak.'>k) Sarho�luk veren zararl� maddeleri bulundurmak veya kullanmak.</option>
<option value=''>***c) Okul De�i�tirme yapt�r�m�n� gerektiren davran��lar:</option>
<option value='1) Anayasan�n ba�lang�c�nda belirtilen temel ilkelere dayal� mill�, demokratik, l�ik ve sosyal bir hukuk devleti niteliklerine ayk�r� davran��larda bulunmak veya ba�kalar�n� da bu t�r davran��lara zorlamak. * T�rk Bayra��na, �lkeyi, milleti ve devleti temsil eden sembollere sayg�s�zl�k etmek,  * Mill� ve manevi de�erleri s�z, yaz�, resim veya ba�ka bir �ekilde a�a��lamak; bu de�erlere k�f�r ve hakaret etmek,'>1) Anayasan�n ba�lang�c�nda belirtilen temel ilkelere dayal� mill�, demokratik, l�ik ve sosyal bir hukuk devleti niteliklerine ayk�r� davran��larda bulunmak veya ba�kalar�n� da bu t�r davran��lara zorlamak. * T�rk Bayra��na, �lkeyi, milleti ve devleti temsil eden sembollere sayg�s�zl�k etmek,  * Mill� ve manevi de�erleri s�z, yaz�, resim veya ba�ka bir �ekilde a�a��lamak; bu de�erlere k�f�r ve hakaret etmek,</option>
<option value='2) Sark�nt�l�k, hakaret, iftira, tehdit ve taciz etmek veya ba�kalar�n� bu gibi davran��lara k��k�rtmak.'>2) Sark�nt�l�k, hakaret, iftira, tehdit ve taciz etmek veya ba�kalar�n� bu gibi davran��lara k��k�rtmak.</option>
<option value='3) Okula yaralay�c�, �ld�r�c� aletler getirmek ve bunlar� bulundurmak.'>3) Okula yaralay�c�, �ld�r�c� aletler getirmek ve bunlar� bulundurmak.</option>
<option value='4) Okul ve �evresinde kas�tl� olarak yang�n ��karmak.'>4) Okul ve �evresinde kas�tl� olarak yang�n ��karmak.</option>
<option value='5) Okul s�n�rlar� i�inde herhangi bir yeri, izinsiz olarak e�itim ve ��retim ama�lar� d���nda kullanmak veya kullan�lmas�na yard�mc� olmak,'>5) Okul s�n�rlar� i�inde herhangi bir yeri, izinsiz olarak e�itim ve ��retim ama�lar� d���nda kullanmak veya kullan�lmas�na yard�mc� olmak,</option>
<option value='6) E�itim ve ��retim ortam�nda siyasi partilerin, bu partilere ba�l� yan kurulu�lar�n, derneklerin, sendikalar�n ve benzeri kurulu�lar�n siyasi ve ideolojik g�r��leri do�rultusunda eylem d�zenlemek, ba�kalar�n� bu gibi eylemleri d�zenlemeye k��k�rtmak, d�zenlenmi� eylemlere etkin bi�imde kat�lmak,'>6) E�itim ve ��retim ortam�nda siyasi partilerin, bu partilere ba�l� yan kurulu�lar�n, derneklerin, sendikalar�n ve benzeri kurulu�lar�n siyasi ve ideolojik g�r��leri do�rultusunda eylem d�zenlemek, ba�kalar�n� bu gibi eylemleri d�zenlemeye k��k�rtmak, d�zenlenmi� eylemlere etkin bi�imde kat�lmak,</option>
<option value='Siyasi partilere, bu partilere ba�l� yan kurulu�lara, derneklere, sendikalara ve benzeri kurulu�lara �ye olmak, �ye kaydetmek, para toplamak ve ba���ta bulunmaya zorlamak'>Siyasi partilere, bu partilere ba�l� yan kurulu�lara, derneklere, sendikalara ve benzeri kurulu�lara �ye olmak, �ye kaydetmek, para toplamak ve ba���ta bulunmaya zorlamak</option>
<option value='7) Herhangi bir kurum ve �rg�t ad�na yard�m ve para toplamak. '>7) Herhangi bir kurum ve �rg�t ad�na yard�m ve para toplamak. </option>
<option value='8) Ki�i veya gruplar� dil, �rk, cinsiyet, siyas� d���nce ve inan�lar�na g�re ay�rmak, k�namak, k�t�lemek ve bu t�r eylemlere kat�lmak. '>8) Ki�i veya gruplar� dil, �rk, cinsiyet, siyas� d���nce ve inan�lar�na g�re ay�rmak, k�namak, k�t�lemek ve bu t�r eylemlere kat�lmak. </option>
<option value='9) Ba�kas�n�n mal�na zarar vermek, haberi olmadan almay� al��kanl�k h�line getirmek. '>9) Ba�kas�n�n mal�na zarar vermek, haberi olmadan almay� al��kanl�k h�line getirmek. </option>
<option value='10) Okulun bina, eklenti ve donan�mlar�n�, ta��n�r ve ta��nmaz mallar�n� kas�tl� olarak tahrip etmek. '>10) Okulun bina, eklenti ve donan�mlar�n�, ta��n�r ve ta��nmaz mallar�n� kas�tl� olarak tahrip etmek. </option>
<option value='11) Ders, s�nav, uygulama ve di�er faaliyetlerin yap�lmas�n� engellemek veya arkada�lar�n� bu eylemlere kat�lmaya k��k�rtmak,'>11) Ders, s�nav, uygulama ve di�er faaliyetlerin yap�lmas�n� engellemek veya arkada�lar�n� bu eylemlere kat�lmaya k��k�rtmak,</option>
<option value='12) Okul i�inde ve d���nda okul y�neticilerine, ��retmenlere ve di�er personele kar�� sald�r�da bulunmak, bu gibi hareketleri d�zenlemek veya k��k�rtmak.'>12) Okul i�inde ve d���nda okul y�neticilerine, ��retmenlere ve di�er personele kar�� sald�r�da bulunmak, bu gibi hareketleri d�zenlemek veya k��k�rtmak.</option>
<option value='13) Yat�l� b�lge ortaokullar�nda gece izinsiz olarak d��ar�da kalmay� al��kanl�k h�line getirmek.'>13) Yat�l� b�lge ortaokullar�nda gece izinsiz olarak d��ar�da kalmay� al��kanl�k h�line getirmek.</option>
<option value='14) Okul ile ili�i�i olmayan ki�ileri okulda veya okula ait yerlerde bar�nd�rmak. '>14) Okul ile ili�i�i olmayan ki�ileri okulda veya okula ait yerlerde bar�nd�rmak. </option>
<option value='15) Kendi yerine ba�kalar�n� s�nava katmak, ba�kas�n�n yerine s�nava girmek. '>15) Kendi yerine ba�kalar�n� s�nava katmak, ba�kas�n�n yerine s�nava girmek. </option>
<option value='Zor kullanarak veya tehditle kopya �ekmek veya �ekilmesini sa�lamak,'>Zor kullanarak veya tehditle kopya �ekmek veya �ekilmesini sa�lamak,</option>
<option value='16) Ba�kalar�n�, alkol veya ba��ml�l�k yapan maddeleri kullanmaya te�vik etmek.'>16) Ba�kalar�n�, alkol veya ba��ml�l�k yapan maddeleri kullanmaya te�vik etmek.</option>
<option value='17) K�l�k ve k�yafet y�netmeli�ine uymamakta �srar etmek. '>17) K�l�k ve k�yafet y�netmeli�ine uymamakta �srar etmek. </option>
<option value='18) Okul �al��anlar�n�n g�revlerini yapmalar�na engel olmak,'>18) Okul �al��anlar�n�n g�revlerini yapmalar�na engel olmak,</option>
<option value='19) H�rs�zl�k yapmak, yapt�rmak ve yap�lmas�na yard�mc� olmak,'>19) H�rs�zl�k yapmak, yapt�rmak ve yap�lmas�na yard�mc� olmak,</option>
<option value='20) Okul taraf�ndan verilen belgelerde de�i�iklik yapmak; sahte belge d�zenlemek; �zerinde de�i�iklik yap�lm�� belgeleri kullanmak veya bu belgelerin sa�lad��� haklardan yararlanmak ve ba�kalar�n� yararland�rmak,'>20) Okul taraf�ndan verilen belgelerde de�i�iklik yapmak; sahte belge d�zenlemek; �zerinde de�i�iklik yap�lm�� belgeleri kullanmak veya bu belgelerin sa�lad��� haklardan yararlanmak ve ba�kalar�n� yararland�rmak,</option>
<option value='21) Ba��ml�l�k yapan zararl� maddeleri bulundurmak veya kullanmak'>21) Ba��ml�l�k yapan zararl� maddeleri bulundurmak veya kullanmak</option>
<option value='22) Bili�im ara�lar� yoluyla e�itim ve ��retimi engellemek, ki�ilere a��r derecede maddi ve manevi zarar vermek,'>22) Bili�im ara�lar� yoluyla e�itim ve ��retimi engellemek, ki�ilere a��r derecede maddi ve manevi zarar vermek,</option>
<option value='23) �zin almadan okulla ilgili; bilgi vermek, bas�n toplant�s� yapmak, bildiri yay�nlamak ve da��tmak, faaliyet tertip etmek veya bu kapsamdaki faaliyetlerde etkin rol almak'>23) �zin almadan okulla ilgili; bilgi vermek, bas�n toplant�s� yapmak, bildiri yay�nlamak ve da��tmak, faaliyet tertip etmek veya bu kapsamdaki faaliyetlerde etkin rol almak</option>
<option value=''>***(4) �rg�n e�itim d���na ��karma cezas�n� gerektiren davran��lar;</option>
<option value='a) T�rk Bayra��na, �lkeyi, milleti ve devleti temsil eden sembollere hakaret etmek,'>a) T�rk Bayra��na, �lkeyi, milleti ve devleti temsil eden sembollere hakaret etmek,</option>
<option value='b) T�rkiye Cumhuriyeti�nin devleti ve milletiyle b�l�nmez b�t�nl��� ilkesine ve T�rkiye Cumhuriyetinin insan haklar�na ve Anayasan�n ba�lang�c�nda belirtilen temel ilkelere dayal� mill�, demokratik, laik ve sosyal bir hukuk devleti niteliklerine ayk�r� miting, forum, direni�, y�r�y��, boykot ve i�gal gibi ferdi veya toplu eylemler d�zenlemek; d�zenlenmesini k��k�rtmak ve d�zenlenmi� bu gibi eylemlere etkin olarak kat�lmak veya kat�lmaya zorlamak,'>b) T�rkiye Cumhuriyeti�nin devleti ve milletiyle b�l�nmez b�t�nl��� ilkesine ve T�rkiye Cumhuriyetinin insan haklar�na ve Anayasan�n ba�lang�c�nda belirtilen temel ilkelere dayal� mill�, demokratik, laik ve sosyal bir hukuk devleti niteliklerine ayk�r� miting, forum, direni�, y�r�y��, boykot ve i�gal gibi ferdi veya toplu eylemler d�zenlemek; d�zenlenmesini k��k�rtmak ve d�zenlenmi� bu gibi eylemlere etkin olarak kat�lmak veya kat�lmaya zorlamak,</option>
<option value='c) Ki�ileri veya gruplar�; dil, �rk, cinsiyet, siyasi d���nce, felsefi ve dini inan�lar�na g�re ay�rmay�, k�namay�, k�t�lemeyi ama�layan b�l�c� ve y�k�c� toplu eylemler d�zenlemek, kat�lmak, bu eylemlerin organizasyonunda yer almak, '>c) Ki�ileri veya gruplar�; dil, �rk, cinsiyet, siyasi d���nce, felsefi ve dini inan�lar�na g�re ay�rmay�, k�namay�, k�t�lemeyi ama�layan b�l�c� ve y�k�c� toplu eylemler d�zenlemek, kat�lmak, bu eylemlerin organizasyonunda yer almak, </option>
<option value='�) Kurul ve komisyonlar�n �al��mas�n� tehdit veya zor kullanarak engellemek,'>�) Kurul ve komisyonlar�n �al��mas�n� tehdit veya zor kullanarak engellemek,</option>
<option value='d) Ba��ml�l�k yapan zararl� maddelerin ticaretini yapmak,'>d) Ba��ml�l�k yapan zararl� maddelerin ticaretini yapmak,</option>
<option value='e) Okul ve eklentilerinde g�venlik g��lerince aranan ki�ileri saklamak ve bar�nd�rmak,'>e) Okul ve eklentilerinde g�venlik g��lerince aranan ki�ileri saklamak ve bar�nd�rmak,</option>
<option value='f) E�itim ve ��retim ortam�n� i�gal etmek, '>f) E�itim ve ��retim ortam�n� i�gal etmek, </option>
<option value='g) Okul i�inde ve d���nda tek veya toplu h�lde okulun y�netici, ��retmen, e�itici personel, memur ve di�er personeline kar�� sald�r�da bulunmak, bu gibi hareketleri d�zenlemek veya k��k�rtmak, '>g) Okul i�inde ve d���nda tek veya toplu h�lde okulun y�netici, ��retmen, e�itici personel, memur ve di�er personeline kar�� sald�r�da bulunmak, bu gibi hareketleri d�zenlemek veya k��k�rtmak, </option>
<option value='�) Okul �al��anlar�n�n g�revlerini yapmalar�na engel olmak i�in fiili sald�r�da bulunmak ve ba�kalar�n� bu y�ndeki eylemlere k��k�rtmak, '>�) Okul �al��anlar�n�n g�revlerini yapmalar�na engel olmak i�in fiili sald�r�da bulunmak ve ba�kalar�n� bu y�ndeki eylemlere k��k�rtmak, </option>
<option value='h) Okulun ta��n�r veya ta��nmaz mallar�n� kas�tl� olarak tahrip etmek,'>h) Okulun ta��n�r veya ta��nmaz mallar�n� kas�tl� olarak tahrip etmek,</option>
<option value='�) Yaralay�c�, �ld�r�c� her t�rl� alet, silah, patlay�c� maddeleri kullanmak suretiyle bir kimseyi yaralamaya te�ebb�s etmek, yaralamak, �ld�rmek, maddi veya manevi zarara yol a�mak,'>�) Yaralay�c�, �ld�r�c� her t�rl� alet, silah, patlay�c� maddeleri kullanmak suretiyle bir kimseyi yaralamaya te�ebb�s etmek, yaralamak, �ld�rmek, maddi veya manevi zarara yol a�mak,</option>
<option value='i) Ki�i veya ki�ilere her ne sebeple olursa olsun eziyet etmek; i�kence yapmak veya yapt�rmak, cinsel istismar ve bu konuda kanunlar�n su� sayd��� fiilleri i�lemek,'>i) Ki�i veya ki�ilere her ne sebeple olursa olsun eziyet etmek; i�kence yapmak veya yapt�rmak, cinsel istismar ve bu konuda kanunlar�n su� sayd��� fiilleri i�lemek,</option>
<option value='j) �ete kurmak, �etede yer almak, yol kesmek, adam ka��rmak; kapka� ve gasp yapmak, fidye ve hara� almak,'>j) �ete kurmak, �etede yer almak, yol kesmek, adam ka��rmak; kapka� ve gasp yapmak, fidye ve hara� almak,</option>
<option value='k) Yasa d��� �rg�tlerin ve kurulu�lar�n, siyasi ve ideolojik g�r��leri do�rultusunda propaganda yapmak, eylem d�zenlemek, ba�kalar�n� bu gibi eylemleri d�zenlemeye k��k�rtmak, d�zenlenmi� eylemlere etkin bi�imde kat�lmak, bu kurulu�lara �ye olmak, �ye kaydetmek; para toplamak ve ba���ta bulunmaya zorlamak,'>k) Yasa d��� �rg�tlerin ve kurulu�lar�n, siyasi ve ideolojik g�r��leri do�rultusunda propaganda yapmak, eylem d�zenlemek, ba�kalar�n� bu gibi eylemleri d�zenlemeye k��k�rtmak, d�zenlenmi� eylemlere etkin bi�imde kat�lmak, bu kurulu�lara �ye olmak, �ye kaydetmek; para toplamak ve ba���ta bulunmaya zorlamak,</option>
<option value='l) Bili�im ara�lar� yoluyla; b�l�c�, y�k�c�, ahlak d��� ve �iddeti �zendiren sesli, s�zl�, yaz�l� ve g�r�nt�l� i�erikler olu�turmak, bunlar� �o�altmak, yaymak ve ticaretini yapmak. '>l) Bili�im ara�lar� yoluyla; b�l�c�, y�k�c�, ahlak d��� ve �iddeti �zendiren sesli, s�zl�, yaz�l� ve g�r�nt�l� i�erikler olu�turmak, bunlar� �o�altmak, yaymak ve ticaretini yapmak. </option>

</select>

<?php
/* �PTAL =================================
$sql="SELECT DISTINCT konu from $tablo where konu<>'' ORDER BY konu ASC";
$sonuc=$veritabani->query($sql) or die($veritabani->error);

$disiplinolaylari=array(
'K�l�k K�yafet Y�netmeli�i �hlali',
'Okul �dare ve ��retmenlerine Hakaret, Sald�r�',
'��retmen ve Arkada�lara Sayg�s�zl�k',
'Okulda Alkol-Sigara Bulundurma',
'Ders Ak���n� Engelleme',
'H�rs�zl�k Yapma',
'Kavga',
'Okul e�yalar�na Zarar Verme',
'Okul Kurallar�na Uymama',
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
