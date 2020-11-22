<?php
function door_key($num)
{

    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// ip = 10.42.0.51, port= 22
$connect = ssh2_connect('10.42.0.51',22);
ssh2_auth_password($connect,'pi','sean1002');//user= pi, pass= sean1002

//   dbset
    include ("dbset.inc.php");
    $row = @mysqli_fetch_row($result);
    global $dblink;
    $dblink->set_charset('UTF-8'); // 設定資料庫字符集
    $result = $dblink->query("select state from room where num =".strval($num));
    $row=mysqli_fetch_array($result);
    $data = $result->fetch_all();
    $state=@$row['state'];

  //====form======================================================
  echo '<html>
    <form action=bookingroom'.strval($num).'.php method="post">';

    if($state==false) //close door
    {
        
        if(isset($_POST['Open']))
        {
            $stream = ssh2_exec($connect,'python3 opendoor.py '.strval($num));// exec open door
            $sql="update room set state=true where num=".strval($num);
            $result = mysqli_query($dblink, $sql);
            unset($_POST['Open']);
            echo '<input type="submit" name="Close" value=" Close " />';
        }
        else
        {
            echo '<input type="submit" name="Open" value=" Open " />';
        }
           
    }
    
    else if($state==true) // open door
    {
        
        if(isset($_POST['Close']))
        {
            $stream = ssh2_exec($connect,'python3 closedoor.py '.strval($num));// exec close door
            $sql="update room set state=false where num=".strval($num);
            $result = mysqli_query($dblink, $sql);
            unset($_POST['Close']);
            echo '<input type="submit" name="Open" value=" Open " />';
        }
        else
        {
            echo '<input type="submit" name="Close" value=" Close " />';
        }
    }
    
    
echo '</form></html>';
}

?>