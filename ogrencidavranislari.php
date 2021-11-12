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
		<option value='Okul Kurallarına Aykırı Fiiller'>Okul Kurallarına Aykırı Fiiller</option>
		<option value='Tutum Ve Davranış Bozukluğu'>Tutum Ve Davranış Bozukluğu</option>
		<option value='Davranış Ve Aşırı Şiddet'>Davranış Ve Aşırı Şiddet</option>
		<option value='Derse Katılmama'>Derse Katılmama</option>
		<option value='Arkadaşına Kaba Ve Saygısızca Davranmak, Kavga Etmek'>Arkadaşına Kaba Ve Saygısızca Davranmak, Kavga Etmek</option>
		<option value='Okul Kurallarını İhlal Etme.'>Okul Kurallarını İhlal Etme.</option>
		<option value='Okul Ve Sınıf Kurallarına Uymamakta Israr Etmek'>Okul Ve Sınıf Kurallarına Uymamakta Israr Etmek</option>
		<option value='Öğretmenine Kaba Ve Saygısız Davranmak'>Öğretmenine Kaba Ve Saygısız Davranmak</option>
		<option value='Öğretmenine Kaba Saygısız Davranmak'>Öğretmenine Kaba Saygısız Davranmak</option>
		<option value='Sataşma, Kavga Etme, Öğretmenlere Saygısızlık'>Sataşma, Kavga Etme, Öğretmenlere Saygısızlık</option>
		<option value='Cep Telefonu İle İzinsiz Kayıt Yapmak'>Cep Telefonu İle İzinsiz Kayıt Yapmak</option>
		<option value='Öğretmene Saygısız Davranmak'>Öğretmene Saygısız Davranmak</option>
		<option value='Okul Bahçesinde Sigara İçmek'>Okul Bahçesinde Sigara İçmek</option>
		<option value='Okul Kurallarını Dikkate Almayarak,Kuralları Ve Ders Ortamını Bozmak Ders Ve Ders Dışı Etkinliklerin Yapılmasını Engellemek'>Okul Kurallarını Dikkate Almayarak,Kuralları Ve Ders Ortamını Bozmak Ders Ve Ders Dışı Etkinliklerin Yapılmasını Engellemek</option>
		<option value='Ceza Verilen Bir Öğrencimiz Yoktur.'>Ceza Verilen Bir Öğrencimiz Yoktur.</option>
		<option value='Okulumuzda Cezai İşlem Görmüş Öğrenci Yoktur'>Okulumuzda Cezai İşlem Görmüş Öğrenci Yoktur</option>
		<option value='Arkadaşlarına Kaba Ve Saygısız Davranma'>Arkadaşlarına Kaba Ve Saygısız Davranma</option>
		<option value='Hırsızlık'>Hırsızlık</option>
		<option value='Dersin İşlenişini Bozma'>Dersin İşlenişini Bozma</option>		
		<option value='Davranış Bozukluğu'>Davranış Bozukluğu</option>
		<option value='Proje Ve Performans Görevlerini Yapmama'>Proje Ve Performans Görevlerini Yapmama</option>
		<option value='İlköğretim Kurumları Yönetmeliği 109.Madde C Bendi 2.Fıkrası Gereği'>İlköğretim Kurumları Yönetmeliği 109.Madde C Bendi 2.Fıkrası Gereği</option>
		<option value='Okula Özürsüz Devamsızlık Yapma Alşkanlığı Ve Okul Etrafında Sigara İçme Davranışı'>Okula Özürsüz Devamsızlık Yapma Alşkanlığı Ve Okul Etrafında Sigara İçme Davranışı</option>
		<option value='Okuldan İzinsiz Ayrılarak Okul Çevresinde İçki İçme'>Okuldan İzinsiz Ayrılarak Okul Çevresinde İçki İçme</option>
		<option value='Dersin Disiplinini Bozma'>Dersin Disiplinini Bozma</option>
		<option value='Kavga Darp Ve Yaralama Olayına Karışma'>Kavga Darp Ve Yaralama Olayına Karışma</option>
		<option value='Öğretmenin Ve İdarenin Görevlerinin Yapılmasını Engellemek'>Öğretmenin Ve İdarenin Görevlerinin Yapılmasını Engellemek</option>
		<option value='Öğretmene Karşı Gelmek,Görevlerini Yapmasını Engellemek'>Öğretmene Karşı Gelmek,Görevlerini Yapmasını Engellemek</option>
		<option value='Kopya Çekmek'>Kopya Çekmek</option>
		<option value='Tütün Ve Tütün Mamüllerini Bulundurmak Ve İçmek'>Tütün Ve Tütün Mamüllerini Bulundurmak Ve İçmek</option>
		<option value='Eğitim Öğretim Yılı Boyunca Cezayı Gerektirecek Davranışlarla Karşılaşılmamıştır.'>Eğitim Öğretim Yılı Boyunca Cezayı Gerektirecek Davranışlarla Karşılaşılmamıştır.</option>
		<option value='Dersin Akışını Ve Düzenini Bozmak'>Dersin Akışını Ve Düzenini Bozmak</option>
		<option value='Yaralayıcı Madde Taşımak Ve Kullanmak'>Yaralayıcı Madde Taşımak Ve Kullanmak</option>
		<option value='Sahte Belge Düzenlemek'>Sahte Belge Düzenlemek</option>
		<option value='Sınavın Huzurunu Bozmak'>Sınavın Huzurunu Bozmak</option>
		<option value='Belge Üzerinde Değişiklik Yapmak'>Belge Üzerinde Değişiklik Yapmak</option>
		<option value='Öğretmene Hakaret'>Öğretmene Hakaret</option>
		<option value='Sigara İçme'>Sigara İçme</option>		
		<option value='İzinsiz Ve Özürsüz Olarak Pansiyon Dışına Çıkmak'>İzinsiz Ve Özürsüz Olarak Pansiyon Dışına Çıkmak</option>
		<option value='Kavga Olayına Karışma'>Kavga Olayına Karışma</option>
		<option value='Arkadaşlarına Söz Ve Davranışla Kaba Ve Saygısız Davranma'>Arkadaşlarına Söz Ve Davranışla Kaba Ve Saygısız Davranma</option>
		<option value='Sınıfın Huzurunu Bozma Ve Dersin İşleyişini Aksatma'>Sınıfın Huzurunu Bozma Ve Dersin İşleyişini Aksatma</option>
		<option value='Öğretmene Karşı Gelme Ve Hakaret Etme'>Öğretmene Karşı Gelme Ve Hakaret Etme</option>
		<option value='Evrakta Sahtecilik Yapmak'>Evrakta Sahtecilik Yapmak</option>
		<option value='Ahlak Dışı Yayınları Okulda Bulundurmak'>Ahlak Dışı Yayınları Okulda Bulundurmak</option>
		<option value='Eğitim Öğretim Ortamına Yaralayıcı Alet Getirmek'>Eğitim Öğretim Ortamına Yaralayıcı Alet Getirmek</option>
		<option value='Okul Eşyalarına Zarar Vermek'>Okul Eşyalarına Zarar Vermek</option>
		<option value='Tütün Ve Tütün Mamulleri Bulundurmak Ve İçmek'>Tütün Ve Tütün Mamulleri Bulundurmak Ve İçmek</option>
		<option value='Özürsüz Olarak Okulu Terk Etmek'>Özürsüz Olarak Okulu Terk Etmek</option>
		<option value='Ders Araç Gereçlerini Getirmemek'>Ders Araç Gereçlerini Getirmemek</option>
		<option value='Kılık Kıyafetle İlgili Hükümlere Uymamak'>Kılık Kıyafetle İlgili Hükümlere Uymamak</option>
		<option value='Kavga-Darp Olaylarına Karışma'>Kavga-Darp Olaylarına Karışma</option>
		<option value='Kopya'>Kopya</option>
		<option value='Bir Veya Birden Fazla Kişileri Kışkırtarak Kavga Olaylarına Zemin Hazlrlamak'>Bir Veya Birden Fazla Kişileri Kışkırtarak Kavga Olaylarına Zemin Hazlrlamak</option>
		<option value='Öğretmenlere Yönelik Saygısızca Davranışlar'>Öğretmenlere Yönelik Saygısızca Davranışlar</option>
		<option value='Arkadaşlarına Karşı Kaba Ve Saygısız Davranma'>Arkadaşlarına Karşı Kaba Ve Saygısız Davranma</option>
		<option value='Okul İdarecilerine Karşı Kaba Ve Saygısız Davranma'>Okul İdarecilerine Karşı Kaba Ve Saygısız Davranma</option>
		<option value='Okul Yönetmenliğine Aykırı Davranışlar'>Okul Yönetmenliğine Aykırı Davranışlar</option>
		<option value='Öğretmen Ve Arkadaşlara Saygısızlık'>Öğretmen Ve Arkadaşlara Saygısızlık</option>
		<option value='Okulda Alkol-Sigara Bulundurma'>Okulda Alkol-Sigara Bulundurma</option>
		<option value='Ders Akışını Engelleme'>Ders Akışını Engelleme</option>
		<option value='Okul Ve Pansiyon Kurallarına Uymama'>Okul Ve Pansiyon Kurallarına Uymama</option>
		<option value='Resmi Belgede Sahtecilik'>Resmi Belgede Sahtecilik</option>
		<option value='Yalan Söyleme'>Yalan Söyleme</option>
		<option value='Bilişim Araçlarını Okul Yönetimi Bilgisi Dışında Kullanma'>Bilişim Araçlarını Okul Yönetimi Bilgisi Dışında Kullanma</option>
		<option value='Okula Geldiği Halde Derslere Katılmama'>Okula Geldiği Halde Derslere Katılmama</option>
		<option value='Genel Ahlaka Uygun Olmayan Görüntü Çekmesi Ve Bulundurması'>Genel Ahlaka Uygun Olmayan Görüntü Çekmesi Ve Bulundurması</option>
		<option value='Sınıf Arkadaşlarına Sarkıntılık Yapma Ve Ahlak Dışı Davranışları'>Sınıf Arkadaşlarına Sarkıntılık Yapma Ve Ahlak Dışı Davranışları</option>
		<option value='Dersin Akışını Bozmak'>Dersin Akışını Bozmak</option>
		<option value='Öğretmene Kaba Ve Saygısız Davranma'>Öğretmene Kaba Ve Saygısız Davranma</option>		
		<option value='Okulda Sigara Bulundurma'>Okulda Sigara Bulundurma</option>
		<option value='Hırsızlık Yapmak'>Hırsızlık Yapmak</option>
		<option value='Ahlak Kurallarına Uymamak'>Ahlak Kurallarına Uymamak</option>
		<option value='Ders İşlenişinin Engellenmesi Ve Öğretmene Karşı Gelme'>Ders İşlenişinin Engellenmesi Ve Öğretmene Karşı Gelme</option>
		<option value='Sigara İçmek/Bulundurmak'>Sigara İçmek/Bulundurmak</option>
		<option value='Yalan Söylemek'>Yalan Söylemek</option>
		<option value='Eğitim Öğretim Ortamına Yaralayıcı/Kesici Alet Getirmek'>Eğitim Öğretim Ortamına Yaralayıcı/Kesici Alet Getirmek</option>
		<option value='Okula Geldiği Halde Derse Katılmamak'>Okula Geldiği Halde Derse Katılmamak</option>
		<option value='Disiplin Kurulu Çağrılarına Uymamak'>Disiplin Kurulu Çağrılarına Uymamak</option>
		<option value='Dersin Akışını Ve İşlenişini Bozmak'>Dersin Akışını Ve İşlenişini Bozmak</option>
		<option value='Okul Personeline Saygısızlık'>Okul Personeline Saygısızlık</option>
		<option value='Belgede Tahribat'>Belgede Tahribat</option>
		<option value='Öğretmen Saygısızlık'>Öğretmen Saygısızlık</option>
		<option value='Kılık Kıyafet Yönetmeliğine Uymamak'>Kılık Kıyafet Yönetmeliğine Uymamak</option>
		<option value='Arkadaşlarına Sözle Ve Davranışlarla Hakaret Etmek'>Arkadaşlarına Sözle Ve Davranışlarla Hakaret Etmek</option>
		<option value='Dersin Düzenini Bozmak Ve Öğretmene Saygısızlık'>Dersin Düzenini Bozmak Ve Öğretmene Saygısızlık</option>
		<option value='Verilen Görevi Yerine Getirmemek'>Verilen Görevi Yerine Getirmemek</option>
		<option value='Görev Yerini Terk Etmek'>Görev Yerini Terk Etmek</option>
		<option value='Sınıf Ortamında Arkadaşına Küfür Etmek'>Sınıf Ortamında Arkadaşına Küfür Etmek</option>
		<option value='Ders Saatinde Sınıfın Düzenini Bozmak'>Ders Saatinde Sınıfın Düzenini Bozmak</option>
		<option value='Ahlak Kurallarına Bağdaşmayan Davranışlar'>Ahlak Kurallarına Bağdaşmayan Davranışlar</option>
		<option value='Çevreye Ve Arkadaşlarına Kasıtlı Olarak Zarar Verme'>Çevreye Ve Arkadaşlarına Kasıtlı Olarak Zarar Verme</option>
		<option value='Okulda Şiddet İçerikli Olaylara Karışma'>Okulda Şiddet İçerikli Olaylara Karışma</option>
		<option value='Kopya Çekme'>Kopya Çekme</option>
		<option value='Okul İçinde Ve Dışında Okul Personeli İle Diğer Kişilere Karşı Kaba Ve Saygısız Davranmak'>Okul İçinde Ve Dışında Okul Personeli İle Diğer Kişilere Karşı Kaba Ve Saygısız Davranmak</option>
		<option value='Ders Akışını Bozmak'>Ders Akışını Bozmak</option>
		<option value='Kavga, Darp Etmek Ve Yaralama Olaylarına Karışmak'>Kavga, Darp Etmek Ve Yaralama Olaylarına Karışmak</option>
		<option value='Kavga Etme'>Kavga Etme</option>
		<option value='Okulu Terk Etme'>Okulu Terk Etme</option>
		<option value='Oyun Kağıdı Getirip Sınıfta Oynamak (Anadolu Lisesi)'>Oyun Kağıdı Getirip Sınıfta Oynamak (Anadolu Lisesi)</option>
		<option value='Derste Cep Telefonuyla İlgilenmek (Anadolu Lisesi)'>Derste Cep Telefonuyla İlgilenmek (Anadolu Lisesi)</option>
		<option value='Kavga Etmek (Klasik Lise)'>Kavga Etmek (Klasik Lise)</option>
		<option value='Başkasının Malına Ve Eşyasına Zarar Vermek (Klasik Lise)'>Başkasının Malına Ve Eşyasına Zarar Vermek (Klasik Lise)</option>
		<option value='Tütün Mamülleri Bulundurmak Ve İçmek (Klasik Lise)'>Tütün Mamülleri Bulundurmak Ve İçmek (Klasik Lise)</option>
		<option value='Öğretmene Saygısızlık (Klasik Lise)'>Öğretmene Saygısızlık (Klasik Lise)</option>
		<option value='Dersin Akışını Bozmak (Klasik Lise)'>Dersin Akışını Bozmak (Klasik Lise)</option>
		<option value='Cep Telefonunu Derste Açmak Ve Konuşmak (Klasik Lise)'>Cep Telefonunu Derste Açmak Ve Konuşmak (Klasik Lise)</option>
		<option value='Kaba Ve Saygısız Davranmak (Klasik Lise)'>Kaba Ve Saygısız Davranmak (Klasik Lise)</option>
		<option value='Tütün Ve Tütün Mamullerini Bulundurmak Veya İçmek'>Tütün Ve Tütün Mamullerini Bulundurmak Veya İçmek</option>
		<option value='Sarhoşluk Veren Zararlı Maddeleri Bulundurmak Veya Kullanmak'>Sarhoşluk Veren Zararlı Maddeleri Bulundurmak Veya Kullanmak</option>
		<option value='Yönetici,Öğretmen Veya Eğitici Personel Tarafından Verilen Görevleri Yapmamak'>Yönetici,Öğretmen Veya Eğitici Personel Tarafından Verilen Görevleri Yapmamak</option>
		<option value='Dersin Ve Ders Dışı Faaliyetlerin Akışını Ve Düzenini Bozacak Davranışlarda Bulunmak'>Dersin Ve Ders Dışı Faaliyetlerin Akışını Ve Düzenini Bozacak Davranışlarda Bulunmak</option>
		<option value='Arkadaşları İle Kavga Etme'>Arkadaşları İle Kavga Etme</option>
		<option value='Okul Kurallarına Uymama Öğretmen Ve Arkadaşlarına Saygısızlık'>Okul Kurallarına Uymama Öğretmen Ve Arkadaşlarına Saygısızlık</option>
		<option value='İky Madde 109, A,B'>İky Madde 109, A,B</option>
</select>


<iframe id="gonderphp" name="gonderphp" style="display:none;visibility:hidden" src="gonder.php"></iframe>

</body>
</html>
