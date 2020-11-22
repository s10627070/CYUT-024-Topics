<?php
function generateQRfromGoogle($room,$size) //$room = roomnumber;  $size = QR Code's size 
{   
    echo '<img src="https://chart.googleapis.com/chart?chs='.$size.'x'.$size.'&cht=qr&chl='.$room.'&choe=UTF-8" title="Link to Google.com" />';
};

$room = 'http://localhost/room3.php';
generateQRfromGoogle($room,300); 

?>

