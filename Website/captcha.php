<?php
// Borrowed abit of meterial from: https://www.sitepoint.com/simple-captchas-php-gd/
if (isset($_SESSION["code"])) 
{
    session_unset('code');     
} 
session_start();
$code=rand(10000,99999);
$_SESSION["code"]=$code;
$image = imagecreatetruecolor(250, 50);
$background_color = imagecolorallocate($image, 255, 255, 255);  
imagefilledrectangle($image,0,0,250,50,$background_color);
$line_color = imagecolorallocate($image, 64,64,64); 
for($i=0;$i<5;$i++) {
    imageline($image,0,rand()%50,250,rand()%50,$line_color);
}
$pixel_color = imagecolorallocate($image, 0,0,255);
for($i=0;$i<500;$i++) {
    imagesetpixel($image,rand()%250,rand()%50,$line_color);
}

$txt = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 20, 100, 20, $code, $txt);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>