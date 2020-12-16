<?php
require_once 'php/db.php';
require_once 'php/functions.php';
$datas = get_publish_article();
?>
<!doctype html> 
<html> 
<head> 
    <meta charset="utf-8">
    <title>藏山101</title> 
    <link rel="icon" type="image/png" sizes="192x192"  href="img/101/favicon-96x96.png">
    <script src="js/jquery-3.5.1.js"></script>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/jquery.hiSlider.min.css">
    <link rel="stylesheet" href="css/index.css"> 
    <link rel="stylesheet" href="css/index-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
      
      @media screen and (max-width:768px){
          *{
            margin: 0;
            padding: 0;
            list-style: none;
          }
           .news p {
             width: 100%;
	 
              }
          .recommend p{
            width: 100%;
            
              }
          .message {
            width: 100%

        }
          #single {
              
              width: 100%;
          }
        .carousel{
          max-width: 300px;
        }
        
        .news {
          width: 100%;
          
              }
        table{
          width: 100%;
          
        }


    }
    </style>
</head> 
<body> 
  <?php require_once 'menu.php'; ?>
  <div id="content ">
     <div id="wrap">
		    <ul class="hiSlider hiSlider2">
		        <li class="hiSlider-item"><img src="images/d.jpg" ></li>
		        <li class="hiSlider-item"><img src="images/e.jpg"></li>
            <li class="hiSlider-item"><img src="images/a.jpg" ></li>
		        <li class="hiSlider-item"><img src="images/f.jpg"></li>
            <li class="hiSlider-item"><img src="images/g.jpg"></li>
		    </ul>
		  </div>
      <div class="news">
        <div class="text-effect"><span>最</span><span>新</span><span>消</span><span>息</span></div>
        <table cellspacing="0" rules="rows" frame="below"> 
              <thead> 
                <tr> 
                <th style="width: 60%"></th> 
                <th style="width: 40%"></th> 
                </tr> 
                <?php foreach ($datas as $row):
                    //處理 摘要
                    //去除所有html標籤
                    $abstract = strip_tags($row['title']);
                    $time = strip_tags($row['create_date']);
                    //取得字數
                    $abstract = mb_substr($abstract, 0, 10, "UTF-8");
                    $time = mb_substr($time, 0, 10, "UTF-8");
                    ?> 
              </thead> 
              <tbody> 
                <tr> 
                <td><i class="fa fa-bullhorn" style="font-size:20px"></i> 
                  <?php echo $time ?></td> 
                <td><a href="article.php?p=<?php echo $row['id'];?>">
                  <?php echo $abstract; echo "..."; ?></a></td> 
                </tr> 
              </tbody> 
              <?php endforeach; ?> 
          </table>
      </div>
      <div class="recommend">
  <div class="text-effect">
    <span>
      新
    </span>
    <span>
      作
    </span>
    <span>
      推
    </span>
    <span>
      薦
    </span>
  </div>
  <div id="single" class="carousel slide" data-ride="carousel" data-shift="1">
    <div id="single-quad" class="carousel slide" data-ride="carousel" data-shift="1">
      <div class="carousel-inner">
        <ul class="row item active">
          <li class="col-xs-3 one">
            <img src="image/home-1.jpg" class="img-responsive">
          </li>
          <li class="col-xs-3 two">
            <img src="image/home-3.jpg" class="img-responsive">
          </li>
          <li class="col-xs-3 three">
            <img src="image/home-4.jpg" class="img-responsive">
          </li>
          <li class="col-xs-3 four">
            <img src="image/home2.jpg" class="img-responsive">
          </li>
        </ul>
        <ul class="row item">
          <li class="col-xs-3 five">
            <img src="image/home-1.jpg" class="img-responsive">
          </li>
          <li class="col-xs-3 six">
            <img src="image/home-3.jpg" class="img-responsive">
          </li>
          <li class="col-xs-3 seven">
            <img src="image/home-4.jpg" class="img-responsive">
          </li>
          <li class="col-xs-3 eight">
            <img src="image/home2.jpg" class="img-responsive">
          </li>
        </ul>
      </div>
      <a class="carousel-control left" href="#single-quad" data-slide="next">
        Previous
      </a>
      <a class="carousel-control right" href="#single-quad" data-slide="prev">
        Next
      </a>
    </div>
  </div>
</div>
</div>

  <?php require_once 'footer.php'; ?>
  <script src="js/jquery.1.9.1.js"></script>
	<script src="js/jquery.hiSlider.min.js"></script>
	<script>
	    $('.hiSlider2').hiSlider({
	        isFlexible: true,
	        mode: 'fade',
	        isSupportTouch: false,
	        isShowTitle: false,
	        isShowPage: false,
	        titleAttr: function(curIdx){
	            return $('img', this).attr('alt');
	        }
	    });   
	</script>
  <script src="js/jquery-2.1.1.min.js"></script>   
  <script>window.jQuery || document.write('<\/script>')</script>
  <script src="js/index.js"></script>
  <script> 
      $(function(){ 
      var $table = $('table'); 
      var currentPage = 0;//当前页默认值为0 
      var pageSize = 5;//每一页显示的数目 
      $table.bind('paging',function(){ 
        $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show(); 
      }); 
      var sumRows = $table.find('tbody tr').length; 
      var sumPages = Math.ceil(sumRows/pageSize);//总页数 

      var $pager = $('<div class="page"></div>'); //新建div，放入a标签,显示底部分页码 
      for(var pageIndex = 0 ; pageIndex<sumPages ; pageIndex++){ 
        $('<a href="#" rel="external nofollow" id="pageStyle" onclick="changCss(this)"><span>'+(pageIndex+1)+'</span></a>').bind("click",{"newPage":pageIndex},function(event){ 
        currentPage = event.data["newPage"]; 
        $table.trigger("paging"); 
        //触发分页函数 
        }).appendTo($pager); 
        $pager.append(" "); 
        } 
        $pager.insertAfter($table); 
        $table.trigger("paging"); 

        //默认第一页的a标签效果 
        var $pagess = $('#pageStyle'); 
        $pagess[0].style.backgroundColor="#4949e8"; 
        $pagess[0].style.color="#ffffff"; 
      }); 

      //a链接点击变色，再点其他回复原色 
      function changCss(obj){ 
      var arr = document.getElementsByTagName("a"); 
      for(var i=0;i<arr.length;i++){ 
      if(obj==arr[i]){ //当前页样式 
      obj.style.backgroundColor="#4949e8"; 
      obj.style.color="#ffffff"; 
      } 
      else 
      { 
      arr[i].style.color=""; 
      arr[i].style.backgroundColor=""; 
      } 
      } 
      } 
  </script>
 
</body>   
</html>