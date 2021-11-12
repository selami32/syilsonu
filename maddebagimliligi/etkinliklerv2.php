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
    

    




//bu kısım grid için:
$query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY sn";
$sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
if ($sonuc->num_rows==0){
        $sorgu=" INSERT INTO `$tablo` (`kurumkodu`, `etkinlikadi`, `etkinliksayisi`, `katilanyonetici`, `katilanogretmen`, `katilanrehberogretmen`, `katilanogrenciilkogretim`, `katilanogrenciortaogretim`, `katilanaile`, `katilandiger`) VALUES
      ($kurumkodu, 'Okula Uyum Problemi', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Öfke Kontrolü', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Madde Bağımlılığı', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Çatışma Çözme', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Ergenlik Dönemi', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Akran Baskısı', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Stresle Başa Çıkma', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Aile İçi İletişim Sorunları', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Sınıf Yönetimi', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'İnternet Bağımlılığı', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Boş Zamanları Etkili kullanamama', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Disiplin yöntemleri ve Olumlu', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Problem Çözme Becerileri', '','','', '', '', '', '', ''), 
      ($kurumkodu, 'Hayır ! Diyebilme Becerisi', '','','', '', '', '', '', '')";
       $veritabani->query($sorgu);
}
    $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    
    for($x = 0 ; $x < $sonuc->num_rows ; $x++)
    {
			$row = $sonuc->fetch_assoc();  //Veritabaninda kaç satir oldugunu ögrenerek tüm satirlar için islem yapmasini istedigimizi belirtiyoruz.
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
//bu kısım grid altındaki form için:

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
		<option value='Aile İçi İletişim Sorunları'>Aile İçi İletişim Sorunları</option>
		<option value='Akran Baskısı'>Akran Baskısı</option>
		<option value='Boş Zamanları Etkili kullanamama'>Boş Zamanları Etkili kullanamama</option>
		<option value='Çatışma Çözme'>Çatışma Çözme</option>
		<option value='Disiplin yöntemleri ve Olumlu'>Disiplin yöntemleri ve Olumlu</option>
		<option value='Ergenlik Dönemi'>Ergenlik Dönemi</option>
		<option value='Hayır ! Diyebilme Becerisi'>Hayır ! Diyebilme Becerisi</option>
		<option value='İnternet Bağımlılığı'>İnternet Bağımlılığı</option>
		<option value='Madde Bağımlılığı'>Madde Bağımlılığı</option>
		<option value='Okula Uyum Problemi'>Okula Uyum Problemi</option>
		<option value='Öfke Kontrolü'>Öfke Kontrolü</option>
		<option value='Problem Çözme Becerileri'>Problem Çözme Becerileri</option>
		<option value='Sınıf Yönetimi'>Sınıf Yönetimi</option>
		<option value='Stresle Başa Çıkma'>Stresle Başa Çıkma</option>
</select>


<iframe id="gonderphp" name="gonderphp" style="display:none;visibility:hidden" src="gonder.php"></iframe>

</body>
</html>
