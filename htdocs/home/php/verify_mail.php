<?php
//載入資料庫與處理的方法
require_once 'db.php';
require_once 'functions.php';
//($_POST['un'], $_POST['pw'], $_POST['n'], $_POST['mail'], $_POST['phone']);
$in_email =$_POST['mail']; 
//$in_email ='ms8805251@gmail.com';
$datas = get_user_mail($in_email);
foreach ($datas as $row){$email=@$row['mail'];}
//echo $email;
if($email!=$in_email){//該郵箱尚未註冊！ 
    echo '<script type="text/javascript"> alert("查無此信箱"); //window.location.href="../forget.php"; </script>';
    exit; 
    }
else{ 
    $getpasstime = time(); 
    $UserId = $row['id'];
    $UserName = $row['username']; 
    $token = sha1($row['id'].$row['username'].$row['password'].$row['name'].$getpasstime);
    $url = "https://mountain101.ddns.net/home/active.php?id=".$row['id']."&token=".$token;//構造URL 
    $time= date("Y-m-d H:i:s", strtotime('+7 hours'));
    //echo $url;
}
//$update_result = update_time($UserId,$getpasstime,$token);
require_once "../phpmailer/class.phpmailer.php";
$mail= new PHPMailer();                             //建立新物件
$mail->SMTPDebug = 2;                        
$mail->IsSMTP();                                    //設定使用SMTP方式寄信
$mail->SMTPAuth = true;                        //設定SMTP需要驗證
$mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
$mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
$mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
$mail->CharSet = "utf-8";                       //郵件編碼
$mail->Username = "s10627006@gm.cyut.edu.tw";       //Gamil帳號
$mail->Password = "P0311e88ter@";                 //Gmail密碼
$mail->From = "s10627006@gm.cyut.edu.tw";        //寄件者信箱
$mail->FromName = "【自動郵件系統】開通帳號";                  //寄件者姓名
$mail->Subject ="開通帳號通知"; //郵件標題
$mail->Body = "
	<h3>親愛的 <font color='blue'>".$UserName. "</font>，您好：</h3><br /><h3>您於".$time."註冊了新帳號。<br>請點擊下面的連結開通帳號
    （連結5分鐘內有效）。<br />
    <table style='width: 50%;' border='3' cellpadding='4'>
    <tbody>
    <tr>
    <td>使用者名稱：</td>
    <td>".$UserName."</td>
    </tr>
    <tr>
    <td>信箱：</td>
    <td>".$email."</td>
    </tr>
    <tr>
    <tr>
    </tr>
    <th colspan='2'>開通帳號連結：</th>
    </tr>
    <tr>
    <th colspan='2'>".$url."</th>
    </tr>
    <tr>
    <th colspan='2'>若無法開啟帳號設定信，請將下列URL完整複製到瀏覽器的網址列後按下Enter</th>
    </tr>
    <tr>
    <th colspan='2'>此設定開通通知信請勿外流，以確保你帳號密碼的安全喔~</th>
    </tr>
    <tr>
    <th colspan='2'>如果您在設定的過程遇到任何問題，請使用聯絡我們進行詢問-0912345678</th>
    </tr>
    </tbody>
    </table>
    </h3><br /><h3>此為系統主動發送信函，請勿直接回覆此封信件，若非本人申請，請盡速聯絡網站管理員。</h3>"; //郵件內容
    //$mail->addAttachment('../uploadfile/file/dirname.png','new.jpg'); //附件，改以新的檔名寄出
$mail->IsHTML(true);                             //郵件內容為html
$mail->AddAddress("$email");            //收件者郵件及名稱
	
if(!$mail->Send()){
   //echo '<script type="text/javascript">alert("請填寫信箱地址");window.location.href="../forget.php";</script>';
   echo 'no';
}
else
{  
    $update_result = update_time($UserId,$getpasstime,$token);
        if($update_result)
        {
            //echo 'yes';
            echo '<script type="text/javascript"> alert("郵件發送成功,系統已向您的郵箱發送了一封郵件!\n請登錄到您的郵箱驗證您的帳號！"); window.location.href="../"; </script>';
        }
        else
        {
            echo 'no';
            //echo '<script type="text/javascript">alert("網站錯誤請聯絡網站管理員");//window.location.href="../";</script>';	
        }
        exit;
}
echo '<script type="text/javascript"> alert("郵件發送成功,系統已向您的郵箱發送了一封郵件!\n請登錄到您的郵箱驗證您的帳號！"); window.location.href="../"; </script>';
?>