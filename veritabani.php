<?php
//mysql_select_db("formkastamonu",$baglanti);
$onek="ys_";
$siddetonek="siddet_";
$maddeonek="madde_";
$riskonek="risk_";
$rehberlikonek="reh_";
$risk2016onek="risk2016_";


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
      
      $istenmeyen='"';
      $yerine='\"';
      $temizlenecek=str_replace($istenmeyen,$yerine,$temizlenecek);
      

      $istenmeyen="'";
      $yerine="\'";
      $temizlenecek=str_replace($istenmeyen,$yerine,$temizlenecek);
      
      return $temizlenecek;
}
?>