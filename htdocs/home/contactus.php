<!doctype html> 
<html> 
  <head> 
    <title>聯絡我們</title>
    <link rel="icon" type="image/png" sizes="192x192"  href="img/101/favicon-96x96.png">
    <meta charset="utf-8"> 
    <link rel="stylesheet" href="css/menu.css"> 
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <style media="screen">
          #slider {
              max-width: 700px;
              margin:50px auto;
          }
      </style>
  </head> 
  
  <body> 
  <?php  require_once 'menu.php'; ?>
      
      <div id="content">
        <div class="row" style="margin:0">
          <div class="col-xs-12 col-sm-6 col-sm-offset-3"><h1 class= "text-center">藝術展覽、美術工藝、品茗賞藝，從生活中體現藝術文化之美。 歡迎預約賞作、茶敘、業務討論。</h1></div>
		</div>
        <div class="row" style="margin:0; padding-top:50px;">
          <div class="col-xs-12 col-sm-3 col-sm-offset-3" style="font-size:20px;">
            <p style="padding-left:20px">FB：藏山101 @cangshan101  
            <p style="padding-left:20px">TEL：0989 294 650
            <p style="padding-left:20px">LINE：@443szutn
            <p style="padding-left:20px">E-MAIL：allylin59@gmail.com
            <p style="padding-left:20px">ADDRESS：台中市大里區科技路1-38號
          </div>
          <div class="iframe-rwd" style="padding-left:10px">
            <iframe 
                        width="460px" 
                        height="300px"
                        frameborder="0" 
                        style="border:0" 
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA41G06v6qYsmH8xt2vjuVcWi6Lz7VxVhk&q=412台中市大里區科技路1號" 
                        allowfullscreen>
            </iframe>
          </div>
		</div>
        <div class="row" style="margin:0; padding-top:20px;">
        <h3 class= "text-center" style="padding-bottom:20px;">策展 / 空間藝術 / 藝術整合 / 陶藝定制 / 禮品規劃 / 聯繫我們</h3>
          <div class="col-xs-12 col-sm-4 col-sm-offset-4" >
                <form  class="form-horizontal" method="post" action="php/add_contactus.php" style="font-size:18px">
                  <div class="form-group">
                    <label class="control-label" for="name">姓名：</label>
                    <input class="form-control" type="text" name="name" placeholder="請輸入您的姓名..." required>
                  </div> 
                  <div class="form-group">
                    <label class="control-label" for="phone">電話：</label>
                    <input class="form-control"class="form-control" type="tel" name="tel" pattern="[0-9]{10}"  placeholder="請輸入您的電話..." required> 
                  </div> 
                  <div class="form-group">
                    <label class="control-label" for="email">電子郵件：</label>
                    <input class="form-control" type="email" name="email"  placeholder="請輸入E-mail..." >
                  </div> 
                  <div class="form-group">
                    <label class="control-label" for="message"> 訊息：</label>
                    <textarea class="form-control"  name="message" rows="15" cols="40"  placeholder="請輸入您的訊息..." required></textarea><br>
                  </div> 
                  <div class="form-group">
                    <input class="form-control" type="submit" name="submit" value="送出" > 
                  </div>     
                </form>
          </div>
        </div>
        




      </div>


    <?php include_once 'footer.php'; ?>
  </body>
</html>

