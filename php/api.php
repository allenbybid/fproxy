<?php
error_reporting(0);
ini_set("error_reporting",E_ALL ^ E_NOTICE);
$p=$_POST;
$g=$_GET;
$proxyurl="o.allenby.bid";
$cookir=dirname(__FILE__)."/cookie/{$proxyurl}.cookie";
$kurl="http://o.allenby.bid/php/api.php?".$_SERVER["QUERY_STRING"];
//echo $kurl;
if(empty($p)){
echo cget(urldecode($kurl));
//echo file_get_contents(urldecode($kurl));
}else{
echo cpost(urldecode($kurl),$p);
}
function daddslashes($str){
return (!get_magic_quotes_gpc())?addslashes($str):$str;
}

function sess(){
$uc=urldecode($g['kurl']);
return md5($uc.time());
}
function cpost($url,$data){
global $cookir;
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_REFERER,"http://unite.pw/");
curl_setopt($ch, CURLOPT_COOKIEFILE,$cookir);
	curl_setopt($ch,CURLOPT_USERAGENT,'MQQBrowser/26 Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; MB200 Build/GRJ22; CyanogenMod-7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1');
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookir);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result=curl_exec($ch);
	curl_close($ch);
	return $result;
}
function cget($url){
global $cookir;
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_REFERER,"http://unite.pw/");
curl_setopt($ch, CURLOPT_COOKIEFILE,$cookir);
curl_setopt($ch, CURLOPT_HTTPHEADER,array ('CLIENT_IP:'.mt_rand(0,255).'.'.mt_rand(0,255).'.'.mt_rand(0,255).'.'.mt_rand(0, 255),'X-Forwarded-For:'.mt_rand(0,255).'.'.mt_rand(0,255).'.'.mt_rand(0,255).'.'.mt_rand(0,255),));
	curl_setopt($ch,CURLOPT_USERAGENT,'MQQBrowser/26 Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; MB200 Build/GRJ22; CyanogenMod-7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookir);
	$result=curl_exec($ch);
	curl_close($ch);
	return $result;
}
?>
