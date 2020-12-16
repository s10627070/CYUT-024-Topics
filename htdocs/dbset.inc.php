<?php 
//資料庫
$db_host='localhost';
$db_username='user';
$db_password='user';
$db_name='nobody';
$dblink = mysqli_connect($db_host,$db_username,$db_password,$db_name);
if(!$dblink)
	{
		echo 'Connect failed: '.mysqli_connect_error(); exit();	
		echo "aaa";
	}
if(!mysqli_set_charset($dblink,"utf8"))
	{
		echo 'Error loading character set utf8:'.'-'. __FILE__ .'-'.mysqli_error($dblink); exit();
		echo "bbb";
	}

?>
