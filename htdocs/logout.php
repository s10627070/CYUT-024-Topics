<?php 
session_start();
if(isset($_SESSION["user"]) || ($_SESSION["user"]!=""))
{
	session_destroy();
	header("location:index.php");
}
else
{
	echo '<a href="login.html>未登入、登入連結</a><br/>';
}

?>