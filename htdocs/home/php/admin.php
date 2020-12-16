<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once '../php/db.php';
require_once '../php/functions.php';
$id = $_SESSION['login_user_id'];
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
  
  //echo $id;
  if($id != 1){
    header("Location: ../index.php");
  }
}
  else{
    header("Location: login.php");
  } 


?>