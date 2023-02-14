<?php
function captcha($string)
{
    header("Content-type: image/jpeg");
    $imgPath = 'background.jpg';
    $image = imagecreatefromjpeg($imgPath);
    $color = imagecolorallocate($image, 234, 222, 222);
    $fontSize = 25;
    $x = 30;
    $y = 15;
    imagestring($image, $fontSize, $x, $y, $string, $color);
    return imagejpeg($image);
}
?>