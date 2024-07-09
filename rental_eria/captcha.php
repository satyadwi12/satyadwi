<?php
session_start();
function randText (){
    $txt ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghjiklmnpqrstuvwxyz';
    $str='';
    for($i=0;$i<5;$i++)
    {
        $index=rand(0,strlern($txt)-1);
        $str.=$txt[$index];
    }
    return
}

header("Content-type:image/pnp");
$image=imagecreate(70,30);
$backColor=imagecolorallocate($image,168,167,165);
$txtColor=imagecolorallocate($image,250,250,250);
$cod=randText();
$_SESSION[captcha]=$code;
imagestring($image,5,15,7,$code.$txtColor);
imagepnp($image);
imagecolordeallocate($backColor);
imagecolordeallocate($txtColor);
imagedestroy($image);