<?php
include_once("dbset.inc.php");//連接數據庫 
$in_email =$_POST['email']; 
global $dblink;
$dblink->set_charset('UTF-8'); // 設定資料庫字符集
$result = $dblink->query("select UserId,email,UserPass,UserName from userdata where email ='$in_email'");
$row=mysqli_fetch_array($result);
$data = $result->fetch_all(); // 從結果集中獲取所有資料
$email=@$row['email'];
$UserName=@$row['UserName'];
$UserPass=@$row['UserPass'];

if($email!=$in_email){//該郵箱尚未註冊！ 
?> 
<script type="text/javascript"> 
alert("查無此信箱，請重新輸入!"); 
window.location.href="forget.php"; 
</script> 
<?php  
exit; 
}
else{ 
$getpasstime = time(); 
$UserId = $row['UserId'];
$UserName = $row['UserName']; 
$token = sha1($row['UserId'].$row['UserName'].$row['UserPass']); 
$url = "https://sean19981002.ddns.net/getmail.php?email=".$email."&token=".$token;//構造URL 
$time= date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
}
require_once "phpmailer/class.phpmailer.php";

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
    $mail->FromName = "測試【自動郵件系統】";                  //寄件者姓名
    $mail->Subject ="網站找回密碼功能"; //郵件標題
    $mail->Body = "
	<h3>親愛的 <font color='blue'>".$UserName. "</font>，您好：</h3><br /><h3>您於".$time."提交了找回密碼請求。<br>請點擊下面的連結重置密碼 
（連結5分鐘內有效）。<br />
<table style='width: 50%;' border='3' cellpadding='4'>
<tbody>
<tr>
<td>使用者名稱名稱：</td>
<td>".$UserName."</td>
</tr>
<tr>
<td>信箱：</td>
<td>".$email."</td>
</tr>
<tr>
<tr>
<td>預設密碼:</td>
<td>@123456</td>
</tr>
<th colspan='2'>重設密碼連結：</th>
</tr>
<tr>
<th colspan='2'>".$url."</th>
</tr>
<tr>
<th colspan='2'>若無法開啟密碼設定信，請將下列URL完整複製到瀏覽器的網址列後按下Enter</th>
</tr>
<tr>
<th colspan='2'>此設定密碼通知信請勿外流，以確保你帳號密碼的安全喔~</th>
</tr>
<tr>
<th colspan='2'>如果您在設定的過程遇到任何問題，請使用聯絡我們進行詢問-0919557366</th>
</tr>
</tbody>
</table>
</h3><br /><h3>此為系統主動發送信函，請勿直接回覆此封信件，若非本人申請，請盡速聯絡網站管理員。</h3>"; //郵件內容
    //$mail->addAttachment('../uploadfile/file/dirname.png','new.jpg'); //附件，改以新的檔名寄出
    $mail->IsHTML(true);                             //郵件內容為html
    $mail->AddAddress("$email");            //收件者郵件及名稱
	
    if(!$mail->Send()){
       ?><script type="text/javascript">alert("請填寫信箱地址");window.location.href="forget.php";</script><?php
    }
	else
	{  
			mysqli_query($dblink,"update userdata set getpasstime ='$getpasstime' where UserId='$UserId'"); 
	?> 
	<script type="text/javascript"> 
	alert("郵件發送成功,系統已向您的郵箱發送了一封郵件!\n請登錄到您的郵箱及時重置您的密碼！"); 
	window.location.href="forget.php"; 
	</script> 
	<?php
    }
	?>
	
