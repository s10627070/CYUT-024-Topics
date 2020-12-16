<?php
require_once 'ECPay.Payment.Integration.php';
include_once("../dbset.inc.php");
global $dblink;
$dblink->set_charset('UTF-8');

$String = print_r( $_POST, true );
file_put_contents( 'tmp/ECPay.txt', $String, FILE_APPEND );
// 必須要支付成功並且驗證碼正確
$MerchantTradeNo1 = $_POST['MerchantTradeNo'];
$TradeAmt1 = $_POST['TradeAmt'];
$PaymentTypeChargeFee1 = $_POST['PaymentTypeChargeFee'];
$RtnMsg1 = $_POST['RtnMsg'];
$RtnCode1 = $_POST['RtnCode'];
$PaymentType1 = $_POST['PaymentType'];
$PaymentDate1 = $_POST['PaymentDate'] ;
if ( $_POST['RtnCode'] =='1' ){
    $sql = "INSERT INTO `ecpay`(`MerchantTradeNo`, `TradeAmt`, `PaymentTypeChargeFee`, `RtnMsg`, `RtnCode`, `PaymentType`, `PaymentDate`) 
    VALUES ('{$MerchantTradeNo1}','{$TradeAmt1}','{$PaymentTypeChargeFee1}','{$RtnMsg1}','{$RtnCode1}','{$PaymentType1}','{$PaymentDate1}');";
	$query = mysqli_query($dblink, $sql);
	if($query){
		echo '1|OK';
	}
}

// 接收到資訊回應綠界


 
// 重新整理回傳參數。
/*$arParameters = $_POST;
define( 'ECPay_MerchantID', '2000132' );
define( 'ECPay_HashKey', '5294y06JbISpM5x9' );
define( 'ECPay_HashIV', 'v77hoKGq4kWxNNIS' );
print_r($arParameters);
foreach ($arParameters as $keys => $value) {
  
    if ($keys != 'CheckMacValue') {
        if ($keys == 'PaymentType') {
            $value = str_replace('_CVS', '', $value);
            $value = str_replace('_BARCODE', '', $value);
            $value = str_replace('_CreditCard', '', $value);
        }
        if ($keys == 'PeriodType') {
            $value = str_replace('Y', 'Year', $value);
            $value = str_replace('M', 'Month', $value);
            $value = str_replace('D', 'Day', $value);
        }
        $arFeedback[$keys] = $value;
    }
}
 
// 計算出 CheckMacValue
$CheckMacValue = ECPay_CheckMacValue::generate( $arParameters, ECPay_HashKey, ECPay_HashIV );*/

 

