<?php
 require_once 'php/db.php';
 require_once 'php/functions.php';
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/menu.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style> body{background-color:#E1DBD6;}</style>
<nav class="navbar  navbar-inverse col-lg-12 " style="border:0; background-color:#C1B39C;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/"><img src="img/101.png"  style="width:50px; margin-top:-15px;margin-left:10px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="padding-left:20px">
        <li style="padding-left:25px"><a  href="/" style="font-size:20px">首頁</a></li>
        <li class="dropdown" style="padding-left:25px; font-size:20px;"><a class="dropdown-toggle" data-toggle="dropdown" href="#">藏‧時間<span class="caret"></span></a>
          <ul class="dropdown-menu" style="font-size:20px; text-align:center">
            <li><a href="artL1.html">陳炳臣</a></li>
            <li><a href="artC1.html">梁平正</a></li>
            <li><a href="artR1.html">吳金維</a></li>
            <li><a href="artL2.html">施繼堯</a></li>
            <li><a href="artC2.html">陳金旺</a></li>
            <li><a href="artR2.html">陳婉萍</a></li>
          </ul>
        </li>
        <li style="padding-left:25px"><a href="tea_list.php" style="font-size:20px">賞器品茶</a></li>
        <li style="padding-left:25px"><a href="bidding_list.php" style="font-size:20px">藏家閣</a></li>
        <li style="padding-left:25px"><a href="contactus.php" style="font-size:20px">聯繫我們</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php        
                          if(isset($_SESSION['is_login']) && $_SESSION['is_login'])
                          {
                            $name = $_SESSION['login_user_name'];
                            $id = $_SESSION['login_user_id'];
                            if  ( $id == 1){ $link = "<li><a href='admin/' style='font-size:20px' >後台首頁</a></li> ";}else{  $link = "";}
                           
                            echo "<li class='dropdown' style='font-size:20px'><a class='dropdown-toggle' data-toggle='dropdown' >$name 已登入<span class='caret'></span></a>
                                    <ul class='dropdown-menu'>
                                      <li><a href='user_edit.php?i=$id' style='font-size:20px'>會員資料編輯</a></li>
                                      <li><a href='user_order.php?i=$id' style='font-size:20px'>會員訂單查詢</a></li>
                                      $link
                                    </ul>
                                  </li>";
                            echo '<li><a href="logout.php" style="font-size:20px"><span class="glyphicon glyphicon-log-in"></span>登出</a></li>';
                            echo '<li><a href="cart/cart.php" style="font-size:20px" target="_blank" id="cart"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor"xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>';
                            echo '<span class="badge">';
                            if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}
                            echo '</span></svg></a></li>';
                          }
                          else{
                            echo '<li><a href="login.php" style="font-size:20px"><span class="glyphicon glyphicon-log-in"></span>登入</a></li>';
                            echo '<li><a href="register.php" style="font-size:20px"><span class="glyphicon glyphicon-user"></span>註冊</a></li>';
                          }         
        ?>
        
        
      </ul>
    </div>
  </div>
</nav>






      


      