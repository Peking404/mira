<?php
/*echo "Enter Proxy: ";
$proxy = trim(fgets(STDIN));*/


 
function get($url){
  $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	return $result;
}
function random($length){
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function posdata($url, $hd2, $data, $proxy){
  $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	
curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'mira.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'mira.txt');
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $hd2);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
/*if ($status = 200) {
  print "SUCCESS Respon[$status] ";
}*/
	return $result;
}

function getc($url, $hd, $proxy){
  $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'mira.txt');
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $hd);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	return $result;
}

echo "  [>] Proxy List\t: ";
$list = trim(fgets(STDIN));
$file = file_get_contents("$list");
$bom = explode("\n",$file);
for($a=0;$a<count($bom);$a++){
        $duar = explode("\n",$bom[$a]);
        $proxy = $duar[0];
        print "[?] Mencoba Proxy [$proxy]\n";

 $api = get("https://api.namefake.com/indonesian-indonesia/");
  
 $json = json_decode($api, true);
 $useragent = $json['useragent'];
 $ema = $json['username'];
 sleep(1);


$hd = array();
$hd[] = "Host: wowmiracle.net";
$hd[] = "user-agent: $useragent";
$hd[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
$hd[] = "accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";



$phone = "62895".random(8);
$hd2 = array();
$hd2[] = "Host: wowmiracle.net";
$hd2[] = "content-type: application/x-www-form-urlencoded; charset=UTF-8 ";
$hd2[] = "Content-Type: application/json; charset=utf-8";
$hd2[] = "x-requested-with: XMLHttpRequest";
$hd2[] = "user-agent: $useragent";
$hd2[] = "sec-ch-ua-platform: 'Android'";
$hd2[] = "origin: https://wowmiracle.net";
$hd2[] = "sec-fetch-site: same-origin";
$hd2[] = "sec-fetch-mode: cors";
$hd2[] = "sec-fetch-dest: empty";
$hd2[] = "referer: https://wowmiracle.net/index/login/reg/invite_code/275639";
$hd2[] = "accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";


$gas = getc("https://wowmiracle.net/index/login/reg/invite_code/275639", $hd, $proxy);
$data = "username=$ema&phone=$phone&password=akunweb123&invite_code=275639";
$pos = posdata("https://wowmiracle.net/index/login/reg", $hd2, $data, $proxy);

$valid = json_decode($pos, true);
$validj = $valid['msg'];

if($validj){
  echo "Success Register $pos\n";
  unlink("mira.txt");
}else{
  echo "Failed Register\n";
  unlink("mira.txt");
}
}
?>