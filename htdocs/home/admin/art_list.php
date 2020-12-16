<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once '../php/db.php';
require_once '../php/functions.php';
//print_r($_SESSION); //查看目前session內容

//如過沒有 $_SESSION['is_login'] 這個值，或者 $_SESSION['is_login'] 為 false 都代表沒登入
if (!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
  //直接轉跳到 login.php
  header("Location: login.php");
}

//取得所有文章
$arts = get_all_art();
//print_r($arts);
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>後台藝術品列表</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="shortcut icon" href="../images/favicon.ico">
  </head>

  <body>
    <!-- 頁首 -->
		<?php
      include_once 'menu.php';
 ?>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <a href='art_add.php' class="btn btn-default">新增藝術品</a>
          </div>
          <div class="col-xs-12">
            <!-- 資料列表 -->
            <table class="table table-hover">
              <tr>
                <th>名稱</th>
                <th>作者</th>
                <th>尺寸</th>
                <th>媒材</th>
                <th>創作年代</th>
                <th>價格</th>
                <th>庫存數量</th>
                <th>上架狀況</th>
                <th>管理動作</th>
              </tr>
              <?php if($arts):?>
                <?php foreach($arts as $art):?>
                  <tr>
                    <td><?php echo $art['name']; ?></td>
                    <td><?php echo $art['artist']; ?></td>
                    <td><?php echo $art['size']; ?></td>
                    <td><?php echo $art['material']; ?></td>
                    <td><?php echo $art['create_year']; ?></td>
                    <td><?php echo $art['price']; ?></td>
                    <td align="center"<?php  if($art['stock'] <= 1): echo 'style="color:red;text-decoration: underline;"';  endif; ?> ><?php echo $art['stock']; ?></td>
                    <td><?php echo ($art['publish'])?"上架中":"下架";?></td>
                    <td  align="center">
                      <a href='art_edit.php?i=<?php echo $art['id']; ?>' class="btn btn-default">編輯</a>
                      <a href='javascript:void(0);' class='btn btn-default del_art' data-id="<?php echo $art['id']; ?>">刪除</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7">無資料</td>
                </tr>
              <?php endif; ?>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- 頁底 -->
    <?php
      include_once 'footer.php';
 ?>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      $(document).on("ready", function() {

        //表單送出
        $("a.del_art").on("click", function() {
          //宣告變數
          var c = confirm("您確定要刪除嗎？"),
              this_tr = $(this).parent().parent();
          if (c) {
            $.ajax({
              type : "POST",
              url : "../php/del_art.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
              data : {
              id : $(this).attr("data-id") //文章id
              },
              dataType : 'html' //設定該網頁回應的會是 html 格式
            }).done(function(data) {
              //成功的時候

              if (data == "yes") {
                //註冊新增成功，轉跳到登入頁面。
                alert("刪除成功，點擊確認從列表移除");
                this_tr.fadeOut();
              } else {
                alert("刪除錯誤:" + data);
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
