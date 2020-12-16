<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once '../php/db.php';
require_once '../php/functions.php';
//print_r($_SESSION); //查看目前session內容
if (!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
  //直接轉跳到 login.php
  header("Location: login.php");
}
$data = get_art($_GET['i']);
if (is_null($data))
{
  header("Location: work_list.php");
}
//print_r ($data);
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>後台新增藝術品</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="shortcut icon" href="../images/favicon.ico">
  </head>
  <body>
    <?php include_once 'menu.php';?>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <form id="edit_art_form">
              <input type="hidden" id="id" value="<?php echo $data['id']; ?>">
              <div class="form-group">
                <label for="name">名稱</label>
                <input type="input" class="form-control" id="name" value="<?php echo $data['name'];?>">
              </div>
              <div class="form-group">
                <label for="artist">作者</label>
                <input type="input" class="form-control" id="artist" value="<?php echo $data['artist'];?>">
              </div>
              <div class="form-group">
                <label for="size">尺寸</label>
                <input type="input" class="form-control" id="size" value="<?php echo $data['size'];?>">
              </div>
              <div class="form-group">
                <label for="material">媒材</label>
                <input type="input" class="form-control" id="material" value="<?php echo $data['material'];?>">
              </div>
              <div class="form-group">
                <label for="create_year">創作年代</label>
                <input type="input" class="form-control" id="create_year" value="<?php echo $data['create_year'];?>">
              </div>
              <div class="form-group">
                <label for="price">價格</label>
                <input type="input" class="form-control" id="price" value="<?php echo $data['price'];?>">
              </div>
              <div class="form-group">
                <label for="stock">庫存數量</label>
                <input type="input" class="form-control" id="stock" value="<?php echo $data['stock'];?>">
              </div>
              <div class="form-group">
                <label for="Introduction">商品介紹</label>
                <input type="input" class="form-control" id="Introduction" value="<?php echo $data['Introduction'];?>">
              </div>
              <div class="form-group">
                <label for="category">圖片上傳</label>
                <input type="file" name="image_path" accept="image/gif, image/jpeg, image/png">
                <input type="hidden" id="image_path" value="<?php echo($data['image_path']) ? $data['image_path'] : ''; ?>">
                <div class="image">
                  <?php if($data['image_path'] && file_exists("../" . $data['image_path'])):?>
                  <img src='<?php echo "../" . $data['image_path']; ?>'>
                  <?php endif; ?>
                </div>
                <a href='javascript:void(0);' class="del_image btn btn-default">刪除照片</a>
              </div>
              <div class="form-group">
                <label for="category">圖片上傳1</label>
                <input type="file" name="image_path1" accept="image/gif, image/jpeg, image/png">
                <input type="hidden" id="image_path1" value="<?php echo($data['image_path1']) ? $data['image_path1'] : ''; ?>">
                <div class="image1">
                  <?php if($data['image_path1'] && file_exists("../" . $data['image_path1'])):?>
                  <img src='<?php echo "../" . $data['image_path1']; ?>'>
                  <?php endif; ?>
                </div>
                <a href='javascript:void(0);' class="del_image1 btn btn-default">刪除照片2</a>
              </div>
              <label class="radio-inline">
                  <input type="radio" name="publish" value="1" <?php echo ($data['publish'] == 1)?"checked":"";?>> 上架
                </label>
                <label class="radio-inline">
                  <input type="radio" name="publish" value="0" <?php echo ($data['publish'] == 0)?"checked":"";?>> 下架
                </label>
              </div>
              <button type="submit" class="btn btn-default">
                修改
              </button>
              <div class="loading text-center"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
      include_once 'footer.php';
 ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      $(document).on("ready", function() {
      		/**
      		 * 圖片上傳
      		 */
      		//上傳圖片的input更動的時候
      		$("input[name='image_path']").on("change", function(){
      			//產生 FormData 物件
      			var file_data = new FormData(),
      				file_name = $(this)[0].files[0]['name'],
      				save_path = "files/images/";
      			
      			//在圖片區塊，顯示loading
      			$("div.image").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');
      					
      			//FormData 新增剛剛選擇的檔案
      			file_data.append("file", $(this)[0].files[0]);
      			file_data.append("save_path", save_path);
      			//透過ajax傳資料
      			$.ajax({
    					type: 'POST',
				  		url: '../php/upload_file.php',
				    data: file_data,
				    cache: false,       //因為只有上傳檔案，所以不要暫存
				    processData: false, //因為只有上傳檔案，所以不要處理表單資訊
				    contentType: false,  //送過去的內容，由 FormData 產生了，所以設定false
				    dataType : 'html'
					}).done(function(data) {
						console.log(data);
						//上傳成功
						if(data == "yes")
						{
							//將檔案插入
							$("div.image").html("<img src='../" + save_path + file_name + "'>");
							//給予 #image_path 值，等等存檔時會用
							$("#image_path").val(save_path + file_name);
						}
						else
						{
							//警告回傳的訊息
							alert(data);
						}
						
					}).fail(function(data) {
						//失敗的時候
          		alert("有錯誤產生，請看 console log");
          		console.log(jqXHR.responseText);
					});
      		});
      		
      		/**
      		 * 刪除照片
      		 */
      		$("a.del_image").on("click", function(){
      			//如果有圖片路徑，就刪除該檔案
      			if($("#image_path").val() != '')
      			{
      				//透過ajax刪除
	      			$.ajax({
	    					type: 'POST',
					  		url: '../php/del_file.php',
					    data: {
					    		"file" : $("#image_path").val()
					    },
					    dataType : 'html'
						}).done(function(data) {
							console.log(data);
							//上傳成功
							if(data == "yes")
							{
								//將圖片標籤移除，並清空目前設定路徑
								$("div.image").html("");
								//給予 #image_path 值，等等存檔時會用
								$("#image_path").val('');
							}
							else
							{
								//警告回傳的訊息
								alert(data);
							}
							
						}).fail(function(data) {
							//失敗的時候
	          		alert("有錯誤產生，請看 console log");
	          		console.log(jqXHR.responseText);
						});
      			}
      			else
      			{
      				alert("無檔案可以刪除");
      			}
      		});
          //第二張照片
          $("input[name='image_path1']").on("change", function() {
            //產生 FormData 物件
            var file_data = new FormData(),
                file_name = $(this)[0].files[0]['name'],
                save_path = "files/images1/";

            //在圖片區塊，顯示loading
            $("div.image1").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

            //FormData 新增剛剛選擇的檔案
            file_data.append("file", $(this)[0].files[0]);
            file_data.append("save_path", save_path);
            //透過ajax傳資料
            $.ajax({
              type : 'POST',
              url : '../php/upload_file.php',
              data : file_data,
              cache : false, //因為只有上傳檔案，所以不要暫存
              processData : false, //因為只有上傳檔案，所以不要處理表單資訊
              contentType : false, //送過去的內容，由 FormData 產生了，所以設定false
              dataType : 'html'
            }).done(function(data) {
              console.log(data);
              //上傳成功
              if (data == "yes") {
                //將檔案插入
                $("div.image1").html("<img src='../" + save_path + file_name + "'>");
                //給予 #image_path 值，等等存檔時會用
                $("#image_path1").val(save_path + file_name);
              } else {
                //警告回傳的訊息
                alert(data);
              }

            }).fail(function(data) {
              //失敗的時候
              alert("有錯誤產生，請看 console log");
              console.log(jqXHR.responseText);
            });
          });
            //第二章照片刪除
            $("a.del_image1").on("click", function() {
              //如果有圖片路徑，就刪除該檔案
              //console.log($("#image_path1").val());
              if ($("#image_path1").val() != '') {
                //透過ajax刪除
                $.ajax({
                  type : 'POST',
                  url : '../php/del_file.php',
                  data : {
                    "file" : $("#image_path1").val()
                  },
                  dataType : 'html'
                }).done(function(data) {
                  console.log(data);
                  //上傳成功
                  if (data == "yes") {
                    //將圖片標籤移除，並清空目前設定路徑
                    $("div.image1").html("");
                    //給予 #image_path 值，等等存檔時會用
                    $("#image_path1").val('');
                  } else {
                    //警告回傳的訊息
                    alert(data);
                  }

                }).fail(function(data) {
                  //失敗的時候
                  alert("有錯誤產生，請看 console log");
                  console.log(jqXHR.responseText);
                });
              } else {
                alert("無檔案可以刪除");
              }
            });  
      		
        //表單送出
        $("#edit_art_form").on("submit", function() {
          //加入loading icon
          $("div.loading").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

          if (
            $("#name").val() == '' || $("#image_path").val() == '' || $("#size").val() == '' || 
            $("#material").val() == '' || $("#create_year").val() == '' || 
            $("#price").val() == '' || $("#artist").val() == '' || $("#Introduction").val() == '') {
            alert("請填入所有表格");
            //清掉 loading icon
            $("div.loading").html('');
          } else {
            //使用 ajax 送出 帳密給 verify_user.php
            $.ajax({
              type : "POST",
              url : "../php/update_art.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
              data : {
                id : $("#id").val(), //id
                name : $("#name").val(), //介紹
                image_path : $("#image_path").val(), //圖片路徑
                image_path1 : $("#image_path1").val(),
                size : $("#size").val(),
                material : $("#material").val(),
                create_year : $("#create_year").val(),
                price : $("#price").val(),
                stock : $("#stock").val(),
                artist : $("#artist").val(),
                Introduction : $("#Introduction").val(),
                publish : $("input[name='publish']:checked").val(),
              },
              dataType : 'html' //設定該網頁回應的會是 html 格式
            }).done(function(data) {
            		
              //成功的時候
              if (data == "yes") {
                //註冊新增成功，轉跳到登入頁面。
                alert("更新成功，點擊確認回列表");
                window.location.href = "art_list.php";
              } else {
                alert("更新錯誤,資料未變更");
                console.log(data);
                window.location.href='../admin/art_list.php';
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


