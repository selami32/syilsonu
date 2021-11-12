<?php 
session_start();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Form Girişi</title>
<link rel="stylesheet" type="text/css" href="ext2/resources/css/ext-all.css" />
<style>
        .book {
            background-image:url(ext2/shared/icons/fam/book.png) !important;
        }
</style>
<script type="text/javascript" src="debug.js"></script>
<script type="text/javascript">
<!--



<?php
include "baglanti.php";
include "veritabani.php";
$adres=str_replace("giris.php","",$_SERVER['PHP_SELF']);
echo "var adres='$adres';";

$tablo=$onek."okullar";
$siddettablo=$siddetonek."okullar";
$maddetablo=$maddeonek."okullar";
$risktablo=$riskonek."okullar";
$rehberliktablo=$rehberlikonek."okullar";
$risk2016tablo=$risk2016onek."okullar";


$rastgele=rand();
$sorgu="SELECT okulunadi from $tablo where kurumkodu=1";
$sonuc=$veritabani->query($sorgu);
if ($sonuc) {
    $satir=$sonuc->fetch_assoc();
    $rehberlik=$satir["okulunadi"];
  
}

//======================seçilen raporun veritabanına giriş için bilgi atılması: =============
$sorgu="UPDATE $tablo SET girilentablo='$rastgele' where kurumkodu='1'";
$veritabani->query($sorgu);
//siddet okullar tablosu
$sorgu="UPDATE $siddettablo SET girilentablo='$rastgele' where kurumkodu='1'";
$veritabani->query($sorgu);
//madde bagimlilig
$sorgu="UPDATE $maddetablo SET girilentablo='$rastgele' where kurumkodu='1'";
$veritabani->query($sorgu);
//risk
$sorgu="UPDATE $risktablo SET girilentablo='$rastgele' where kurumkodu='1'";
$veritabani->query($sorgu);

//rehberlik
$sorgu="UPDATE $rehberliktablo SET girilentablo='$rastgele' where kurumkodu='1'";
$veritabani->query($sorgu);

//risk2016
$sorgu="UPDATE $risk2016tablo SET girilentablo='$rastgele' where kurumkodu='1'";
$veritabani->query($sorgu);


echo "var rsg=$rastgele;\n";
echo "var rehberlik='$rehberlik';\n";

?>

//-->

</script>  
<!-- GC -->
<!-- LIBS -->
<script type="text/javascript" src="ext2/adapter/ext/ext-base.js"></script>
<!-- ENDLIBS -->


<script type="text/javascript" src="ext2/ext-all.js"></script>

<!-- Tabs Example Files -->
<link rel="stylesheet" type="text/css" href="giris.css" />

<script type="text/javascript" src="sabitler.js"></script>
<script type="text/javascript" src="giris.js"></script>
<!-- Common Styles for the examples -->
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />

</head>
<body  onLoad="" bgcolor="#ffffff" style="background-color: #ffffff;padding: 0px;vertical-align: top;">
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div align="center" style="padding: 0px;vertical-align: top">
<table width="100%" height="100%" style="margin:0px;border:0px; padding: 0px;border-spacing: 0px;border-collapse: collapse;">
	<tbody>
		<tr style="padding:0px;border-spacing: 0px;">
			<td style="padding:0px;border-spacing: 0px;" valign="top"><img src="SolUst.png"/></td>
			<td width="300" align="center">
			<table height="100%">
				<tr>
					<td height="100%" valign="middle" align="center"><img src='logo.png'/>
						<div align="left" id="formDiv"></div>
										
					</td>
				</tr>
				<tr>
					<td align="center">
						<!--<a href="/gen/login.htm" id="hov"></a>-->
					</td>
				</tr>
			</table>			
			</td>
			<td style="padding:0px;border-spacing: 0px;" align="right" colspan="3" valign="bottom"><img src="SolUst.png"/></td>
		</tr>
	</tbody>
</table>
</div>
<style>
 .gray{
    color: #d9d9d9;
 }
</style>
<p class="x-form-field gray" align="center">
Ordu Rehberlik ve Araştırma Merkezi'nin katkıları ile hazırlanmıştır.
<br>
<br>
<a href="http://www.google.com/intl/tr/chrome/browser/"><img width="5%" height="5%" src="chrome_logo_2x.png">Bu yazılım en iyi Google Chrome ile çalışır yüklemek için tıklayınız.</a>


</p>
</body>
</html>