<?php
//mysql_select_db("formkastamonu",$baglanti);
$onek="risk_";

if ($veritabani->connect_errno) {
    printf("Baðlanamadý!: %s\n", $mysqli->connect_error);
    die();
}
function temizle($temizlenecek){
      $istenmeyen=array(chr(13),chr(10));
      $yerine=array("","\\n");
      
      
      for($i=0;$i<count($istenmeyen);$i++){
      $temizlenecek=str_replace($istenmeyen[$i],$yerine[$i],$temizlenecek);
      }
      $istenmeyen='’';
      $yerine="\'";
      $temizlenecek=str_replace($istenmeyen,$yerine,$temizlenecek);
      
      $istenmeyen='‘';
      $yerine="\'";
      $temizlenecek=str_replace($istenmeyen,$yerine,$temizlenecek);
            
      $istenmeyen='"';
      $yerine='\"';
      $temizlenecek=str_replace($istenmeyen,$yerine,$temizlenecek);
      

      $istenmeyen="'";
      $yerine="\'";
      $temizlenecek=str_replace($istenmeyen,$yerine,$temizlenecek);
      
      return $temizlenecek;
}
?>