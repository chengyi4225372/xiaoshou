<?php

error_reporting(0); 
@header("content-Type: text/html; charset=utf-8"); 
$ip = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
$ip = ($ip) ? $ip : $_SERVER["REMOTE_ADDR"];
logResult($ip);
 
echo sprintf("保存:%s",$ip);
 
function logResult($word='') {
    $fp = fopen("log.txt","a");
    flock($fp, LOCK_EX) ;
    fwrite($fp,"保存成功：".strftime("%Y%m%d%H%M%S",time()).",IP:".$word."\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}