<?php print_r ($_SESSION); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>php圖形驗證碼</title>
   
    <script>
        function refresh_code(){ 
            document.getElementById("imgcode").src="captcha.php"; 
        } 
    </script>
</head>
<body>
    <form name="form1" method="post" action="./checkcode.php">
        <p>請輸入下圖字樣：</p><p><img id="imgcode" src="captcha.php" onclick="refresh_code()" /><br />
           點擊圖片可以更換驗證碼
        </p>
        <input id="check" type="text" name="checkword" size="10" maxlength="10" required  />
        <input type="submit" name="Submit" value="送出" />
    </form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
</body>
	
	<script>
		$(document).ready(function() {
			$('#check').on("input", function(){
				var ct= $(this).val();
				ct=ct.replace(/^(\r\n|\n|\r|\t| )+/gm, "");
				$('#check').val(ct);
				alert(ct);
		});
	</script>
</html>