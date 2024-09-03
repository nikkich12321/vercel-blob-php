<?php
$id=$_REQUEST['id'];
$ch = curl_init();
    $headers = array(
'user-agent: '.base64_encode(time()),
    );
    curl_setopt($ch, CURLOPT_URL, 'http://livetvbox.live:8080/live/shoaib/shoaib/'.$id.'.m3u8');
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
	$dump=base64_encode($redirectedUrl);
	header('Location: https://vercel-blob-php-sigma.vercel.app/api/master.php?id='.$id.'&data='.$dump);
	exit;

?>