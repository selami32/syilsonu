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
    <link rel="stylesheet" type="text/css" href="ext2/resources/css/ext-all.css" />
    <link rel="stylesheet" type="text/css" href="ext2/resources/css/xtheme-gray.css" />
<script type="text/javascript" src="debug.js"></script>
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
$tablo=$onek."etkinliklerv2";
echo "var kurumkodu=$kurumkodu;\n";
echo "var onek='$onek';\n";

$sorgu="SELECT okulunadi from ".$onek."okullar where kurumkodu=$kurumkodu";
$sonuc=$veritabani->query($sorgu);
if ($sonuc){
  $satir=$sonuc->fetch_assoc();  
  $okulunadi=$satir['okulunadi'];
  $sonuc->close();
   echo "var okulunadi='$okulunadi';\n";

}

?> 

var Fisimler= new Array("kurumkodu","isbirligi", "eylemguclukler", "uygulamaguclukler", "gorusoneriler");

    
var formData = [];

var myData = [
<?php
 $Fisimler=array("kurumkodu","isbirligi", "eylemguclukler", "uygulamaguclukler", "gorusoneriler");
    

    




//bu k�s�m grid i�in:
$query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
$sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
if ($sonuc->num_rows==0){
        $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `etkinlikadi`, `etkinliksayisi`, `katilanyonetici`, `katilanogretmen`, `katilanrehberogretmen`, `katilanogrenciilkogretim`, `katilanogrenciortaogretim`, `katilanaile`, `katilandiger`) VALUES
      ($kurumkodu, 'Okula Uyum Problemi', '','','', '', '', '', '', ''), 
      ($kurumkodu, '�fke Kontrol�', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Madde Ba��ml�l���', '','','', '', '', '', '', ''), 
      ($kurumkodu, '�at��ma ��zme', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Ergenlik D�nemi', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Akran Bask�s�', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Stresle Ba�a ��kma', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Aile ��i �leti�im Sorunlar�', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'S�n�f Y�netimi', '','','', '', '', '', '', ''), 
      ($kurumkodu, '�nternet Ba��ml�l���', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Bo� Zamanlar� Etkili kullanamama', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Disiplin y�ntemleri ve Olumlu', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Problem ��zme Becerileri', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Hay�r ! Diyebilme Becerisi', '','','', '', '', '', '', '')";
       $veritabani->query($sorgu);
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  //Veritabaninda ka� satir oldugunu �grenerek t�m satirlar i�in islem yapmasini istedigimizi belirtiyoruz.
			$output .= "['". temizle($row['etkinlikadi']) ."','" . 
			intval($row['etkinliksayisi']) ."','" .
			intval($row['katilanyonetici']) ."','" .
			intval($row['katilanogretmen']) ."','".
			intval($row['katilanrehberogretmen']) ."','".
			intval($row['katilanogrenciilkogretim']) ."','".
			intval($row['katilanogrenciortaogretim']) ."','".
			intval($row['katilanaile']) ."','".
			intval($row['katilandiger']) ."'],\n";
	   
    }
     
       
       
    echo $output;

?>
            ];

<?php
//bu k�s�m grid alt�ndaki form i�in:

  $query="select * from ".$onek."etkinliklerv2_ekbilgi where kurumkodu=$kurumkodu ORDER BY kurumkodu";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    $i=1;
	$row = $sonuc->fetch_assoc();
	
	
	
	while ($i<count($row)-1){
    echo 'formData["'.$Fisimler[$i].'"]="'.temizle($row[$Fisimler[$i]]).'";'."\n";
    $i++;
	}


?>
</script>

<?php
echo '<script type="text/javascript" src="etkinliklerv2.js"></script>'."\n";

?>
 <script type="text/javascript" src="GroupHeaderPlugin.js"></script>
<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>

<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="grid-bolgesi"></div>
<div id="form-bolgesi"></div>

<select name="etkinlikcombo" id="etkinlikcombo" style="display: none;">
		<option value='Aile ��i �leti�im Sorunlar�'>Aile ��i �leti�im Sorunlar�</option>
		<option value='Akran Bask�s�'>Akran Bask�s�</option>
		<option value='Bo� Zamanlar� Etkili kullanamama'>Bo� Zamanlar� Etkili kullanamama</option>
		<option value='�at��ma ��zme'>�at��ma ��zme</option>
		<option value='Disiplin y�ntemleri ve Olumlu'>Disiplin y�ntemleri ve Olumlu</option>
		<option value='Ergenlik D�nemi'>Ergenlik D�nemi</option>
		<option value='Hay�r ! Diyebilme Becerisi'>Hay�r ! Diyebilme Becerisi</option>
		<option value='�nternet Ba��ml�l���'>�nternet Ba��ml�l���</option>
		<option value='Madde Ba��ml�l���'>Madde Ba��ml�l���</option>
		<option value='Okula Uyum Problemi'>Okula Uyum Problemi</option>
		<option value='�fke Kontrol�'>�fke Kontrol�</option>
		<option value='Problem ��zme Becerileri'>Problem ��zme Becerileri</option>
		<option value='S�n�f Y�netimi'>S�n�f Y�netimi</option>
		<option value='Stresle Ba�a ��kma'>Stresle Ba�a ��kma</option>
</select>


<iframe id="gonderphp" name="gonderphp" style="display:none;visibility:hidden" src="gonder.php"></iframe>

</body>
</html>
