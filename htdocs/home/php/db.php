<?php
//啟動 session 等下要來儲存 連線後的資訊，前面加上 @ 是為了要讓此方法執行時，若有錯誤訊息不要顯示。
session_start();
//先設定資料庫資訊，主機通常都用本機
$host = '163.17.9.120';
//$host = '127.0.0.1';
//以root管理者帳號進入資料庫
$dbuser = 'user';
//root的資料庫密碼
$dbpw = 'user';
//登入後要使用的資料庫
$dbname = 'project';

//宣告一個 link 變數，並執行連結資料庫函式 mysqli_connect()，連結結果會帶入 link 當中
$_SESSION['link'] = mysqli_connect($host, $dbuser, $dbpw, $dbname);

if ($_SESSION['link'])
{
  //若傳回正值，就代表已經連線
  //設定連線編碼為UTF-8
  //mysqli_query(資料庫連線, "語法內容") 為執行sql語法的函式
  mysqli_query($_SESSION['link'], "SET NAMES utf8");
  //echo "已正確連線";
}
else
{
  //否則就代表連線失敗 mysqli_connect_error() 是顯示連線錯誤訊息
  echo '無法連線mysql資料庫 :<br/>' . mysqli_connect_error();
}
?>