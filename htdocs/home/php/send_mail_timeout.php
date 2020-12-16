<?php
//require_once 'db.php';
//require_once 'functions.php';
//print_r ($result);
//$bidding_id;
/*$id = $bidding['bidder_id'];
$product = $bidding['name'];
$price =  $bidding['now_price'];
$artist = $bidding['artist'];
$material = $bidding['material']; 
$year = $bidding['year'];
$size =  $bidding['size'];
$result =get_user_detail($id);
$email = $result['mail'];
$name = $bidding['bidder'];
$pid = $bidding['id'];*/
$id = $row['bidder_id'];
$product = $row['name'];
$price =  $row['now_price'];
$artist = $row['artist'];
$material = $row['material']; 
$year = $row['year'];
$size =  $row['size'];
$result =get_user_detail($id);
$email = $result['mail'];
$name = $row['bidder'];
$pid = $row['id'];

if($row['publish'] != 0){
    
}
else{
    //echo  $email , $name , $product , $price ,$artist, $material,$year,$size;
$add_result = update_bidding_publish($pid, 1);
if($add_result)
{
    require_once "phpmailer/class.phpmailer.php";
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
    $mail->Subject ="您已在藏山101得標"; //郵件標題
    $mail->Body = "
        <h2>親愛的 $name 您好：</h2>
        感謝您的光臨<br>
        本次得標的商品資料如下：<br>
        --------------------------------------------------<br>
        <h3>得標商品：<u>$product</u> <br></h3>
        <h3 style='color:red;'>得標金額：$price </h3>
        <h3>完整商品資訊請看下一則信件</h3>
        --------------------------------------------------<br>
        若有疑問或金額錯誤請聯絡 0912345678 林小姐<br><br>
        希望能再次為您服務 <br><br>
        藏山101 敬上<br> 
    "; //郵件內容
    $mail->addAttachment('../img/101.png'); //附件，改以新的檔名寄出
    $mail->IsHTML(true);                             //郵件內容為html
    $mail->AddAddress($email);            //收件者郵件及名稱
    
    if(!$mail->Send()){
        //echo '<script type="text/javascript">alert("無法送出信件");window.location.href="../contactus.php";</script>';
        echo '無法送出信件';
    }
    else{
        //若為true 代表新增成功，印出yes
        echo 'yes';
        /*unset($_SESSION['shopping_cart']);
        echo '<script type="text/javascript"> ';
        echo 'alert("已收到您的訂單");' ;
        echo 'window.location.href="../"; ';
        echo '</script> ';*/
    }
   
}
else
{
    //若為 null 或者 false 代表失敗
    echo 'no';	
}


}

?>
