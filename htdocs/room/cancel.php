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
$sql = "SELECT type,UserName,sum,phone,date1,date2,pay FROM room where type='豪華房' and UserName= '$user1' and sum='已訂房'";
$result = mysqli_query($dblink, $sql);
$row = $result->fetch_assoc();
$num=@$row['num'];
$UserName=@$row['UserName'];
$type=@$row['type'];
$phone=@$row['phone'];
$sum=@$row['sum'];
$date1=@$row['date1'];
$date2=@$row['date2'];
$pay=@$row['pay'];
require ("../dbset.inc.php");
$result = $dblink->query("update room set date1='',date2='',sum='已取消訂單',pay='' where UserName='$UserName'");
$row = @mysqli_fetch_row($result);
if ($result)
{
echo '成功!<br>';
?><script type="text/javascript">alert("成功");window.location.href="../index.php";</script><?php
}
else{
echo "<p style='color:red;'>取消失敗!</p>";
}
?>