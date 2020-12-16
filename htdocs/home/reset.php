<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<title>正在修改密碼</title> 
</head> 
<body> 
<?php 
require_once 'php/db.php';
$dblink = $_SESSION['link'];
$_POST["email"] = 'ms880525@gmail.com';
$_POST['pass'] = '12345678';
$_POST['un'] =  'Admin';
$result = $dblink->query("select mail,password,username from user where mail ='ms880525@gmail.com'");
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();
print_r ($row);
if(isset($_POST["email"]))
	{
    $email1= $_POST["email"];
    $sql="SELECT * FROM user where mail = '".$email1."'";
    $result = $dblink->query($sql);
    $row = $result->fetch_assoc();
    $demail = $row["mail"];
		if($demail==$email1)
		{
			echo '{"status":"success"}';
			echo '<br>';
			$UserPass =$_POST['pass'];
			$UserPass=@$row['password'];
			$UserAcc=$_POST['un'];
			$UserAcc=@$row['username'];
			$pass= $_POST["pass"];
			$pass1= $_POST["pass1"];
			//$salt1='$hT7^Fg%6';
			//$salt2='L8&5G5Dgd5';
			//$hash=$salt1.$UserAcc.$salt2.$pass;
			$hashpassword=md5($pass);
			if($hashpassword == $UserPass) 
			{
				$UserPass =$_POST['pass'];
				$UserPass=@$row['password'];
				$UserAcc=$_POST['un'];
				$UserAcc=@$row['username'];
				//$salt1='$hT7^Fg%6';
				//$salt2='L8&5G5Dgd5';
				//$hash=$salt1.$UserAcc.$salt2.$pass1;
				$pass2=md5($pass1);//新密碼更新
				//require ("dbset.inc.php");
				$sql="update user set password='$pass2' where mail='$demail'";
				$result = mysqli_query($dblink, $sql);
				$row = @mysqli_fetch_row($result);
				//mysqli_query($dblink,"update userdata set UserPass ='$hashpassword' where email = '$email'");
				echo '<br>';
				?><script type="text/javascript">alert("密碼修改成功");//window.location.href="generic.html";</script> 
				<?php
				echo "修改成功";
			} 
			else
			{
				?>
				<script type="text/javascript">alert("舊密碼輸入錯誤");//window.location.href="resetpass.php";</script> 
				<?php
			}
		}
		else
		{
		?><script type="text/javascript">alert("無此信箱");//window.location.href="resetpass.php"; </script>
		  <?php
		}
	}
  $dblink->close();
?>

</body> 
</html> 