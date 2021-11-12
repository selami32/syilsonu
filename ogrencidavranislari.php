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
$tablo=$onek."ogrencidavranislari";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";

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
			$output .= "['". $row['konu'] ."','" . 
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


<script type="text/javascript" src="GroupHeaderPlugin.js"></script>
<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
<?php $veritabani->close(); ?>
</head>

<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>
<select name="davraniscombo" id="davraniscombo" style="display: none;">
		<option value='Okul Kurallar�na Ayk�r� Fiiller'>Okul Kurallar�na Ayk�r� Fiiller</option>
		<option value='Tutum Ve Davran�� Bozuklu�u'>Tutum Ve Davran�� Bozuklu�u</option>
		<option value='Davran�� Ve A��r� �iddet'>Davran�� Ve A��r� �iddet</option>
		<option value='Derse Kat�lmama'>Derse Kat�lmama</option>
		<option value='Arkada��na Kaba Ve Sayg�s�zca Davranmak, Kavga Etmek'>Arkada��na Kaba Ve Sayg�s�zca Davranmak, Kavga Etmek</option>
		<option value='Okul Kurallar�n� �hlal Etme.'>Okul Kurallar�n� �hlal Etme.</option>
		<option value='Okul Ve S�n�f Kurallar�na Uymamakta Israr Etmek'>Okul Ve S�n�f Kurallar�na Uymamakta Israr Etmek</option>
		<option value='��retmenine Kaba Ve Sayg�s�z Davranmak'>��retmenine Kaba Ve Sayg�s�z Davranmak</option>
		<option value='��retmenine Kaba Sayg�s�z Davranmak'>��retmenine Kaba Sayg�s�z Davranmak</option>
		<option value='Sata�ma, Kavga Etme, ��retmenlere Sayg�s�zl�k'>Sata�ma, Kavga Etme, ��retmenlere Sayg�s�zl�k</option>
		<option value='Cep Telefonu �le �zinsiz Kay�t Yapmak'>Cep Telefonu �le �zinsiz Kay�t Yapmak</option>
		<option value='��retmene Sayg�s�z Davranmak'>��retmene Sayg�s�z Davranmak</option>
		<option value='Okul Bah�esinde Sigara ��mek'>Okul Bah�esinde Sigara ��mek</option>
		<option value='Okul Kurallar�n� Dikkate Almayarak,Kurallar� Ve Ders Ortam�n� Bozmak Ders Ve Ders D��� Etkinliklerin Yap�lmas�n� Engellemek'>Okul Kurallar�n� Dikkate Almayarak,Kurallar� Ve Ders Ortam�n� Bozmak Ders Ve Ders D��� Etkinliklerin Yap�lmas�n� Engellemek</option>
		<option value='Ceza Verilen Bir ��rencimiz Yoktur.'>Ceza Verilen Bir ��rencimiz Yoktur.</option>
		<option value='Okulumuzda Cezai ��lem G�rm�� ��renci Yoktur'>Okulumuzda Cezai ��lem G�rm�� ��renci Yoktur</option>
		<option value='Arkada�lar�na Kaba Ve Sayg�s�z Davranma'>Arkada�lar�na Kaba Ve Sayg�s�z Davranma</option>
		<option value='H�rs�zl�k'>H�rs�zl�k</option>
		<option value='Dersin ��leni�ini Bozma'>Dersin ��leni�ini Bozma</option>		
		<option value='Davran�� Bozuklu�u'>Davran�� Bozuklu�u</option>
		<option value='Proje Ve Performans G�revlerini Yapmama'>Proje Ve Performans G�revlerini Yapmama</option>
		<option value='�lk��retim Kurumlar� Y�netmeli�i 109.Madde C Bendi 2.F�kras� Gere�i'>�lk��retim Kurumlar� Y�netmeli�i 109.Madde C Bendi 2.F�kras� Gere�i</option>
		<option value='Okula �z�rs�z Devams�zl�k Yapma Al�kanl��� Ve Okul Etraf�nda Sigara ��me Davran���'>Okula �z�rs�z Devams�zl�k Yapma Al�kanl��� Ve Okul Etraf�nda Sigara ��me Davran���</option>
		<option value='Okuldan �zinsiz Ayr�larak Okul �evresinde ��ki ��me'>Okuldan �zinsiz Ayr�larak Okul �evresinde ��ki ��me</option>
		<option value='Dersin Disiplinini Bozma'>Dersin Disiplinini Bozma</option>
		<option value='Kavga Darp Ve Yaralama Olay�na Kar��ma'>Kavga Darp Ve Yaralama Olay�na Kar��ma</option>
		<option value='��retmenin Ve �darenin G�revlerinin Yap�lmas�n� Engellemek'>��retmenin Ve �darenin G�revlerinin Yap�lmas�n� Engellemek</option>
		<option value='��retmene Kar�� Gelmek,G�revlerini Yapmas�n� Engellemek'>��retmene Kar�� Gelmek,G�revlerini Yapmas�n� Engellemek</option>
		<option value='Kopya �ekmek'>Kopya �ekmek</option>
		<option value='T�t�n Ve T�t�n Mam�llerini Bulundurmak Ve ��mek'>T�t�n Ve T�t�n Mam�llerini Bulundurmak Ve ��mek</option>
		<option value='E�itim ��retim Y�l� Boyunca Cezay� Gerektirecek Davran��larla Kar��la��lmam��t�r.'>E�itim ��retim Y�l� Boyunca Cezay� Gerektirecek Davran��larla Kar��la��lmam��t�r.</option>
		<option value='Dersin Ak���n� Ve D�zenini Bozmak'>Dersin Ak���n� Ve D�zenini Bozmak</option>
		<option value='Yaralay�c� Madde Ta��mak Ve Kullanmak'>Yaralay�c� Madde Ta��mak Ve Kullanmak</option>
		<option value='Sahte Belge D�zenlemek'>Sahte Belge D�zenlemek</option>
		<option value='S�nav�n Huzurunu Bozmak'>S�nav�n Huzurunu Bozmak</option>
		<option value='Belge �zerinde De�i�iklik Yapmak'>Belge �zerinde De�i�iklik Yapmak</option>
		<option value='��retmene Hakaret'>��retmene Hakaret</option>
		<option value='Sigara ��me'>Sigara ��me</option>		
		<option value='�zinsiz Ve �z�rs�z Olarak Pansiyon D���na ��kmak'>�zinsiz Ve �z�rs�z Olarak Pansiyon D���na ��kmak</option>
		<option value='Kavga Olay�na Kar��ma'>Kavga Olay�na Kar��ma</option>
		<option value='Arkada�lar�na S�z Ve Davran��la Kaba Ve Sayg�s�z Davranma'>Arkada�lar�na S�z Ve Davran��la Kaba Ve Sayg�s�z Davranma</option>
		<option value='S�n�f�n Huzurunu Bozma Ve Dersin ��leyi�ini Aksatma'>S�n�f�n Huzurunu Bozma Ve Dersin ��leyi�ini Aksatma</option>
		<option value='��retmene Kar�� Gelme Ve Hakaret Etme'>��retmene Kar�� Gelme Ve Hakaret Etme</option>
		<option value='Evrakta Sahtecilik Yapmak'>Evrakta Sahtecilik Yapmak</option>
		<option value='Ahlak D��� Yay�nlar� Okulda Bulundurmak'>Ahlak D��� Yay�nlar� Okulda Bulundurmak</option>
		<option value='E�itim ��retim Ortam�na Yaralay�c� Alet Getirmek'>E�itim ��retim Ortam�na Yaralay�c� Alet Getirmek</option>
		<option value='Okul E�yalar�na Zarar Vermek'>Okul E�yalar�na Zarar Vermek</option>
		<option value='T�t�n Ve T�t�n Mamulleri Bulundurmak Ve ��mek'>T�t�n Ve T�t�n Mamulleri Bulundurmak Ve ��mek</option>
		<option value='�z�rs�z Olarak Okulu Terk Etmek'>�z�rs�z Olarak Okulu Terk Etmek</option>
		<option value='Ders Ara� Gere�lerini Getirmemek'>Ders Ara� Gere�lerini Getirmemek</option>
		<option value='K�l�k K�yafetle �lgili H�k�mlere Uymamak'>K�l�k K�yafetle �lgili H�k�mlere Uymamak</option>
		<option value='Kavga-Darp Olaylar�na Kar��ma'>Kavga-Darp Olaylar�na Kar��ma</option>
		<option value='Kopya'>Kopya</option>
		<option value='Bir Veya Birden Fazla Ki�ileri K��k�rtarak Kavga Olaylar�na Zemin Hazlrlamak'>Bir Veya Birden Fazla Ki�ileri K��k�rtarak Kavga Olaylar�na Zemin Hazlrlamak</option>
		<option value='��retmenlere Y�nelik Sayg�s�zca Davran��lar'>��retmenlere Y�nelik Sayg�s�zca Davran��lar</option>
		<option value='Arkada�lar�na Kar�� Kaba Ve Sayg�s�z Davranma'>Arkada�lar�na Kar�� Kaba Ve Sayg�s�z Davranma</option>
		<option value='Okul �darecilerine Kar�� Kaba Ve Sayg�s�z Davranma'>Okul �darecilerine Kar�� Kaba Ve Sayg�s�z Davranma</option>
		<option value='Okul Y�netmenli�ine Ayk�r� Davran��lar'>Okul Y�netmenli�ine Ayk�r� Davran��lar</option>
		<option value='��retmen Ve Arkada�lara Sayg�s�zl�k'>��retmen Ve Arkada�lara Sayg�s�zl�k</option>
		<option value='Okulda Alkol-Sigara Bulundurma'>Okulda Alkol-Sigara Bulundurma</option>
		<option value='Ders Ak���n� Engelleme'>Ders Ak���n� Engelleme</option>
		<option value='Okul Ve Pansiyon Kurallar�na Uymama'>Okul Ve Pansiyon Kurallar�na Uymama</option>
		<option value='Resmi Belgede Sahtecilik'>Resmi Belgede Sahtecilik</option>
		<option value='Yalan S�yleme'>Yalan S�yleme</option>
		<option value='Bili�im Ara�lar�n� Okul Y�netimi Bilgisi D���nda Kullanma'>Bili�im Ara�lar�n� Okul Y�netimi Bilgisi D���nda Kullanma</option>
		<option value='Okula Geldi�i Halde Derslere Kat�lmama'>Okula Geldi�i Halde Derslere Kat�lmama</option>
		<option value='Genel Ahlaka Uygun Olmayan G�r�nt� �ekmesi Ve Bulundurmas�'>Genel Ahlaka Uygun Olmayan G�r�nt� �ekmesi Ve Bulundurmas�</option>
		<option value='S�n�f Arkada�lar�na Sark�nt�l�k Yapma Ve Ahlak D��� Davran��lar�'>S�n�f Arkada�lar�na Sark�nt�l�k Yapma Ve Ahlak D��� Davran��lar�</option>
		<option value='Dersin Ak���n� Bozmak'>Dersin Ak���n� Bozmak</option>
		<option value='��retmene Kaba Ve Sayg�s�z Davranma'>��retmene Kaba Ve Sayg�s�z Davranma</option>		
		<option value='Okulda Sigara Bulundurma'>Okulda Sigara Bulundurma</option>
		<option value='H�rs�zl�k Yapmak'>H�rs�zl�k Yapmak</option>
		<option value='Ahlak Kurallar�na Uymamak'>Ahlak Kurallar�na Uymamak</option>
		<option value='Ders ��leni�inin Engellenmesi Ve ��retmene Kar�� Gelme'>Ders ��leni�inin Engellenmesi Ve ��retmene Kar�� Gelme</option>
		<option value='Sigara ��mek/Bulundurmak'>Sigara ��mek/Bulundurmak</option>
		<option value='Yalan S�ylemek'>Yalan S�ylemek</option>
		<option value='E�itim ��retim Ortam�na Yaralay�c�/Kesici Alet Getirmek'>E�itim ��retim Ortam�na Yaralay�c�/Kesici Alet Getirmek</option>
		<option value='Okula Geldi�i Halde Derse Kat�lmamak'>Okula Geldi�i Halde Derse Kat�lmamak</option>
		<option value='Disiplin Kurulu �a�r�lar�na Uymamak'>Disiplin Kurulu �a�r�lar�na Uymamak</option>
		<option value='Dersin Ak���n� Ve ��leni�ini Bozmak'>Dersin Ak���n� Ve ��leni�ini Bozmak</option>
		<option value='Okul Personeline Sayg�s�zl�k'>Okul Personeline Sayg�s�zl�k</option>
		<option value='Belgede Tahribat'>Belgede Tahribat</option>
		<option value='��retmen Sayg�s�zl�k'>��retmen Sayg�s�zl�k</option>
		<option value='K�l�k K�yafet Y�netmeli�ine Uymamak'>K�l�k K�yafet Y�netmeli�ine Uymamak</option>
		<option value='Arkada�lar�na S�zle Ve Davran��larla Hakaret Etmek'>Arkada�lar�na S�zle Ve Davran��larla Hakaret Etmek</option>
		<option value='Dersin D�zenini Bozmak Ve ��retmene Sayg�s�zl�k'>Dersin D�zenini Bozmak Ve ��retmene Sayg�s�zl�k</option>
		<option value='Verilen G�revi Yerine Getirmemek'>Verilen G�revi Yerine Getirmemek</option>
		<option value='G�rev Yerini Terk Etmek'>G�rev Yerini Terk Etmek</option>
		<option value='S�n�f Ortam�nda Arkada��na K�f�r Etmek'>S�n�f Ortam�nda Arkada��na K�f�r Etmek</option>
		<option value='Ders Saatinde S�n�f�n D�zenini Bozmak'>Ders Saatinde S�n�f�n D�zenini Bozmak</option>
		<option value='Ahlak Kurallar�na Ba�da�mayan Davran��lar'>Ahlak Kurallar�na Ba�da�mayan Davran��lar</option>
		<option value='�evreye Ve Arkada�lar�na Kas�tl� Olarak Zarar Verme'>�evreye Ve Arkada�lar�na Kas�tl� Olarak Zarar Verme</option>
		<option value='Okulda �iddet ��erikli Olaylara Kar��ma'>Okulda �iddet ��erikli Olaylara Kar��ma</option>
		<option value='Kopya �ekme'>Kopya �ekme</option>
		<option value='Okul ��inde Ve D���nda Okul Personeli �le Di�er Ki�ilere Kar�� Kaba Ve Sayg�s�z Davranmak'>Okul ��inde Ve D���nda Okul Personeli �le Di�er Ki�ilere Kar�� Kaba Ve Sayg�s�z Davranmak</option>
		<option value='Ders Ak���n� Bozmak'>Ders Ak���n� Bozmak</option>
		<option value='Kavga, Darp Etmek Ve Yaralama Olaylar�na Kar��mak'>Kavga, Darp Etmek Ve Yaralama Olaylar�na Kar��mak</option>
		<option value='Kavga Etme'>Kavga Etme</option>
		<option value='Okulu Terk Etme'>Okulu Terk Etme</option>
		<option value='Oyun Ka��d� Getirip S�n�fta Oynamak (Anadolu Lisesi)'>Oyun Ka��d� Getirip S�n�fta Oynamak (Anadolu Lisesi)</option>
		<option value='Derste Cep Telefonuyla �lgilenmek (Anadolu Lisesi)'>Derste Cep Telefonuyla �lgilenmek (Anadolu Lisesi)</option>
		<option value='Kavga Etmek (Klasik Lise)'>Kavga Etmek (Klasik Lise)</option>
		<option value='Ba�kas�n�n Mal�na Ve E�yas�na Zarar Vermek (Klasik Lise)'>Ba�kas�n�n Mal�na Ve E�yas�na Zarar Vermek (Klasik Lise)</option>
		<option value='T�t�n Mam�lleri Bulundurmak Ve ��mek (Klasik Lise)'>T�t�n Mam�lleri Bulundurmak Ve ��mek (Klasik Lise)</option>
		<option value='��retmene Sayg�s�zl�k (Klasik Lise)'>��retmene Sayg�s�zl�k (Klasik Lise)</option>
		<option value='Dersin Ak���n� Bozmak (Klasik Lise)'>Dersin Ak���n� Bozmak (Klasik Lise)</option>
		<option value='Cep Telefonunu Derste A�mak Ve Konu�mak (Klasik Lise)'>Cep Telefonunu Derste A�mak Ve Konu�mak (Klasik Lise)</option>
		<option value='Kaba Ve Sayg�s�z Davranmak (Klasik Lise)'>Kaba Ve Sayg�s�z Davranmak (Klasik Lise)</option>
		<option value='T�t�n Ve T�t�n Mamullerini Bulundurmak Veya ��mek'>T�t�n Ve T�t�n Mamullerini Bulundurmak Veya ��mek</option>
		<option value='Sarho�luk Veren Zararl� Maddeleri Bulundurmak Veya Kullanmak'>Sarho�luk Veren Zararl� Maddeleri Bulundurmak Veya Kullanmak</option>
		<option value='Y�netici,��retmen Veya E�itici Personel Taraf�ndan Verilen G�revleri Yapmamak'>Y�netici,��retmen Veya E�itici Personel Taraf�ndan Verilen G�revleri Yapmamak</option>
		<option value='Dersin Ve Ders D��� Faaliyetlerin Ak���n� Ve D�zenini Bozacak Davran��larda Bulunmak'>Dersin Ve Ders D��� Faaliyetlerin Ak���n� Ve D�zenini Bozacak Davran��larda Bulunmak</option>
		<option value='Arkada�lar� �le Kavga Etme'>Arkada�lar� �le Kavga Etme</option>
		<option value='Okul Kurallar�na Uymama ��retmen Ve Arkada�lar�na Sayg�s�zl�k'>Okul Kurallar�na Uymama ��retmen Ve Arkada�lar�na Sayg�s�zl�k</option>
		<option value='�ky Madde 109, A,B'>�ky Madde 109, A,B</option>
</select>


<iframe id="gonderphp" name="gonderphp" style="display:none;visibility:hidden" src="gonder.php"></iframe>

</body>
</html>
