<?php 
session_start();
?>
<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php
$user1=$_SESSION["uname"];
include_once ('../dbset.inc.php');
$result = $dblink->query("update room set date1='',date2='',sum='已取消訂單',pay='' where UserName='$user1'");
if ($result)
{
?><script type="text/javascript">alert("成功");window.location.href="../index.php";</script><?php
}
else{
echo "<p style='color:red;'>取消失敗!</p>";
}
?>