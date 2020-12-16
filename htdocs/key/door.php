<?php
function door_key($num,$key_pass)
{
// Error Messages
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
//========================== dbset ==================================
include("../dbset.inc.php");
$result = mysqli_query($dblink,"select state,pass from berry where num =".strval($num));
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();
$state=@$row['state'];
$pass = @$row['pass'];
//========================== End =====================================

//===================  Connect to Pi =================================
$connect = ssh2_connect('10.42.0.51',22); // ip = 10.42.0.51, port= 22
ssh2_auth_password($connect,'pi','sean1002');//user= pi, pass= sean1002
//========================== End ====================================


//====form======================================================
  

   
    $less_than_4 = TRUE;   
    $more_than_6 = TRUE;
    $same = TRUE;
    if(4 > strlen($key_pass) )
            {   $less_than_4 = FALSE; }

    else if(6 < strlen($key_pass))
            {    $more_than_6 = FALSE; }

    if ($pass != hash('sha256',$key_pass))
            {    $same = FALSE; }
    

    echo '<html>
    <form action=door.php method="post">';
         
        if($state==false) //close door
        {
            // 按下開門
            if(isset($_POST['Open']) )
            {  
                
                if($key_pass == NULL || $key_pass==' ')
                    echo '密碼空白！！<br/><input type="submit" name="Open" value=" Open " />';
                else if(!$less_than_4)
                    echo '密碼小於4！！<br/><input type="submit" name="Open" value=" Open " />'; 
                else if(!$more_than_6)
                    echo '密碼大於6！！<br/><input type="submit" name="Open" value=" Open " />';
                else if(!$same)
                    echo '密碼錯誤！！<br/><input type="submit" name="Open" value=" Open " />';

                else if($less_than_4 && $more_than_6 && $same) // 正確無誤
                {
                    $stream = ssh2_exec($connect,'python3 opendoor.py '.strval($num));// exec open door
                    $sql="update berry set state=true where num=".strval($num);
                    $result = mysqli_query($dblink, $sql);
                    unset($_POST['Open']); 
                    echo '<input type="submit" name="Close" value=" Close " />';  
                }
            }
            else
                echo '<input type="submit" name="Open" value=" Open " />';
            
        }
//----------------------- if door opened=> show close, if door closed=> show open ----------------------------------------

        else if($state==true) // open door
        {
            // 按下關門
            if(isset($_POST['Close']) )
            {
                 if($key_pass == NULL)
                    echo '密碼空白！！<br/><input type="submit" name="Close" value=" Close " />';
                else if(!$less_than_4)
                    echo '密碼小於四個字！！<br/><input type="submit" name="Close" value=" Close " />'; 
                else if(!$more_than_6)
                    echo '密碼大於6個字！！<br/><input type="submit" name="Close" value=" Close " />';
                else if(!$same)
                    echo '密碼錯誤！！<br/><input type="submit" name="Close" value=" Close " />';

                else if($less_than_4 && $more_than_6 && $same) // 正確無誤
                {
                    $stream = ssh2_exec($connect,'python3 closedoor.py '.strval($num));// exec close door
                    $sql="update berry set state=false where num=".strval($num);
                    $result = mysqli_query($dblink, $sql);   
                    unset($_POST['Close']); 
                    echo '<input type="submit" name="Open" value=" Open " />';
                }
                
            }
            // 沒按關門
            else
                echo '<input type="submit" name="Close" value=" Close " />';
            
        }

  echo '</form></html>';
//=== End Form ======================================================
}
?>