
<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once 'php/db.php';
require_once 'php/functions.php';
//print_r($_SESSION); //查看目前session內容
//取得所有文章
$datas = get_all_bidding();
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>藏家閣</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/baguetteBox.min.css">
	<link rel="stylesheet" href="css/thumbnail-gallery.css">
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <style>
        #bgc{
          font-size:20px; 
          border-radius: 3px; 
          border: 8px solid #fff; 
          margin: 15px; 
          -webkit-box-shadow: 0 0 3px 3px #ebebeb; 
          box-shadow: 0 0 3px 3px #ebebeb; 
          background-color:white;
        }
        #bgc:hover{
          transform: scale(1.05);
          border: 1px solid gray;
        }
    </style>
  </head>

  <body>
  <?php  require_once 'menu.php'; ?>
		<div class="content">
			<div class="container">
                <div class="row">
                <?php if(!empty($datas)):?>
                <?php foreach($datas as $row):?>
                <div class="col-xs-12 col-sm-4" style="margin-top:25px">
                  <div align="center" id="bgc" class=" col-sm-12" >
                    <input type="hidden" id="id" value="<?php echo $row['id'];?>">
                    <input type="hidden" id="end_time" value="<?php echo $row['end_time'];?>">
                    <img src='<?php echo $row['image_path']; ?>' width="280" height="210" class="rounded" style="margin-top:15px;">
                    <p style="padding-top:15px">作品名稱:<?php echo $row['name']; ?></p>
                    <p>藝術家:<?php echo $row['artist']; ?></p>
                    <div id="price" style="display:none;"><p >目前價格:<?php echo $row['now_price']; ?></p></div>
                    <p >目前價格:<?php echo $row['now_price']; ?></p>
                    <p>直購價:<?php echo $row['tobuy']; ?></p>
                    <?php 
                      $a = $row['now_price'];
                      $b = $row['tobuy'];
                      $c = $row['end_time'];
                      $d = date("Y-m-d H:i:s", strtotime('+7 hours'));
                      $e = $row['bidder_username'];
                      //print_r($row);
                      if ($a == $b or $d >= $c) {
                        echo "<p>得標者:$e</p>";
                      }
                      else{
                        echo "<p id='bidder'>最高出價者:$e</p>";
                      }  
                    ?>
                    <p></p>
                    <?php 
                      $a = $row['now_price'];
                      $b = $row['tobuy'];
                      $c = $row['end_time'];
                      $d = date("Y-m-d H:i:s", strtotime('+7 hours'));
                      if ($a == $b or $d >= $c) {
                        echo "<p id='timeout' style='color:red; font-size:30px;'>此商品已截標</p>";
                        require_once 'php/send_mail_timeout.php';
                      }
                      else{
                        echo "<h4 style='font-size:25px; color:red;'>截標倒數時間<div data-countdown='$c' style='font-size:20px'></div></h4>";
                      } 
                    ?>
                    <a href="bidding.php?i=<?php echo $row['id']; ?>" class="btn btn-primary" style="font-size:16px">詳細資料</a>
                  </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <h3 class="text-center">尚無競標品</h3>
                <?php endif; ?>
              </div>
		    </div>
		</div>
        <?php include_once 'footer.php'; ?>

    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.countdown.js"></script>
	<script type="text/javascript" src="js/baguetteBox.min.js"></script>
	<script type="text/javascript">
		baguetteBox.run('.tz-gallery');
        
        $('[data-countdown]').each(function() {   
        var $this = $(this), finalDate = $(this).data('countdown');   
        $this.countdown(finalDate, function(event) {   
          $this.html(event.strftime('%D 天 %H:%M:%S'));   
        });   
      }); 
	</script>

  </body>
</html>
