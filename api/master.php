<?php
$data=$_REQUEST['data'];
$id=$_REQUEST['id'];
$url=base64_decode($data);
$url_dump=explode('/live/shoaib/shoaib/'.$id.'.m3u8',$url);
$url_base=$url_dump[0];
#echo $url_base;
$ch = curl_init();
    $headers = array(
'user-agent: '.base64_encode(time()),
    );
    curl_setopt($ch, CURLOPT_URL, $url);
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
	$dump=str_replace('/hls',$url_base.'/hls',$json);
	#$dump_final=str_replace('.ts','.ts|User-Agent='.$useragent,$dump);
	echo $dump;

?>