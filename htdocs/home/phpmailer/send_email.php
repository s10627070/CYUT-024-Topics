<?php

/*$email = $_POST['email'];
$in_email = "ms880525@gmail.com";*/


if($email!=$in_email){//該郵箱尚未註冊！ 
?> 
<script type="text/javascript"> 
alert("查無此信箱，請重新輸入!"); 
window.location.href="mail.php"; 
</script> 
<?php  
exit; 
}
else{ 
$getpasstime = time(); 
/*$UserId = $row['UserId'];
$UserName = $row['UserName']; 
$token = sha1($row['UserId'].$row['UserName'].$row['UserPass']); 
$url = "localhost/getmail.php?email=".$email."&token=".$token;//構造URL getmail改路徑
$time= date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;*/
}
require_once "../phpmailer/class.phpmailer.php";

    $mail= new PHPMailer();                             //建立新物件
    $mail->SMTPDebug = 2;                        
    $mail->IsSMTP();                                    //設定使用SMTP方式寄信
    $mail->SMTPAuth = true;                        //設定SMTP需要驗證
    $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
    $mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
    $mail->CharSet = "utf-8";                       //郵件編碼
    $mail->Username = "ms8805251@gmail.com";       //Gamil帳號
    $mail->Password = "aharry0525";                 //Gmail密碼
    $mail->From = "ms8805251@gmail.com";        //寄件者信箱
    $mail->FromName = "測試【自動郵件系統】";                  //寄件者姓名
    $mail->Subject ="網站找回密碼功能"; //郵件標題
    $mail->Body = "測試【自動郵件系統】"; //郵件內容
    //$mail->addAttachment('../uploadfile/file/dirname.png','new.jpg'); //附件，改以新的檔名寄出
    $mail->IsHTML(true);                             //郵件內容為html
    $mail->AddAddress("$email");            //收件者郵件及名稱
	
    if(!$mail->Send()){
       ?><script type="text/javascript">alert("請填寫信箱地址");window.location.href="mail.php";</script><?php
    }
	else
	{  
			//mysqli_query($dblink,"update userdata set getpasstime ='$getpasstime' where UserId='$UserId'"); 
	?> 
	<script type="text/javascript"> 
	alert("郵件發送成功,系統已向您的郵箱發送了一封郵件!\n請登錄到您的郵箱及時重置您的密碼！"); 
	window.location.href="mail.php"; 
	</script> 
	<?php
    }
	?>
	
