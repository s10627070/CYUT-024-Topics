<?php
require_once 'php/db.php';
require_once 'php/functions.php';
$dblink = $_SESSION['link'];
$token = $_GET['token']; 
$id = $_GET['id']; 
$result = $_SESSION['link']->query("select * from user where id='$id'");
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();
//print_r ($row );
$getpasstime =@$row['getpasstime']; 
//echo @$row['token'] ;

if($row){ 
$mt = @$row['token'];
    if($mt==$token){ 
        if(time()-$getpasstime >5*60){ //現在減過去 
            $msg = '該鏈接已過期！';
            echo '<script type="text/javascript">alert("該鏈接已過期");window.location.href="/";</script>';			
            echo $msg;
            }
            else{ 
                $result = mysqli_query($dblink,"update user set status ='1',getpasstime ='0' ,token =' ' where id = '$id'");
                if($result){
                    echo'<script type="text/javascript"> alert("帳號已開通!"); window.location.href="/"; </script> ';
                    exit();
                }
                else{
                    echo'<script type="text/javascript"> alert("系統錯誤請與系統人員聯繫"); window.location.href="/"; </script> ';
                    
                }

            } 
    }
    else{ 
    echo '<script type="text/javascript"> alert("無效的鏈接，該連結已經被使用，請重新申請，若非本人使用，請盡速聯絡網站管理員!"); window.location.href="/"; </script>';  
	exit();
	} 
}
else
	{  
	echo '<script type="text/javascript"> alert("錯誤的鏈接!"); window.location.href="/"; </script>';  
	exit();
	} 
?>