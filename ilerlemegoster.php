<?php
include "baglanti.php";
include "veritabani.php";
$sql="select * from $onek"."okullar where kurumkodu=1";
$sonuc=$veritabani->query($sql);
if ($sonuc){
    $satir=$sonuc->fetch_assoc();
    $rakam=$satir['girilentablo'];
    echo "var rakam=$rakam;\n";

}
$veritabani->close();
?>