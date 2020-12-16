<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once 'php/db.php';
require_once 'php/functions.php';
//print_r($_SESSION); //查看目前session內容
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	//直接轉跳到 login.php
	header("Location: login.php");
}
if ($_SESSION['login_user_id'] !=$_GET['i'] ){
  header("Location: login.php");
}
$data = get_user($_GET['i']);
//print_r ($data);
//echo $data['status'];
//alert("信箱尚未開通，開通完即可編輯資料");
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>會員個人資料</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js" integrity="sha256-3c8+zl+f7KU8SCc2tH1SAmyiy6kyg1fx9X4x75+xqzc=" crossorigin="anonymous"></script>
  </head>

  <body>
		<?php include_once 'menu.php'; ?>
    <div class="content">
      <div class="container">
        <div class="row">
          <h3 align="center">會員個人資料</h3>
          <div class="col-xs-12">
            <form id="edit_user_form">
            	<input type="hidden" id="id" value="<?php echo $data['id'];?>">
              <div class="form-group">
                <label for="username">帳號</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="請輸入帳號" value="<?php echo $data['username'];?>">
              </div>
              <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼" >
              </div>
              <div class="form-group">
                <label for="name">暱稱</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="請輸入您的暱稱" value="<?php echo $data['name'];?>">
              </div>
              <div class="form-group">
                <label for="name">E-mail</label>
                <input type="email" class="form-control" id="mail" name="mail" placeholder="請輸入您的信箱" value="<?php echo $data['mail'];?>">
              </div>
              <div class="form-group">
                <label for="name">手機號碼</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="請輸入您的手機號碼" value="<?php echo $data['phone'];?>">
              </div>
              <div class="loading text-center"> 
                <?php if($data['status']==0){
                  echo '<button type="button" id="mbtn" class="btn  btn-primary">信箱認證</button>';//<a href="#"></a>
                  }
                  else{echo'<button type="submit" id= "sub"class="btn btn-default">送出</button>';}
                ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>>
    <?php include_once 'footer.php'; ?>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <?php if($data['status']==0){echo '<script>$(document).on("ready", function(){$("input").prop("disabled", true);$("#sub").prop("disabled", true);});</script>';}?>
<script>
    	$(document).on("ready", function(){
        $("#mail").prop("disabled", true);
        $("#mbtn").on("click", function(){
          console.log("submit");
          $.ajax({
            type : "POST",
            url : "php/verify_mail.php", //因為此 login.php 是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 verify_user.php
            data : {
              mail : $("#mail").val()
            },
            dataType : 'html' //設定該網頁回應的會是 html 格式
          });
          alert('信件已送出，請查看您的信箱，若未收到請過幾分鐘後再試');
        });
    		//表單送出
    		$("#edit_user_form").on("submit", function(){
    			//宣告 send_data 物件變數，先取得值
    			var send_data = {
    				id : $("#id").val(),
    				username : $("#username").val(),
    				name : $("#name").val(),
            mail : $("#mail").val(),
            phone : $("#phone").val()
    			};
    			
    			//如果有輸入密碼，再將密碼加入
    			if($("#password").val() != '')
    			{
    				send_data.password = $("#password").val();
    			}
    			
    			//加入loading icon
    			$("div.loading").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');
    			
    			if($("#username").val() == '' || $("#name").val() == ''|| $("#mail").val() == ''|| $("#phone").val() == ''){
    				alert("請填入其他表格");
    				
    				//清掉 loading icon
    				$("div.loading").html('');
    			}else{
					  //使用 ajax 送出 帳密給 verify_user.php
						$.ajax({
	            type : "POST",
	            url : "php/update_member.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
	            data : send_data,
	            dataType : 'html' //設定該網頁回應的會是 html 格式
	          }).done(function(data) {
	            //成功的時候
	            
	            if(data == "yes")
	            {
	              //註冊新增成功，轉跳到登入頁面。
	              alert("更新成功，點擊確認回列表");
	              window.location.href = "/";
	            }
	            else
	            {
	              alert("更新錯誤");
	            }
	            
	          }).fail(function(jqXHR, textStatus, errorThrown) {
	            //失敗的時候
	            alert("有錯誤產生，請看 console log");
	            console.log(jqXHR.responseText);
	          });
    			}
    			return false;
    		});
    	});
    </script>
  </body>
</html>
