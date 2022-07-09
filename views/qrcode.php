<?php

// Source: http://stackoverflow.com/questions/5943368/dynamically-generating-a-qr-code-with-php
// Google Charts Documentation: https://developers.google.com/chart/infographics/docs/qr_codes?csw=1#overview


// CHart Type
$cht = "qr";

// CHart Size
$chs = "300x300";

// CHart Link
// the url-encoded string you want to change into a QR code
$chl = urlencode("http://aamnah.com");

// CHart Output Encoding (optional)
// default: UTF-8
$choe = "UTF-8";

$qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;

echo $qrcode . '<br>';


?>

<img src="<?php echo $qrcode ?>" alt="My QR code">
<?Php echo $_SESSION['id'] ?>