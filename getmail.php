<?php
include_once("dbset.inc.php");//連接數據庫 

$token = $_GET['token']; 
$email = $_GET['email']; 
$result = $dblink->query("select * from userdata where email='$email'");
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();
$email=@$row['email'];
$UserPass=@$row['UserPass'];
$UserAcc=@$row['UserAcc'];
$UserId = $row['UserId'];
$UserName = $row['UserName']; 
$getpasstime =@$row['getpasstime'];  
if($row){ 
$mt = sha1($UserId.$row['UserName'].$row['UserPass']);//組合驗證碼 
if($mt==$token){ 

				if(time()-$getpasstime >5*60){ 
				$msg = '該鏈接已過期！';
	?><script type="text/javascript">alert("該鏈接已過期");window.location.href="forget.php";</script><?php				
				echo $msg;
				
											}
					else{ 
					//重置密碼... 
					$defalutpassword="@123456";
					$salt1='$hT7^Fg%6';
					$salt2='L8&5G5Dgd5';
					$hash=$salt1.$UserAcc.$salt2.$defalutpassword;
					$hashpassword=sha1($hash);
					$sql = "SELECT * FROM userdata where email = '$email'";
					$result = mysqli_query($dblink, $sql);
					$row = @mysqli_fetch_row($result);
					mysqli_query($dblink,"update userdata set UserPass ='$hashpassword',getpasstime ='0' where email = '$email'"); 
					?>		
					<script type="text/javascript"> 
					alert("已將密碼設定為預設密碼[預設密碼為@123456],請盡速更改密碼!"); 
					window.location.href="resetpass.php"; 
					
					</script>  
					<?php
					exit();
						} 
				}
				else{ 
?> 
					<script type="text/javascript"> 
					alert("無效的鏈接，該連結已經被使用，請重新申請，若非本人使用，請盡速聯絡網站管理員!"); 
					window.location.href="forget.php"; 
					</script>  
					
					<?php
					exit();
					} 
		}
	else
	{  
		?> 
		<script type="text/javascript"> 
		alert("錯誤的鏈接!"); 
		window.location.href="forget.php"; 
		</script>  
		<?php
		exit();
	} 
?>