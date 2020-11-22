<?php
function generateQRfromGoogle() //$room = roomnumber;  $size = QR Code's size 
{   
    echo '<img src="https://chart.googleapis.com/chart?chs='.$size.'x'.$size.'&cht=qr&chl='.$room.'&choe=UTF-8" title="Link to Google.com" />';
    echo '<a href="door.php"> Key </a>';
};

$room = 'http://localhost/room1.php';
generateQRfromGoogle(); 

?>

