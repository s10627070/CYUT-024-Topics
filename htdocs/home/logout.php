<?php
//啟動 session_start();
session_start();

//把該使用者 session 銷毀，登入資訊就不見了
session_destroy();


echo '<script>window.history.back();</script>';

?>