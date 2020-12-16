<?php
//參考至 : https://wmos.info/archives/2755
function visitors()
{
        session_start();
    $counterFile = "counter.txt";   //file_get_contents()讀取檔案內容
    $counter = intval(file_get_contents($counterFile)); //intval()把String變為Integer

    if($_SESSION['counted']!=1) //設置SESSION防止不停刷新頁面
    {
        
        $fp = fopen($counterFile, "w");  //開啟檔案為寫入，並設置為0
        
        if($fp)  //當開啟檔案成功
        {
            
            flock($fp, 2); //鎖定檔案，以防止同時寫入，減少錯誤機率
            
            fwrite($fp, ++$counter);  //把Counter+1並寫入檔案
            
            flock($fp, 3);  //解除鎖定檔案
            
            fclose($fp);  //關閉檔案
            
            $_SESSION['counted']=1;  //防止頁面刷新
        }
    }
    return "瀏覽次數：" . $counter;
}
//echo visitors();
?>