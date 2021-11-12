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
<title>Yönetim</title>
<?php
	$adres=$_GET["ad"];
	
?>
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
        .grid {
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/grid.png) !important;
        }
        .info {
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/cog.png) !important;
        }
	   .anahtar{
            background-image:url(<?php echo $adres; ?>ext2/shared/icons/fam/logout.png) !important;
        }
    </style>
<script type="text/javascript" src="<?php echo $adres; ?>debug.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/resources/css/xtheme-slate.css" />
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
$tablo=$onek."okullar";
echo "var kurumkodu=$kurumkodu;\n";
echo "var onek='$onek';\n";
echo "var adres='$adres';\n";

$sorgu="select * from $tablo where kurumkodu=$kurumkodu";
$sonuc=$veritabani->query($sorgu);
if ($sonuc){ 
  $satir=$sonuc->fetch_assoc();
  $okulunadi=$satir['okulunadi'];
}
echo "var okulunadi='$okulunadi';\n";
$sonuc='';$sorgu='';
?> 
    
var myData = [
<?php


$aciklama=array(
    "1- İl Eylem Planı Kapsamında Gerçekleştirilen Çalışmalar",
    "2-Bölgesel Risk Faktörleri ve Çözüm Önerileri",
    "3-Okulda Meydana Gelen Şiddet Olayları ve Yapılan Çalışmalar",
    "4-Disiplin Suçları"
    
);


$tablolar=array(
"calismalar",
"bolgeselrisk",
"siddetolaylari",
"disiplinsuclari"

);



$bilgivar=array();
$dolutablo=0;

for ($y=0; $y < count($tablolar); $y++){
	$tablolar[$y]=$onek.$tablolar[$y];
	$sorgu="select * from $tablolar[$y] where kurumkodu=$kurumkodu";
	$sonuc=$veritabani->query($sorgu);
		if ($sonuc){
			if ($sonuc->num_rows>0){
				  $dolutablo++;
				  $bilgivar[$y]="Bilgi girildi";
			 }else{ 
				  $bilgivar[$y]="Bilgi girilmedi";
			}
		} ;

}

$sorgu="update $tablo SET girilentablo = '$dolutablo' where kurumkodu=$kurumkodu";
$veritabani->query($sorgu);


     
    for($x = 0 ; $x < count($aciklama) ; $x++)
    {
        $output .= "['". $aciklama[$x] ."','" .         
        $bilgivar[$x]."','" . 
        $tablolar[$x] ."'],\n";
	   
    }
     
       
       
    echo $output;

?>
            ];




</script>

<?php
echo '<script type="text/javascript" src="formlistesi.js"></script>'."\n";
$veritabani->close();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>grid-examples.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $adres; ?>ext2/shared/examples.css" />

<style>
.x-grid3-hd-inner, .x-grid3-cell-inner { white-space:normal; }
.x-grid3-row {
    height: 24.6px;
}
.x-grid-row:hover .x-grid-cell {
    background-color: cyan;
}

.green-row {
    background-color: #ADEBAD;
    cursor: hand;
    cursor:pointer;
}
.red-row {
    background-color: #FFD6CC;
    cursor: hand;
    cursor:pointer;
}
</style>
</head>

<body>
<div id="grid-bolgesi"></div>



</body>
</html>
