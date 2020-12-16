<?php
session_start();
include_once("../dbset.inc.php");//連接數據庫 
$uname =$_POST['uname'];
global $dblink;
$dblink->set_charset('UTF-8'); // 設定資料庫字符集
$result = $dblink->query("select UserId,email,UserPass,UserName from userdata where UserName ='$uname'");
$row=mysqli_fetch_array($result);
$email=@$row['email'];
$error = "";
$msg = "";
$uname = "";
$user = "";
$phone ="";
$showform = true;
$roomA=['豪華房(1000)'];
$salt1 = '$hT7^Fg%6';
$salt2 = 'L8&5G5Dgd5';
$date1 = '';
$date2 = '';
include_once ('../dbset.inc.php');
$sql = "SELECT * FROM room where num= '1'";
$result = mysqli_query($dblink, $sql);
$row = $result->fetch_assoc();
$num=@$row['num'];
$UserName=@$row['UserName'];
$type=@$row['type'];
$phone=@$row['phone'];
$sum=@$row['sum'];
$date1=@$row['date1'];
$date2=@$row['date2'];
if (isset($_POST["submit"])) 
{
								if(($_SESSION["user"]==""))
								{
								?><script type="text/javascript">alert("請先登入");window.location.href="../generic.html";</script><?php
								echo '<li><a href="../generic.html">登入</a></li>';
								}
								else{
								
								$phone = $_POST['phone'];
								$uname = $_POST['uname']; //姓名
								if (is_array($_POST['asel'])){
									foreach ($_POST['asel'] as $cvalue) {
										$acity = $cvalue;
									}
								}
								$cityA = $_POST['acountl'];
								if (is_array($_POST['acountl'])) {
									foreach ($_POST['acountl'] as $svalue) {
										$acount = $svalue;
									}
								}
								$countA = $_POST['rooml'];								
								if (is_array($_POST['rooml'])) {
									foreach ($_POST['rooml'] as $rvalue) {
										$aroom = $rvalue;
									}
								}
								$roomA = $_POST['rooml'];
								//$scheck =implode(" ",$langA);
								$date1 = $_POST['date1'];//入住日期
								$date2 = $_POST['date2'];//退房日期
								$first =strtotime($date1);
								$end =strtotime($date2);
								$days=$end-$first;
								$prices='1000';
								$ez=($prices*$days)/3600/24;
								if (empty($aroom)) 	{
											?><script type="text/javascript">alert("請選擇房間");window.location.href="../room/room1.php";</script><?php
													}
									else{
										if(empty($phone))
										{
										?><script type="text/javascript">alert("請輸入電話");window.location.href="../room/room1.php";</script><?php
										}
										else{
										if(empty($date1))									
										{
											?><script type="text/javascript">alert("入住日期空白");window.location.href="../room/room1.php";</script><?php
										}
										else{
											if(empty($date2))
											{
												?><script type="text/javascript">alert("退房日期空白");window.location.href="../room/room1.php";</script><?php
											}
											else{
												if(($days)/3600/24 <=0)
												{
													?><script type="text/javascript">alert("日期輸入有誤");window.location.href="../room/room1.php";</script><?php
											}
											else{
												if($sum=="已訂房") 
												{	?><script type="text/javascript">alert("房間已沒有");window.location.href="../index.php";</script><?php
											}
													else{
														if($_SESSION["uname"]!=$uname)
														{
															?><script type="text/javascript">alert("姓名不一樣");window.location.href="../room/room1.php";</script><?php
														}
														else{
															$showform = false;
															$msg.="訂購人: " .$_SESSION["uname"]. "<br/>";
															$msg.="房間名稱: ". $aroom ."<br/>";
															$msg.= "入住日期: ". $date1 . "<br/>";
															$msg.= "退房日期: ". $date2 . "<br/>";
															$msg.= "電話:" .$phone ."<br/>";
															date_default_timezone_set("Asia/Taipei");
															$msg.= "訂購時間" . date("h:i:sa")."<br/>";
															require ("../dbset.inc.php");
															$result = mysqli_query($dblink, $sql);
															$row = @mysqli_fetch_row($result);
															$sql="update room set UserName='$uname',phone='$phone',date1='$date1',date2='$date2',sum='已訂房',prices='$ez' where type='$aroom'";
																if (mysqli_query($dblink, $sql))
																{
																	echo '訂房成功!<br>';
																	?><script type="text/javascript">alert("訂房成功，請至首頁右邊MENU點選您的房間豪華房");window.location.href="../index.php";</script><?php
																include_once ('../dbset.inc.php');
																$pname =$_POST['uname']; 
																global $dblink;
																$dblink->set_charset('UTF-8'); // 設定資料庫字符集
																$result = $dblink->query("select UserId,email,UserPass,UserName from userdata where UserName ='$pname'");
																$row=mysqli_fetch_array($result);
																$data = $result->fetch_all();
																$UserName=@$row['UserName']; 
																
																if(empty($UserName)){//該郵箱尚未註冊！ 
																?> 
																<script type="text/javascript"> alert("查無此人，請重新輸入，請重新輸入!"); window.location.href="../forget.php"; </script> 
																<?php  
																exit; 
																}
																else{ 
																}
																	require_once "../phpmailer/class.phpmailer.php";
																	$mail= new PHPMailer();                             //建立新物件
																	$mail->SMTPDebug = 2;                        
																	$mail->IsSMTP();                                    //設定使用SMTP方式寄信
																	$mail->SMTPAuth = true;                        //設定SMTP需要驗證
																	$mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
																	$mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
																	$mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
																	$mail->CharSet = "utf-8";                       //郵件編碼
																	$mail->Username = "s10627006@gm.cyut.edu.tw";       //Gamil帳號
																	$mail->Password = "P0311e88ter@";                 //Gmail密碼
																	$mail->From = "s10627006@gm.cyut.edu.tw";        //寄件者信箱
																	$mail->FromName = "測試【自動郵件系統】";                  //寄件者姓名
																	$mail->Subject ="訂購明細"; //郵件標題
																	$mail->Body = "
																	<h3>親愛的 <font color='blue'>".$UserName. "</font> ，您好：</h3><br /><h3>您於".$time."訂購了 ".$aroom."。<br />
																	<table style='width: 50%;' border='3' cellpadding='4'>
																	<tbody>
																	<tr>
																	<td>名稱：</td>
																	<td>".$UserName."</td>
																	</tr>
																	<tr>
																	<td>信箱：</td>
																	<td>".$email." </td>
																	</tr>
																	<tr>
																	<td>入住日期:</td>
																	<td>".$date1." 15:00後入住</td>
																	</tr>
																	<tr>
																	<td>退房日期:</td>
																	<td>".$date2." 11:00前退房</td>
																	</tr>
																	<tr>
																	<td>應付金額：</td>
																	<td>".$ez." </td>
																	</tr>
																	<tr>
																	<th colspan='2'>如果您在的定訂購資訊有任何問題，請使用聯絡我們進行詢問-0919557366</th>
																	</tr>
																	</tbody>
																	</table>
																	</h3><br /><h3>此為系統主動發送信函，請勿直接回覆此封信件，若非本人申請，請盡速聯絡網站管理員。</h3>"; //郵件內容
																	//$mail->addAttachment('../uploadfile/file/dirname.png','new.jpg'); //附件，改以新的檔名寄出
																$mail->IsHTML(true);                             //郵件內容為html
																$mail->AddAddress("$email");            //收件者郵件及名稱
																
																if(!$mail->Send())
																	{
																		?><script type="text/javascript">alert("請填寫信箱地址");window.location.href="../room1.php";</script><?php
																	}
																	else
																	{  
																		mysqli_query($mysqli,"update userdata set getpasstime ='$getpasstime' where id='$uid'"); 	
																	?> 
																	<script type="text/javascript"> 
																	alert("訂購成功,系統已向您的郵箱發送了一封確認郵件!\n請登錄到您的郵箱查看！"); 
																	window.location.href="../index.php"; 
																	</script> 
																	<?php
																	}
																} 
																else{
																	echo '新增失敗!';	
																	}
															}
														}
													}
												}
											}
										}
									}
								}

}
	?>