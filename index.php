<?php
error_reporting(0);
//print_r($_SERVER);
$domain=$_SERVER['SERVER_NAME'];
$port=$_SERVER['SERVER_PORT'];
$fpuix=md5(microtime());
$rued=explode('.',$_SERVER['REQUEST_URI']);
$loaa=count($rued);
$loac=$rued[$loaa-1];
//print_r($rued);
if(strstr($rued[0],'/')){
$ruee=explode('/',$rued[0]);
$rueec=count($ruee);
$load=$ruee[$rueec-1];
}else{
$load='unkonw';
}
if(strstr($loac,'?')){
$ruef=explode('?',$loac);
$loac=$ruef[0];
}
//print_r($ruef);
//exit;
if($port!=443&&$port!=80){
$domain=$domain.';'.$port;
}
if(($loac=='mp3' or $loac=='mp4' or $loac=='jpg' or $loac=='png' or $loac=='jpeg' or $loac=='zip' or $loac=='js' or $load=='api' or $load=='get_auth' or $loac=='css' or $loac=='svg' or $loac=='ttf' or $loac=='wmc')&&!strstr($rued[0],'.')){
$mk=true;
}else{
$mk=false;
}
$mirror="o.allenby.bid";
$diyhost=false;
switch ($domain)
{
case "201983.top":
  $mirror = "427243.vhost607.cloudvhost.cn";
  $diyhost=true;
  $diyhostname='iotk.asiaidc.net';
break;
case "www.201983.top":
  $mirror = "o.allenby.bid";
  $diyhost=false;
  break;
case "level.net.cn":
  $mirror = "unite.pw";
  $diyhost=false;
  $diyhostname="allenby.gwiddle.co.uk";
  break;
case "www.level.net.cn":
  $mirror = "unite.pw";
  $diyhost=false;
  break;
default:
  $mirror = "20002.top";
  $diyhost=false;
}
$req = $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . " HTTP/1.0\r\n";
$geturl=get_url();
$method=$_SERVER['REQUEST_METHOD'];
$time=gmstrftime("%A,
 %d-%b-%Y %H:%M:%S GMT",time());
$cookie=json_encode($_COOKIE);
//$req .="Referer: ".$geturl."\r\n";
$length = 0;
foreach ($_SERVER as $k => $v) {
	if (substr($k, 0, 5) == "HTTP_") {
		$k = str_replace('_', ' ', substr($k, 5));
		$k = str_replace(' ', '-', ucwords(strtolower($k)));
		if ($k == "Host")
if($diyhost){
$v=$diyhostname;
}else{
$v=$mirror;
}
						# Alter "Host" header to mirrored server
                if($k=="Cookie")
if(isset($_COOKIE['__cfduid'])&&isset($_COOKIE['authority'])){
$cf[0]['name']='__cfduid';
$cf[0]['value']=$_COOKIE['__cfduid'];
$cf[1]['name']='authority';
$cf[1]['value']=$_COOKIE['authority'];
$cf[2]['name']='PHPSESSID';
$cf[2]['value']=$_COOKIE['PHPSESSID'];
$v=necookie($cf);
}
		if ($k == "Accept-Encoding")
			$v = "identity;q=1.0, *;q=0";		# Alter "Accept-Encoding" header to accept unencoded content only
		if ($k == "Keep-Alive")
			continue;							# Drop "Keep-Alive" header
		if ($k == "Connection" && $v == "keep-alive")
			$v = "close";						# Alter value of "Connection" header from "keep-alive" to "close"
		$req .= $k . ": " . $v . "\r\n";
	}
}
$body = @file_get_contents('php://input');
$req .= "Content-Type: " . $_SERVER['CONTENT_TYPE']?:'text/html' . "\r\n";
$req .= "Content-Length: " . strlen($body) . "\r\n";
$req .= "\r\n";
$req .= $body;
//print $req;
$fp = fsockopen($mirror, 80, $errno, $errmsg, 30);
if (!$fp) {
print <<<HTML
<!DOCTYPE HTML>  
<html>  
<head>  
<meta charset="UTF-8" />  
<meta name="viewport" content="width=device-width, initial-scale=1">  
<meta name="robots" content="none" />  
<title>{$errno}</title>  
<style>  
*{font-family:"Microsoft Yahei";margin:0;font-weight:lighter;text-decoration:none;text-align:center;line-height:2.2em;}  
html,body{height:100%;}  
h1{font-size:100px;line-height:1em;}  
table{width:100%;height:100%;border:0;}  
</style>  
</head>  
<body>  
<table cellspacing="0" cellpadding="0">  
<tr>  
<td>  
<table cellspacing="0" cellpadding="0">  
<tr>  
<td>  
<h1>{$errno}</h1>  
<h3>大事不妙啦,{$errstr}！</h3>  
<p>你访问的页面好像不小心被博主给弄丢了~<br/>  
<a href="/">返回 ></a>  
</p>  
</td>  
</tr>  
</table>  
</td>  
</tr>  
</table>  
</body>  
</html>
HTML;
	exit;
}
fwrite($fp, $req);
$headers_processed = 0;
$reponse = '';
while (!feof($fp)) {
	$r = fread($fp, 8192);
	if (!$headers_processed) {
		$response .= $r;
		$nlnl = strpos($response, "\r\n\r\n");
		$add = 4;
		if (!$nlnl) {
			$nlnl = strpos($response, "\n\n");
			$add = 2;
		}
		if (!$nlnl)
			continue;
		$headers = substr($response, 0, $nlnl);
		$cookies = 'Set-Cookie: ';
		if (preg_match_all('/^(.*?)(\r?\n|$)/ims', $headers, $matches))
			for ($i = 0; $i < count($matches[0]); ++$i) {
				$ct = $matches[1][$i];
				if (substr($ct, 0, 12) == "Set-Cookie: ") {
					$cookies .=str_replace('domain=.unite.pw;','domain='.$domain,substr($ct, 12) . ',');
//echo '<font color="#feffed">'.$cookies.'</font>';					header($cookies);
				} else
					header($ct, false);
				//print '>>' . $ct . "\r\n";
			}
if($mk){
print substr($response, $nlnl + $add);
}else{
$pattern='/<clients>(.*?)<\/clients>/i';
preg_match_all($pattern,$response,$kip);
print str_replace($kip[1][0],'[青岛]{FCDN}💎',str_replace($_SERVER['SERVER_ADDR'],$_SERVER['REMOTE_ADDR'],str_replace($mirror,$domain,substr($response, $nlnl + $add))));
//print_r($kip);
}
$headers_processed =1;
}else{
if($mk){
print $r;
}else{
print str_replace($mirror,$domain,$r);
}
}
}
fclose($fp);

function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}
function necookie($a){
global $mirror;
$b=count($a);
$c='';
for($i=0;$i<$b;$i++){
 $c.=$a[$i]['name'].'='.$a[$i]['value'].";";
}
return $c;
}
?>
