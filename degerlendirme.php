<?php
session_start();
if(!isset($_SESSION["login"])){
echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
session_destroy();
die();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Etkinlikler Tablosu</title>
<script type="text/javascript" src="debug.js"></script>
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
$tablo=$onek."degerlendirme";
echo "var kurumkodu=$kurumkodu;\n";
echo "var tablo='$tablo';\n";
?> 

var Fisimler= new Array("kurumkodu","sorunlar", "oneriler");
  
var formData = [];

<?php
//bu kısım grid altındaki form için:
 $Fisimler=array("kurumkodu","sorunlar", "oneriler");

  $query="select * from $tablo where kurumkodu=$kurumkodu ORDER BY kurumkodu";
   $sonuc = $veritabani->query($query);
   if ($sonuc) $row = $sonuc->fetch_assoc();
    $i=1;
	
	
	
	while ($i<count($row)){
		echo 'formData["'.$Fisimler[$i].'"]="'.temizle($row[$Fisimler[$i]]).'";'."\n";
		$i++;
	}


?>
</script>
<script type="text/javascript" src="GroupHeaderPlugin.js"></script>

<script type="text/javascript" src="<?php echo  substr($tablo, strlen($onek), strlen($tablo)) ?>.js"></script>
<?php $veritabani->close(); ?>

<link rel="stylesheet" type="text/css" href="grid-examples.css" />
<link rel="stylesheet" type="text/css" href="ext2/shared/examples.css" />
<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
</style>
</head>

<body>
<script type="text/javascript" src="ext2/shared/examples.js"></script><!-- EXAMPLES -->
<div id="form-bolgesi"></div>

</body>
</html>
