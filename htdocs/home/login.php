<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，因為此檔案放在 admin 裡，要找到 db.php 就要回上一層 ../php 裡面才能找到
require_once 'php/db.php';

//如過有 $_SESSION['is_login'] 這個值，以及 $_SESSION['is_login'] 為 true 都代表已登入
if(isset($_SESSION['is_login']) && $_SESSION['is_login'])
{
  
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>登入</title>
    <link rel="icon" type="image/png" sizes="192x192"  href="img/101/favicon-96x96.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="shortcut icon" href="images/favicon.ico">
    <script>
        function refresh_code(){ 
            document.getElementById("imgcode").src="confirm/captcha.php"; 
        } 
    </script>
  </head>

  <body>
    <?php include_once 'menu.php';?>

    <div class="row" style="margin:0">
            <div class="col-xs-3"></div>
            <div class="col-xs-6"><h1 class= "alert-info text-center">會員登入</h1></div>
            <div class="col-xs-3"></div>
        </div>
    <div class="content">
      <div class="container">
        <div class="row col-xs-12">
          <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <form class="login">
              <div class="form-group">
                <label for="username">帳號</label>
                <input type="text" class="form-control " id="username" name="username" placeholder="請輸入帳號" required>
              </div>
              <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼" required>
              </div>
              <div class="form-group">
                <label for="img">請輸入下圖字樣：</label>
                <input id="check" type="text"  class="form-control" size="10" maxlength="10" required  /><br />
                <p><img id="imgcode" src="confirm/captcha.php" onclick="refresh_code()" />&nbsp;&nbsp;&nbsp;&nbsp;點擊圖片更換驗證碼
              </div>
              <div class="col-xs-6" align="left">
              <button type="submit" class="btn btn-default">登入</button>
              </div>
              <div class="col-xs-6" align="right">
              <a href = "forget.php">忘記密碼?</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>  
    <script>
      //當文件準備好時，
      $(document).on("ready", function() {
        
        //console.log(1);
        $("#username").focus();
				//當表單 sumbit 出去的時候
				$("form.login").on("submit", function(){
				  //使用 ajax 送出 帳密給 verify_user.php
					$.ajax({
            type : "POST",
            url : "php/verify_user.php", //因為此 login.php 是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 verify_user.php
            data : {
              un : $("#username").val(), //使用者帳號
              pw : $("#password").val(), //使用者密碼
              checkword: $("#check").val()
            },
            dataType : 'html' //設定該網頁回應的會是 html 格式
          }).done(function(data) {
            //成功的時候
            console.log(data);
            if(data == "yes")
            {
              //window.location.href = "index.php"; 
              window.history.back();
            }
            
            else{
              Swal.fire( '登入失敗', '請確認帳號密碼或驗證碼', 'error' );
              //alert("登入失敗，請確認帳號密碼或驗證碼");
              //window.location.reload()
            }
            
          }).fail(function(jqXHR, textStatus, errorThrown) {
            //失敗的時候
            alert("有錯誤產生，請看 console log");
            console.log(jqXHR.responseText);
          });
	        //回傳 false 為了要阻止 from 繼續送出去。由上方ajax處理即可
          return false;
				});
      });
    </script>
    <!-- 頁底 -->

  </body>
</html>
