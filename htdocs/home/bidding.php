<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';

//載入 functions.php 檔案，透過裡面的方法取得資料庫的資料
require_once 'php/functions.php';
$bidding = get_bidding($_GET['i']);
?>
<!DOCTYPE html>
<html lang="zh-TW">

	<head>
		<title><?php echo $bidding['name']; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/baguetteBox.min.css">
        <link rel="stylesheet" href="css/thumbnail-gallery.css">
        <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
		<link rel="shortcut icon" href="images/favicon.ico">
	</head>
	<body>
  <?php  require_once 'menu.php'; ?>
		<!-- 網站內容 -->
		<div class="content">
			<div class="container">
				<!-- 建立第一個 row 空間，裡面準備放格線系統 -->
				<div class="row" style="margin-top:20px;" >
					<!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
					<div class="col-xs-12" style="padding:0">
						<aside class="col-md-6" style="padding:0"><img src='<?php echo $bidding['image_path']; ?>' width="480" height="460" style="border-radius: 3px; border: 8px solid #fff; -webkit-box-shadow: 0 0 3px 3px #ebebeb; box-shadow: 0 0 3px 3px #ebebeb;"></aside>
						<?php if($bidding):?>
						 <div class="col-md-6" style="padding:0"> 
							<div class="thumbnail" align="center" style="font-size:20px">
                              <input type="hidden" id="id" value="<?php echo $bidding['id'];?>">
                              <input type="hidden" id="name" value="<?php echo $bidding['name'];?>">
                              <input type="hidden" id="tobuyo" value="<?php echo $bidding['tobuy'];?>">
                              <div id="npcc"><input type="hidden" id="now_price" value="<?php echo $bidding['now_price'];?>"></div>
                              <div id="bidderune"><input type="hidden" id="bidder" value="<?php echo $bidding['bidder'];?>"></div>
                              <input type="hidden" id="end_time" value="<?php echo $bidding['end_time'];?>">
                              <p>作品名稱:<?php echo $bidding['name']; ?></p>
                              <p>藝術家:<?php echo $bidding['artist']; ?></p>
                              <p>媒材:<?php echo $bidding['material']; ?></p>
                              <p>創作年代:<?php echo $bidding['year']; ?></p>
                              <p>尺寸:<?php echo $bidding['size']; ?></p>
                              <p>起標價格:<?php echo $bidding['price']; ?></p>
                              <div id="npc"><p>目前價格:<?php echo $bidding['now_price']; ?></p></div>
                              <p>直購價:<?php echo $bidding['tobuy']; ?>
                              <?php 
                              $a = $bidding['now_price'];
                              $b = $bidding['tobuy'];
                              $c = $bidding['end_time'];
                              $d = date("Y-m-d H:i:s", strtotime('+7 hours'));
                              if ($a < $b and $d < $c) {
                                echo '<button type="button" class="btn btn-danger" id="tobuy" style="font-size:16px">立即結標</button>';
                              }
                              ?>
                              </p>
                              <?php 
                              $a = $bidding['now_price'];
                              $b = $bidding['tobuy'];
                              $c = $bidding['end_time'];
                              $d = date("Y-m-d H:i:s", strtotime('+7 hours'));
                              if ($a < $b and $d < $c) {
                                echo '<p>出價增額:
                                        <select id="add">
                                          <option value=100>100</option>
                                          <option value=200>200</option>
                                          <option value=300>300</option>
                                          <option value=400>400</option>
                                          <option value=500>500</option>
                                          <option value=600>600</option>
                                          <option value=700>700</option>
                                          <option value=800>800</option>
                                          <option value=900>900</option>
                                          <option value=1000>1000</option>
                                        </select>
                                      </p>';
                              }
                              ?>
                              <div id="bidderun">
                              <?php 
                              $a = $bidding['now_price'];
                              $b = $bidding['tobuy'];
                              $c = $bidding['end_time'];
                              $d = date("Y-m-d H:i:s", strtotime('+7 hours'));
                              $e = $bidding['bidder'];
                              if ($a == $b or $d >= $c) {
                                echo "<p>得標者:$e</p>";
                              }
                              else{
                                echo "<p>最高出價者:$e</p>";
                              }  
                              ?>
                              </div>
                              <p></p>
                              <?php 
                              $a = $bidding['now_price'];
                              $b = $bidding['tobuy'];
                              $c = $bidding['end_time'];
                              $d = date("Y-m-d H:i:s", strtotime('+7 hours'));
                              if ($a == $b or $d >= $c) {
                                echo "<p style='color:red; font-size:30px;'>此商品已截標</p>";

                                
                              }
                              else{
                                echo "<h4  style='font-size:25px; color:red;'>截標倒數時間<div data-countdown='$c' style='font-size:20px'></div></h4>";
                                echo '<button type="button" class="btn btn-danger" id="bid" style="font-size:16px">出價</button>';
                              }   
                              ?>
                            </div>
                         </div>
						 
						<?php else: ?>
							<h3 class="text-center">無此競標</h3>
					  <?php endif; ?>
					  
					</div>
				</div>
                <?php include_once 'bid.php' ; ?>
			</div>
		</div>
		
		<!-- 頁底 -->
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
    <script>
      $(document).on("ready", function() {
       $("#bid").on("click", function() {
          if (<?php echo $bidding['now_price']; ?> == <?php echo $bidding['tobuy']; ?>){
            alert("競標已結束，由<?php echo $bidding['bidder']; ?>先生/女士得標")
          }else{
            var np = parseInt($("#now_price").val()) + parseInt($("#add").val());
            var tb = <?php echo $bidding['tobuy'];?>;
              if (np > tb) {
                $.ajax({
                  type : 'POST',
                  url : "php/add_record.php",
                  data : {
                    name : $("#name").val(),
                    now_price : $("#tobuy").val(),
                    bidding_id : $("#id").val()
                  },
                })
                }else{
                  $.ajax({
                  type : 'POST',
                  url : "php/add_record.php",
                  data : {
                    name : $("#name").val(),
                    now_price : parseInt($("#now_price").val()) + parseInt($("#add").val()),
                    bidding_id : $("#id").val()
                  },
                })
              }
            var d = new Date();
            var end_time = "<?php echo $bidding['end_time']; ?>";
            var now_time = d.getFullYear()+'-'+(d.getMonth()+1<10 ? '0' : '')+(d.getMonth()+1)+'-'+(d.getDate()<10 ? '0' : '')+d.getDate()+' '+(d.getHours()<10 ? '0' : '')+d.getHours()+':'+(d.getMinutes()<10 ? '0' : '')+d.getMinutes()+':'+(d.getSeconds()<10 ? '0' : '')+d.getSeconds();
            if (now_time < end_time){
              if (np > tb) {
                $.ajax({
                  type : 'POST',
                  url : "php/update_price.php",
                  data : {
                    id : $("#id").val(),
                    now_price : $("#tobuy").val()
                  },
                  }).done(function(data) {
                  console.log(data);
                  //上傳成功
                  if (data == "yes") {
                    alert("競標成功，點擊確認回列表");
                    window.location.href = "bidding.php?i=<?php echo $bidding['id']; ?>";
                  } else {
                    //警告回傳的訊息
                    alert("競標錯誤,競標請先登入");
                  }
                }).fail(function(data) {
                  //失敗的時候
                  alert("有錯誤產生，請看 console log");
                  console.log(jqXHR.responseText);
                });
              }else{
                $.ajax({
                  type : 'POST',
                  url : "php/update_price.php",
                  data : {
                    id : $("#id").val(),
                    now_price : parseInt($("#now_price").val()) + parseInt($("#add").val())
                  },
                  }).done(function(data) {
                  console.log(data);
                  //上傳成功
                  if (data == "yes") {
                    alert("競標成功，點擊確認回列表");
                    window.location.href = "bidding.php?i=<?php echo $bidding['id']; ?>";
                  } else {
                    //警告回傳的訊息
                    alert("競標錯誤,競標請先登入");
                  }
                }).fail(function(data) {
                  //失敗的時候
                  alert("有錯誤產生，請看 console log");
                  console.log(jqXHR.responseText);
                });
              }
            }else{
              alert("已超過競標時間,現在時間"+now_time+"截標時間"+end_time);
              window.location.href = "bidding_list.php";
            }
        } 
       });
       
       $("#tobuy").on("click", function() {
          if (<?php echo $bidding['now_price']; ?> == <?php echo $bidding['tobuy']; ?>){
            alert("競標已結束，由<?php echo $bidding['bidder']; ?>先生/女士得標")
          }else{
            var r = confirm("直購金額為$<?php echo $bidding['tobuy']; ?>請確認好在按確定");
            if (r == true) {
              $.ajax({
                type : 'POST',
                url : "php/add_record_tobuy.php",
                data : {
                  name : $("#name").val(),
                  now_price : $("#tobuyo").val(),
                  bidding_id : $("#id").val()
                },
              });
              var d = new Date();
              var end_time = "<?php echo $bidding['end_time']; ?>";
              var now_time = d.getFullYear()+'-'+(d.getMonth()+1<10 ? '0' : '')+(d.getMonth()+1)+'-'+(d.getDate()<10 ? '0' : '')+d.getDate()+' '+(d.getHours()<10 ? '0' : '')+d.getHours()+':'+(d.getMinutes()<10 ? '0' : '')+d.getMinutes()+':'+(d.getSeconds()<10 ? '0' : '')+d.getSeconds();
              if (now_time < end_time){
                $.ajax({
                  type : 'POST',
                  url : "php/update_price.php",
                  data : {
                    id : $("#id").val(),
                    now_price : $("#tobuyo").val()
                  },
                  }).done(function(data) {
                  console.log(data);
                  //上傳成功
                  if (data == "yes") {
                    alert("競標成功，點擊確認回列表");
                    window.location.href = "bidding.php?i=<?php echo $bidding['id']; ?>";
                  }else if(data == "no1"){
                    alert("商品已截標");
                  }else {
                    //警告回傳的訊息
                    alert("競標錯誤,競標請先登入");
                  }

                }).fail(function(data) {
                  //失敗的時候
                  alert("有錯誤產生，請看 console log");
                  console.log(jqXHR.responseText);
                });
              }else{
                alert("已超過競標時間,現在時間"+now_time+"截標時間"+end_time);
                window.location.href = "bidding_list.php";
              }
         }else{
           window.location.href = "bidding.php?i=<?php echo $bidding['id']; ?>";
         }  
        }
       });
     });
  </script>
  <script>
    setInterval(function() {
        $("#npc").load(location.href+" #npc>*");
      }, 500);
  </script>
  <script>
    setInterval(function() {
        $("#npcc").load(location.href+" #npcc>*");
      }, 500);
  </script>
  <script>
    setInterval(function() {
        $("#bidderun").load(location.href+" #bidderun>*");
      }, 500);
  </script>
  <script>
    setInterval(function() {
        $("#bidderune").load(location.href+" #bidderune>*");
      }, 500);
  </script>
  </body>
</html>
