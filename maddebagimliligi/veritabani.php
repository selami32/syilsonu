<?php
//mysql_select_db("formkastamonu",$baglanti);
$onek="madde_";

if ($veritabani->connect_errno) {
    printf("Ba�lanamad�!: %s\n", $mysqli->connect_error);
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

function trUpper($str) {
  $str = strtr($str, '������i', '��I����');
  return strtoupper($str);
}
function trLower($str) {
   $str = strtr($str, '��I����', '������i');
    return strtolower($str);
}

?>