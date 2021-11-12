<?php


$veritabani=new mysqli("localhost","root","","ys_yilsonu");
$veritabani->query("SET NAMES 'latin5'");
$veritabani->query("SET character_set_connection = 'latin5'");
$veritabani->query("SET character_set_client = 'latin5'");
$veritabani->query("SET character_set_results = 'latin5'");


/*
$hata="";
$baglanti=mysql_connect("localhost", "root", "");
	if (!$baglanti) 
	{
		$hata="evet";
		die("baglanamadi hata:" . mysql_error());
	}
mysql_query("SET NAMES 'latin5'");
mysql_query("SET character_set_connection = 'latin5'");
mysql_query("SET character_set_client = 'latin5'");
mysql_query("SET character_set_results = 'latin5'");
*/
?>