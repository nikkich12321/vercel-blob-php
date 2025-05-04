<?php
$uri_path=$_SERVER['REQUEST_URI'];
	$needle="manifest.m3u8";
	$master_check="master.m3u8";
	if( strpos( $uri_path, $needle) !== false) {
	$idd=str_replace('/api/','',$uri_path);
	$dump=explode('/manifest.m3u8',$idd);
	$id=$dump[0];
	header('cache-control: no-cache, no-store, must-revalidate');
	header('Location: '. manifest($id), true, 301);
	exit;
	}elseif( strpos( $uri_path, $master_check) !== false){
	$master_data=master($uri_path);
	header('access-control-allow-origin: *');
	header('content-type: application/x-mpegurl');
	header('cache-control: no-store, no-cache, must-revalidate');
	header('content-length: '.strlen($master_data));
	echo $master_data;
	}else {echo 'Forbidden';}
function manifest($ch_id){
	$ch = curl_init();
    $headers = array(
	'user-agent: Lavf53.32.100',
	'accept-encoding: identity',
	'Icy-MetaData: 1'
    );
    curl_setopt($ch, CURLOPT_URL, get_url($ch_id));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
#	curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    $body = '';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $json=curl_exec($ch);
	$redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
	#echo $redirectedUrl;
	$dump=bin2hex($redirectedUrl);
	$master_url='https://vercel-blob-php-sigma.vercel.app/api/'.$ch_id.'/'.$dump.'/master.m3u8';
	return $master_url;
}
function master($base_url){
	$idd=str_replace('/api/','',$base_url);
	$dump=explode('/',$idd);
	$id=$dump[0];
	$data=$dump[1];
	$url=hex2bin($data);
	#echo $url;
	$url_dump=explode('/live/',$url);
	$url_base=$url_dump[0];
	#echo $url_base;
	$ch = curl_init();
    $headers = array(
	'user-agent: '.base64_encode(time()),
    );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
	#curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    $body = '';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $json=curl_exec($ch);
	$dump=str_replace('/hls',$url_base.'/hls',$json);
	#$dump_final=str_replace('.ts','.ts|User-Agent='.$useragent,$dump);
	return $dump;
}

function get_url($ch_id){
	$id="http://livetvbox.live:8080/portal.php?type=itv&action=create_link&cmd=ffmpeg%20http%3A%2F%2Flocalhost%2Fch%2F".$ch_id."_&force_ch_link_check=0";
	$ch = curl_init();
	$auth_ini = get_auth();
    $headers = array(
    'User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3',
	'Cookie: mac=00:1a:79:6d:94:ce; timezone=Asia/Kolkata; adid=20fed6762d43542899eb39b4051526af',
	'X-User-Agent: Model: MAG270; Link: WiFi',
	'Authorization: Bearer '.$auth_ini
    );
    curl_setopt($ch, CURLOPT_URL, $id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	#curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	
    $authToken = curl_exec($ch);
	if( strpos( $authToken, "cmd") !== false) {
	$authToken = json_decode($authToken,TRUE);
	$url = $authToken["js"]["cmd"];
	$url = str_replace('.ts','.m3u8',$url);
	$url = str_replace('ffmpeg ','',$url);
	#$authToken = str_replace("\/","/",$authToken);
	return $url;
	}else{
	return get_and_refresh_auth($auth_ini,$ch_id);
	
	}
	
	
}
function get_auth(){
	$get_post_data='request=%7B%22connectionType%22%3A%22ftp%22%2C%22configuration%22%3A%7B%22host%22%3Anull%2C%22username%22%3A%22if0_38884780%22%2C%22password%22%3A%220g3R5mgtR93h%22%2C%22initialDirectory%22%3A%22%2F%22%2C%22passive%22%3Anull%2C%22port%22%3A21%2C%22ssl%22%3Anull%7D%2C%22actionName%22%3A%22getFileContents%22%2C%22context%22%3A%7B%22remotePath%22%3A%22%2Fhtdocs%2Fauth%22%7D%7D';
$ch = curl_init();
    $headers = array(
    'accept:application/json, text/plain, */*',
'accept-encoding:gzip',
'accept-language:en-US,en;q=0.9,en-IN;q=0.8,hi;q=0.7',
'content-length:'.strlen($get_post_data),
'content-type:application/x-www-form-urlencoded',
#'cookie:PHPSESSID=951f1eafd99bbc4a6590fc14c71d8dd7',
'origin:https://filemanager.ai',
'priority:u=1, i',
'referer:https://filemanager.ai/new/',
'sec-ch-ua:"Chromium";v="128", "Not;A=Brand";v="24", "Microsoft Edge";v="128"',
'sec-ch-ua-mobile:?0',
'sec-ch-ua-platform:"Windows"',
'user-agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0'
    );
    curl_setopt($ch, CURLOPT_URL, 'https://filemanager.ai/new/application/api/api.php');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    $body = $get_post_data;

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $json=curl_exec($ch);
	#return $json;
	$dump=json_decode($json,true);
	$dump=base64_decode($dump["data"]);
	#$dump=json_encode($dump,true);
	#$data=json_decode(base64_decode($dump["data"]),true);
	return $dump;
}
function get_and_refresh_auth($ini_auth,$chh_id){
	$id="http://livetvbox.live:8080/portal.php?type=stb&action=handshake&token=&prehash=13f0848280789b506aeb024ec95eb65cc07b6ce7";
$ch = curl_init();
    $headers = array(
    'User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3',
	'Cookie: mac=00:1a:79:6d:94:ce; timezone=Asia/Kolkata; adid=20fed6762d43542899eb39b4051526af',
	'X-User-Agent: Model: MAG270; Link: WiFi'
    );
    curl_setopt($ch, CURLOPT_URL, $id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $authToken = curl_exec($ch);
	$authToken = json_decode($authToken,TRUE);
	$auth_final = $authToken["js"]["token"];
	$verify = auth_verify($auth_final);
	$update_auth = update_data_on_remote($ini_auth,$auth_final);
	$get_url_2 = get_url_2($auth_final,$chh_id);
	return $get_url_2;
}
function auth_verify($data){
	$id="http://livetvbox.live:8080/portal.php?type=stb&action=get_profile&sn=008757N941477&auth_second_step=1";
	$ch = curl_init();
    $headers = array(
    #'user-agent: TiviMate/5.0.4 (Android 10)',
    'User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3',
	'Cookie: mac=00:1a:79:6d:94:ce; timezone=Asia/Kolkata; adid=20fed6762d43542899eb39b4051526af',
	'X-User-Agent: Model: MAG270; Link: WiFi',
	'Authorization: Bearer '.$data
    );
    curl_setopt($ch, CURLOPT_URL, $id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	#curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $authToken = curl_exec($ch);
	return;
}
function update_data_on_remote($initial_data,$final_data){
	$initial_data_encoded=base64_encode($initial_data);
	$final_data_encoded=base64_encode($final_data);
	$data_for_post='request=%7B%22connectionType%22%3A%22ftp%22%2C%22configuration%22%3A%7B%22host%22%3Anull%2C%22username%22%3A%22if0_38884780%22%2C%22password%22%3A%220g3R5mgtR93h%22%2C%22initialDirectory%22%3A%22%2F%22%2C%22passive%22%3Anull%2C%22port%22%3A21%2C%22ssl%22%3Anull%7D%2C%22actionName%22%3A%22putFileContents%22%2C%22context%22%3A%7B%22remotePath%22%3A%22%2Fhtdocs%2Fauth%22%2C%22fileContents%22%3A%22'.$final_data_encoded.'%22%2C%22originalFileContents%22%3A%22'.$initial_data_encoded.'%22%2C%22confirmOverwrite%22%3Afalse%7D%7D';
	$ch = curl_init();
    $headers = array(
    'accept:application/json, text/plain, */*',
'accept-encoding:gzip',
'accept-language:en-US,en;q=0.9,en-IN;q=0.8,hi;q=0.7',
'content-length:'.strlen($data_for_post),
'content-type:application/x-www-form-urlencoded',
#'cookie:PHPSESSID=951f1eafd99bbc4a6590fc14c71d8dd7',
'origin:https://filemanager.ai',
'priority:u=1, i',
'referer:https://filemanager.ai/new/',
'sec-ch-ua:"Chromium";v="128", "Not;A=Brand";v="24", "Microsoft Edge";v="128"',
'sec-ch-ua-mobile:?0',
'sec-ch-ua-platform:"Windows"',
'user-agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0'
    );
    curl_setopt($ch, CURLOPT_URL, 'https://filemanager.ai/new/application/api/api.php');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    $body = $data_for_post;
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $json=curl_exec($ch);
$auth=json_decode($final_data,true);
return $auth;}
function get_url_2($auth,$ch_id){
	$id="http://livetvbox.live:8080/portal.php?type=itv&action=create_link&cmd=ffmpeg%20http%3A%2F%2Flocalhost%2Fch%2F".$ch_id."_&force_ch_link_check=0";
	$ch = curl_init();
    $headers = array(
    'User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3',
	'Cookie: mac=00:1a:79:6d:94:ce; timezone=Asia/Kolkata; adid=20fed6762d43542899eb39b4051526af',
	'X-User-Agent: Model: MAG270; Link: WiFi',
	'Authorization: Bearer '.$auth
    );
    curl_setopt($ch, CURLOPT_URL, $id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	#curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	
    $authToken = curl_exec($ch);
	$authToken = json_decode($authToken,TRUE);
	$url = $authToken["js"]["cmd"];
	$url = str_replace('.ts','.m3u8',$url);
	$url = str_replace('ffmpeg ','',$url);
	return $url;
}