<?php
//載入資料庫與處理的方法
require_once 'db.php';
require_once 'functions.php';
//print_r($_POST);
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
    $cname = $_POST["customername"];
    $cmail = $_POST["customeremail"];
    $caddress = $_POST["customeraddress"];
    $ctel = $_POST["customerphone"];
    $cpaytype = $_POST["paytype"];

    if(isset($_POST["place_order"]))  
    {  
        
        if(!empty($_SESSION["shopping_cart"]))  
        {  
            $total = 0; 
            $login_user_id=$_SESSION['login_user_id'];
            $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
            $orderid =  $yCode[intval(date('Y')) - 2011] .date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 5); //生成訂單號
            foreach($_SESSION["shopping_cart"] as $keys => $values)  
            {  
                $product_id = $values['product_id']; //產品id
                $product_name = $values['product_name'];//產品名稱
                $product_price = $values['product_price'];//產品單價
                $product_quantity = $values['product_quantity'];//產品數量
                $total = $total + ($values["product_quantity"] * $values["product_price"]);//產品總計
                $art = get_art($product_id);
                $stock = $art['stock'];
                if($stock >= $product_quantity ){
                    $add_result = add_order_detailid($orderid, $product_id, $product_name, $product_price, $product_quantity,$login_user_id);
                    $stock = $stock - $product_quantity;
                    $update_order_stock =  update_order_stock($product_id,$stock);
                }
                else{
                    echo '<script type="text/javascript"> ';
                    echo 'alert("庫存量不足");' ;
                    echo 'window.location.href="../cart/cart.php"; ';
                    echo '</script> ';
                }
               /* echo $product_id;
                echo '<br>';
                echo  $product_name;
                echo '<br>';
                echo  $product_price;
                echo '<br>';
                echo $product_quantity;
                echo '<br>';
                echo $total;
                echo '<br>';
                echo $orderid;
                echo '<br>';
                echo $login_user_id;
                echo '<br>';*/
                //print_r($_SESSION["shopping_cart"]);
               }
                if($add_result)
                { 
                    $add_results=add_order($orderid,$login_user_id,$total,$cname,$cmail,$caddress,$ctel,$cpaytype);
                    if($add_results){
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
                        $mail->Subject ="已收到您的訂單"; //郵件標題
                        $mail->Body = "
                            親愛的 $cname 您好：<br>
                                感謝您的光臨<br>
                                本次消費詳細資料如下：<br>
                                --------------------------------------------------<br>
                                訂單編號： $orderid<br>
                                客戶姓名：$cname <br>
                                電子郵件：$cmail <br>
                                電話： $ctel <br>
                                住址： $caddress <br>
                                付款方式： $cpaytype <br>
                                消費金額：$total <br>
                                --------------------------------------------------<br>
                                希望能再次為您服務 <br>
                                藏山101 敬上<br>  
                        "; //郵件內容
                        $mail->addAttachment('../uploadfile/file/dirname.png','new.jpg'); //附件，改以新的檔名寄出
                        $mail->IsHTML(true);                             //郵件內容為html
                        $mail->AddAddress("$cmail");            //收件者郵件及名稱
                        
                        if(!$mail->Send()){
                            //echo '<script type="text/javascript">alert("無法送出信件");window.location.href="../contactus.php";</script>';
                            echo '無法送出信件';
                        }
                        else{
                            //若為true 代表新增成功，印出yes
                            echo 'yes';
                            unset($_SESSION['shopping_cart']);
                            echo '<script type="text/javascript"> ';
                            echo 'alert("已收到您的訂單");' ;
                            echo 'window.location.href="../"; ';
                            echo '</script> ';
                        }


                   // }
                   
                }
                else
                {
                    //若為 null 或者 false 代表失敗
                    //echo 'no';
                    echo '<script type="text/javascript"> ';
                    echo 'alert("請重新送出表單");' ;
                    echo 'window.location.href="../cart/cart.php"; ';
                    echo '</script> ';
                }

                }

        }
            
    }       
}
else
{
	//若為 null 或者 false 代表失敗
    //echo 'no';	
	echo '<script type="text/javascript"> ';
	echo 'alert("請先登入");' ;
	echo 'window.location.href="../login.php"; ';
	echo '</script> ';
}

?>
