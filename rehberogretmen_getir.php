<?php

function callback($buffer)
{
 
  return (iconv("iso-8859-9","utf-8", $buffer));
}

ob_start("callback");

include "baglanti.php";
include "veritabani.php";
$kurumkodu=$_POST["kurumkodu"];
$adisoyadi=$_POST["adisoyadi"];
$adisoyadi=iconv("utf-8","iso-8859-9",$adisoyadi);
$silinecek=$_POST["silinecek"];
$tablo=$onek."rehberogretmen";

if ($silinecek=="evet"){
  $query = "delete from $tablo where adisoyadi='$adisoyadi'";
  $veritabani->query($query);
  die($adisoyadi. " silindi!");
}


if ($adisoyadi=="") $adisoyadi='eauiea';
if ($kurumkodu=="")$kurumkodu=724197;

if ($adisoyadi=="mevcutgetir"){
  $sorgusekli="kurumkodu='$kurumkodu'";
}else{
  $sorgusekli="adisoyadi='$adisoyadi'";
}


echo "var kurumkodu=$kurumkodu;\n";

$sorgu="select * from ".$onek."okullar where kurumkodu=$kurumkodu";
$okulsonuc=$veritabani->query($sorgu);
$satir=$okulsonuc->fetch_assoc() or die ("veri bulunamadý");
$okulunadi=$satir['okulunadi'];
$ilcesi=$satir['ilcesi'];
$okulturu=$satir['okulturu'];
//veritabanýndan alýnan verileri javascript deðiþkenlerine aktar:
echo "var gorevyeri='$okulunadi';\n";
echo "var ilcesi='$ilcesi';\n";
echo "var okulturu='$okulturu';\n";
echo "var tablo='$tablo';\n";
echo "var myData =[];\n";


$isimler=array("kurumkodu", "adisoyadi", "cinsiyeti", "gorevebaslamatarihi", "buokuldagorevebaslamatarihi", "gorevturu", "mezunokul", "tezkonusu", "eposta", "ceptelefonu");


  
//tek satýr dönen mysql sorgularý için:

   $query="select * from $tablo where $sorgusekli ORDER BY adisoyadi limit 1";
     $sonuc = $veritabani->query($query) or die("Veri bulunamadi.");
    $i=1;
	$row = $sonuc->fetch_assoc();
	$adisoyadi=$row["adisoyadi"];
	
	while ($i<count($row)){
    echo 'myData["'.$isimler[$i].'"]="'.temizle($row[$isimler[$i]]).'";'."\n";
    $i++;
	}
    
     
echo "var sayi=".$i.";";   
echo "var rehberogretmensayisi=0;\n";
echo "var storeData = [";

if (trim($adisoyadi)!=""){
      $query="select * from $tablo"."_egitimler where adisoyadi='$adisoyadi' ORDER BY sn";
         $sonuc = $veritabani->query($query) ;
      
    if ($sonuc) {   
        for($x = 0 ; $x < $sonuc->num_rows ; $x++)
        {
        $row = $sonuc->fetch_assoc();  //Veritabaninda kaç satir oldugunu ögrenerek tüm satirlar için islem yapmasini istedigimizi belirtiyoruz.
        $output .= "['". temizle($row['aldigiegitimler']) ."'],\n";
         
        }
        echo $output;
    }
}
echo "];";
$rehberogretmensayisi=0;

echo "var olcmecombostore=[\n";

  $query="select adisoyadi from $tablo where kurumkodu=$kurumkodu";
  $sonuc=$veritabani->query($query);
  
  if ($sonuc) {
      $rehberogretmensayisi=$sonuc->num_rows;
     while ($satir=$sonuc->fetch_assoc()){;
            $adisoyadi=$satir['adisoyadi'];
            echo  "['$adisoyadi', '$adisoyadi'],\n";
            
     }
  }
echo "];";

  if ($rehberogretmensayisi>0){
      echo "rehberogretmensayisi=$rehberogretmensayisi;";
  }


ob_end_flush();

?>

