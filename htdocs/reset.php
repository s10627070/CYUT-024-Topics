<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<title>正在修改密碼</title> 
</head> 
<body> 
<?php 
//session_start (); 
include_once("dbset.inc.php");//連接數據庫 
$result = $dblink->query("select email,UserPass,UserName from userdata where email ='$in_email'");
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();

if(isset($_POST["email"]))
	{
    $email1= $_POST["email"];
    $sql="SELECT * FROM userdata where email = '".$email1."'";
    $result = $dblink->query($sql);
    $row = $result->fetch_assoc();
    $demail = $row["email"];
		if($demail==$email1)
		{
			echo '{"status":"success"}';
			echo '<br>';
			$UserPass =$_POST['UserPass'];
			$UserPass=@$row['UserPass'];
			$UserAcc=$_POST['UserAcc'];
			$UserAcc=@$row['UserAcc'];
			$pass= $_POST["pass"];
			$pass1= $_POST["pass1"];
			$salt1='$hT7^Fg%6';
			$salt2='L8&5G5Dgd5';
			$hash=$salt1.$UserAcc.$salt2.$pass;
			$hashpassword=sha1($hash);
			if($hashpassword == $UserPass) 
			{
				$UserPass =$_POST['UserPass'];
				$UserPass=@$row['UserPass'];
				$UserAcc=$_POST['UserAcc'];
				$UserAcc=@$row['UserAcc'];
				$salt1='$hT7^Fg%6';
				$salt2='L8&5G5Dgd5';
				$hash=$salt1.$UserAcc.$salt2.$pass1;
				$pass2=sha1($hash);//新密碼更新
				require ("dbset.inc.php");
				$sql="update userdata set UserPass='$pass2' where email='$demail'";
				$result = mysqli_query($dblink, $sql);
				$row = @mysqli_fetch_row($result);
				//mysqli_query($dblink,"update userdata set UserPass ='$hashpassword' where email = '$email'");
				echo '<br>';
				?><script type="text/javascript">alert("密碼修改成功");window.location.href="generic.html";</script> 
				<?php
				echo "修改成功";
			} 
			else
			{
				?>
				<script type="text/javascript">alert("舊密碼輸入錯誤");window.location.href="resetpass.php";</script> 
				<?php
			}
		}
		else
		{
		?><script type="text/javascript">alert("無此信箱");window.location.href="resetpass.php"; </script>
		  <?php
		}
	}
  $dblink->close();
?>

</body> 
</html> 