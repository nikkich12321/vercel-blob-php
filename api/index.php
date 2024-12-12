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
	'user-agent: '.base64_encode(time()),
    );
    curl_setopt($ch, CURLOPT_URL, 'http://livetvbox.live:8080/live/18531853/18531853/'.$ch_id.'.m3u8');
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
	$url_dump=explode('/live/18531853/18531853/'.$id.'.m3u8',$url);
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
