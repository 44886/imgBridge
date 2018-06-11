<?php

header("Content-Type:image/png");//设置本文档将出输出的格式为png图片
$string = $_SERVER["QUERY_STRING"]; //为什么要这样，而不用$_GET呢？因为可能图片地址中有&，那样就会被分割为多个参数，就会出错了。
/*换一张空白图片，如果遇到错误，需要用上*/
$im = imagecreate(600, 300);
$black = imagecolorallocate($im, 100, 100, 100); //图片背景
$white = imagecolorallocate($im, 255, 255, 255);
/*获取图片的真实地址*/
$url = strstr($string, "http");
if (!$url) {
    imagettftext($im, 18, 0, 200, 100, $white, "./fonts/hwxh.ttf", "Error 001");
    imagettftext($im, 14, 0, 150, 150, $white, "./fonts/hwxh.ttf", "请在参数中输入图片的绝对地址。");
    imagepng($im);
    exit();
}
@$imgString = urlOpen($url);
if ($imgString == "") {
    imagettftext($im, 18, 0, 200, 100, $white, "./fonts/hwxh.ttf", "Error 002");
    imagettftext($im, 14, 0, 70, 150, $white, "./fonts/hwxh.ttf", "加载远程图片失败，请确认图片的地址能正常访问。");
    imagepng($im);
    exit();
}
/*如果没有错误*/
$im = imagecreatefromstring($imgString);//上面已经把图片的内容拿到了，直接用它生成一张图片
$white = imagecolorallocate($im, 255, 255, 255);
/*加上水印*/
//imagettftext($im, 12, 0, 20, 20, $white, "./fonts/hwxh.ttf", "水印的文字1");
imagepng($im);//输出最终图片

/*通用远程GET POST函数*/
function urlOpen($url, $data = null, $ua = 'MQQBrowser/26 Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; MB200 Build/GRJ22; CyanogenMod-7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    if ($data) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}
?>