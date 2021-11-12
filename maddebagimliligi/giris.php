<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
    <title>Formlar</title>
    <link rel="stylesheet" type="text/css" href="ext2/resources/css/ext-all.css" />
    <link rel="stylesheet" type="text/css" href="ext2/resources/css/xtheme-gray.css" />
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

$kurumkodu=$_GET["kurumkodu"];
$kod=$_GET["k"];
echo "var kurumkodu=$kurumkodu;\n";
echo "var onek='$onek';\n";
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
 
 <?php

 if ($kurumkodu==1) { 
      $sorgu="select parola, girilentablo from ". $onek."okullar where kurumkodu=1";
      
        $sonuc=$veritabani->query($sorgu);
        $satir=$sonuc->fetch_array();
        
        $rsg=$satir[1];
        $parola=$satir[0];
        $dbkod=md5($parola.$rsg);
     
        if( trim($dbkod) == trim($kod)) echo '<script type="text/javascript" src="yonetimgiris.js"></script>'; 
    
 }else{
 

         
            echo '<script type="text/javascript" src="giris.js"></script>';
         }
 ?>
 

    <!-- Common Styles for the examples -->
    <link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />

	</head>
<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->


</body>
</html>