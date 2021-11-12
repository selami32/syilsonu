<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
    <title>Form Girişi</title>
    <link rel="stylesheet" type="text/css" href="ext2/resources/css/ext-all.css" />
<script type="text/javascript">
<!--
window.onerror = function (msg, url, line) {
   alert("Message : " + msg );
   alert("url : " + url );
   alert("Line number : " + line );
}



<?php
include "baglanti.php";
include "veritabani.php";

$rastgele=rand();
$sorgu="UPDATE frm_okullar SET girilentablo='$rastgele' where kurumkodu='1'";
$veritabani->query($sorgu);
echo "var rsg=$rastgele;";

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
    <script type="text/javascript" src="denetle.js"></script>

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
					<td height="100%" valign="middle"><img src='logo.png'/>
            <p align="center" class="x-form-field">REHBER ÖĞRETMEN TANITIM KARTI VE <BR>MADDE BAĞIMLILIĞI OKUL RAPORU</p>
						<div id="formDiv"></div>
										
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="/gen/login.htm" id="hov"></a>
					</td>
				</tr>
			</table>			
			</td>
			<td style="padding:0px;border-spacing: 0px;" align="right" colspan="3" valign="bottom"><img src="SolUst.png"/></td>
		</tr>
	</tbody>
</table>
		
</div>


</body>
</html>