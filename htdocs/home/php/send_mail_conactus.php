<?php
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
			<h3>親愛的 $name 您好：<h3>
			感謝您的意見及訊息<br>
			本次您的的留言資料如下：<br>
			------------------------------------------------<br>
			您的留言:<br>	
			<p>$message</p><br>
			------------------------------------------------<br>
			希望能再次為您服務 <br><br>
			
			藏山101 敬上
		"; //郵件內容
		$mail->addAttachment('../img/101.png');  //附件，改以新的檔名寄出
		$mail->IsHTML(true);                             //郵件內容為html
		$mail->AddAddress("$email");            //收件者郵件及名稱
		
		if(!$mail->Send()){
			 echo '<script type="text/javascript">alert("無法送出信件");window.location.href="../contactus.php";</script>';
			 //echo '無法送出信件';
		}
		else{
			//若為true 代表新增成功，印出yes
			//echo 'yes';

		}

?>