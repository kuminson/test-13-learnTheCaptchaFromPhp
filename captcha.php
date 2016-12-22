<?php
session_start();

// 创建真色彩图片
$image = imagecreatetruecolor(100, 30);
// 配置颜色
$bgcolor = imagecolorallocate($image, 255, 255, 255);
// 填充颜色
imagefill($image, 0, 0, $bgcolor);

// 添加随机数字
/*
for($i=0; $i<4; $i++){
	// 文字尺寸
	$fontsize = 6;
	// 配置颜色
	$fontcolor = imagecolorallocate($image,rand(0,120), rand(0,120), rand(0,120));
	// 文字内容
	$content = rand(0,9);
	// 文字位置
	$x = rand(3,13) + ($i*100/4);
	$y = rand(3,13);
	// 向图片插入字符串
	imagestring($image, $fontsize, $x, $y, $content, $fontcolor);
}
*/

$captch_code = ""; //验证码字符串
// 添加随机字符
for($i=0; $i<4; $i++){
	// 文字尺寸
	$fontsize = 6;
	// 配置颜色
	$fontcolor = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
	// 文字内容
	$data = "abcdefghigkmnqprstuvwxy3456789";
	$content = substr($data, rand(0,strlen($data))-1,1);
	// 拼接验证码
	$captch_code .= $content;
	// 文字位置
	$x = ($i*100/4) + rand(3,13);
	$y = rand(3,13);
	// 向图片插入字符串
	imagestring($image, $fontsize, $x, $y, $content, $fontcolor);
}
// 缓存验证码
$_SESSION["authcode"] = $captch_code;

// 添加干扰点
for($i=0; $i<200; $i++){
	// 配置颜色
	$pointcolor = imagecolorallocate($image, rand(50,200), rand(50,200), rand(50,200));
	// 添加点
	imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
}
// 增加干扰线
for($i=0; $i<5; $i++){
	// 配置颜色
	$linecolor = imagecolorallocate($image, rand(80,220), rand(80,220), rand(80,220));
	// 添加线
	imageline($image, rand(1,99), rand(1,29), rand(1,99), rand(1,29), $linecolor);
}

// 输出图片头信息
header("content-type:image/png");
// 输出图片PNG格式
imagepng($image);
// 销毁图片
imagedestroy($image);
?>