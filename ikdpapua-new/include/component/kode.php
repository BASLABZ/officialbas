<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: image/png");

// session_register("ANTI_BOT");
session_start();
/*$kode = range(0,9);
$huruf = range(65, 90);
shuffle($kode);
shuffle($huruf);*/
$kode = $_SESSION["ANTI_BOT"];

$img_number = @imagecreatetruecolor(100,30);
$white = imagecolorallocate($img_number,255,255,255);
$black = imagecolorallocate($img_number,0,0,0);
imagefill($img_number,0,0,$white);
imagerectangle($img_number,0,0,99,29,$black);
$number1 = substr($kode,0,1);
$number2 = substr($kode,1,1);
$number3 = substr($kode,2,1);
$number4 = substr($kode,3,1);
$number5 = substr($kode,4,1);
$number6 = substr($kode,5,1);
//$kode = $number1.$number2.$number3.$number4.$number5.$number6;*/
/*$number1 = chr($huruf[4]);
$number2 = $kode[5];
$number3 = chr($huruf[2]);
$number4 = $kode[2];
$number5 = $kode[9];
$number6 = chr($kode[15]);
$_SESSION["ANTI_BOT"] = $number1.$number2.$number3.$number4.$number5.$number6;*/

imagestring($img_number,rand(4,9),4,rand(1,9),$number1,$black);
imagestring($img_number,rand(4,9),21,rand(1,9),$number2,$black);
imagestring($img_number,rand(4,9),38,rand(1,9),$number3,$black);
imagestring($img_number,rand(4,9),55,rand(1,9),$number4,$black);
imagestring($img_number,rand(4,9),72,rand(1,9),$number5,$black);
imagestring($img_number,rand(4,9),89,rand(1,9),$number6,$black);
imagepng($img_number);
?>