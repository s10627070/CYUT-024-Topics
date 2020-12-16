<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

//$email = "ms880525@gmail.com";
//$in_email = "ms880525@gmail.com";

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
    $mail->Password = "harry0525";                 //Gmail密碼
    $mail->From = "ms8805251@gmail.com";        //寄件者信箱
    $mail->FromName = "【自動郵件系統】";                  //寄件者姓名
    $mail->Subject ="已收到您的訊息"; //郵件標題
    $mail->Body = "
        <table>
            <thead>
            <tr>
                <th>項目</th>
                <th>內容</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>姓名</td>
                <td>$name</td>
            </tr>
            <tr>
                <td>您留言的訊息</td>
                <td>$message </td>
            </tr>
            </tbody>
        </table>
    
    "; //郵件內容
    //$mail->addAttachment('../uploadfile/file/dirname.png','new.jpg'); //附件，改以新的檔名寄出
    $mail->IsHTML(true);                             //郵件內容為html
    $mail->AddAddress("$email");            //收件者郵件及名稱
	
    if(!$mail->Send()){
       ?><script type="text/javascript">alert("無法送出");window.location.href="./";</script><?php
    }
	else
	{  
			//mysqli_query($dblink,"update userdata set getpasstime ='$getpasstime' where UserId='$UserId'"); 
	?> 
	<script type="text/javascript"> 
	alert("已收到您的意見"); 
	window.location.href="./"; 
	</script> 
	<?php
    }
	?>