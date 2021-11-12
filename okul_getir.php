<?php

function callback($buffer)
{
 
  return (iconv("iso-8859-9","utf-8", $buffer));
}

ob_start("callback");

include "baglanti.php";
include "veritabani.php";
$sifrekontrol=$_POST["sifrekontrol"];
$kurumkodu=$_POST["kurumkodu"];
$tablo=$onek."okullar";

//veritabanýndan alýnan verileri javascript deðiþkenlerine aktar:

     
echo "var okullarim= [\n";

      $query="select * from $tablo ";
         $sonuc = $veritabani->query($query) ;
      
    if ($sonuc) {   
        for($x = 0 ; $x < $sonuc->num_rows ; $x++)
        {
        $row = $sonuc->fetch_assoc();  //Veritabaninda kaç satir oldugunu ögrenerek tüm satirlar için islem yapmasini istedigimizi belirtiyoruz.
        $output .= "['". $row['kurumkodu']."','". temizle($row['okulunadi']) ."'],\n";
         
        }
        echo $output;
    }

echo "];\n";


if ($sifrekontrol){

  $query="select * from $tablo where kurumkodu=$kurumkodu";
  $sonuc=$veritabani->query($query);

  if ($sonuc){
    $row=$sonuc->fetch_assoc();
    echo "var kayitlisifre='".$row["parola"]."';\n";
  }

}

$veritabani->close();
ob_end_flush();

?>

