<?php
require_once 'php/db.php';
require_once 'php/functions.php';
$dblink = $_SESSION['link'];
$token = $_GET['token']; 
$email = $_GET['email']; 
$result = $_SESSION['link']->query("select * from user where mail='$email'");
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();
print_r ($row );
$email=@$row['mail'];
$UserPass=@$row['password'];
$UserAcc=@$row['username'];
$UserId = $row['id'];
$UserName = $row['name']; 
$getpasstime =@$row['getpasstime']; 
if($row){ 
$mt = sha1($UserId.$row['username'].$row['password']);//組合驗證碼 
    if($mt==$token){ 
        if(time()-$getpasstime >5*60){ //現在減過去 
            $msg = '該鏈接已過期！';
            echo '<script type="text/javascript">alert("該鏈接已過期");window.location.href="forget.php";</script>';			
            echo $msg;
            }
            else{ 
                //重置密碼... 
                $defalutpassword="@123456";
                //$salt1='$hT7^Fg%6';
                //$salt2='L8&5G5Dgd5';
                //$hash=$salt1.$UserAcc.$salt2.$defalutpassword;
                $password = md5($defalutpassword);
                //$hashpassword=md5($hash);
                $sql = "SELECT * FROM user where mail = '$email'";
                $result = mysqli_query($dblink, $sql);
                $row = @mysqli_fetch_row($result);
                mysqli_query($dblink,"update user set password ='$password',getpasstime ='0' where mail = '$email'"); 	
                echo'<script type="text/javascript"> alert("已將密碼設定為預設密碼[預設密碼為@123456],請盡速更改密碼!"); window.location.href="/"; </script> ';
                exit();
            } 
    }
    else{ 
    echo '<script type="text/javascript"> alert("無效的鏈接，該連結已經被使用，請重新申請，若非本人使用，請盡速聯絡網站管理員!"); window.location.href="forget.php"; </script>';  
	exit();
	} 
}
else
	{  
	echo '<script type="text/javascript"> alert("錯誤的鏈接!"); window.location.href="forget.php"; </script>';  
	exit();
	} 
?>