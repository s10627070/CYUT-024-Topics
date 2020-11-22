<?php 
session_start();
?>
<?php
$user1=$_SESSION["uname"];
include_once ('../dbset.inc.php');
$sql = "SELECT * FROM room where UserName= '$user1'";//要選擇一個登入者的USER USERNAME要依樣
$result = mysqli_query($dblink, $sql);
$row = $result->fetch_assoc();
$Num=@$row['Num'];
$UserName=@$row['UserName'];
$type=@$row['type'];
$phone=@$row['phone'];
$type=@$row['type'];
$sum=@$row['sum'];
require ("../dbset.inc.php");
$result = mysqli_query($dblink, $sql);
$row = @mysqli_fetch_row($result);
$sql="update room set sum='已退房' where type='一般房' and UserName='$user1'";
if (mysqli_query($dblink, $sql)){
    $sql="update berry set pass=null where num=2;"; //退房清空房門密碼
    if(mysqli_query($dblink, $sql))
    {
        $sql="SELECT state FROM berry WHERE num=2;"; 
        $result = mysqli_query($dblink,$sql);
        $row = $result->fetch_assoc();
        $state = @$row['state'];
        if($state == TRUE) // if door is opened
        {
            $connect = ssh2_connect('10.42.0.51',22); // ip = 10.42.0.51, port= 22
            ssh2_auth_password($connect,'pi','sean1002');//user= pi, pass= sean1002
            $stream = ssh2_exec($connect,'python3 closedoor.py 2');// exec close door
        }
        ?><script type="text/javascript">alert("退房成功，歡迎下次再來");window.location.href="https://docs.google.com/forms/d/e/1FAIpQLSeIW-3CsnMv_JDwLoFUY4i_Ket75Mlbkw-YYKDQRhkaPMNN4w/viewform?usp=sf_link";</script><?php
    } 
    else{
        echo '退房失敗！';
    }
													
} 
else{
echo "<p style='color:red;'>退房失敗!</p>";
}
?>