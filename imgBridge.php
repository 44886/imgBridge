<?php

/**
 *
 * Put the code into a file without anyother thing.
 * Put the fonts file near this file.
 *
 * By 44886.com
 */

  header("Content-Type:image/jpeg");
        $string = $_SERVER["QUERY_STRING"];
        /*换一张空白图片，如果遇到错误，需要用上*/
        $im = imagecreate(600, 300);
        $black = imagecolorallocate($im, 100, 100, 100);//图片背景
        $white = imagecolorallocate($im, 255, 255, 255);
        /*获取图片的真实地址*/
        $url = strstr($string, "http");
        if (!$url) {
            imagettftext($im, 18, 0, 200, 100, $white, "字体文件的路径（可以相对本文件）", "Error 001");
            imagettftext($im, 14, 0, 150, 150, $white, "字体文件的路径（可以相对本文件）", "请在参数中输入图片的绝对地址。");
            imagepng($im);
            exit();
        }
        @$imgString = $this->urlOpen($url);
        if ($imgString == "") {
            imagettftext($im, 18, 0, 200, 100, $white, "字体文件的路径（可以相对本文件）", "Error 002");
            imagettftext($im, 14, 0, 70, 150, $white, "字体文件的路径（可以相对本文件）", "加载远程图片失败，请确认图片的地址能正常访问。");
            imagepng($im);
            exit();
        }
        /*如果没有错误*/
        $im = imagecreatefromstring($imgString);
        $white = imagecolorallocate($im, 255, 255, 255);
        /*加上水印*/
        imagettftext($im, 12, 0, 20, 20, $white, "字体文件的路径（可以相对本文件）", "水印的文字1");
        imagettftext($im, 12, 0, 5, 35, $white, "字体文件的路径（可以相对本文件）", "水印（可以写你的网址）);
        imagepng($im);
?>
