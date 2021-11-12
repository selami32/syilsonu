<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Yönetim</title>
<?php
include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_GET["kurumkodu"];
$tablo=$onek."okullar";



$tablolar=array(
"calismalar",
"bolgeselrisk",
"yasanansorunlar",
"siddetolaylari",
"disiplinsuclari"
);

for ($y=0; $y < count($tablolar); $y++){
            $tablolar[$y]=$onek.$tablolar[$y];
}



$dolutablo=0;

$sql="select kurumkodu from $tablo";
$okulsonuc=$veritabani->query($sql);

if ($okulsonuc){

    while ($satir=$okulsonuc->fetch_assoc()){
          $kurumkodu=$satir["kurumkodu"];
         
          for ($y=0; $y < count($tablolar); $y++){ 
            $sorgu="select * from $tablolar[$y] where kurumkodu=$kurumkodu";
            $sonuc=$veritabani->query($sorgu);
           
              if ($sonuc){
             //    echo "$dolutablo-$kurumkodu<br>";
                if ($sonuc->num_rows>0){
                           
                    $dolutablo++;
                    
                 }else{ 
                    
                }
              } ;

          }

          $sorgu="update $tablo SET girilentablo = '$dolutablo' where kurumkodu=$kurumkodu";
          $veritabani->query($sorgu);
        $dolutablo=0;
    }
}
$veritabani->close();
echo 'tamamlandi';
?>

</head>