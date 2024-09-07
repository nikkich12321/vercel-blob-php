<?php
$get_post_data='request=%7B%22connectionType%22%3A%22ftp%22%2C%22configuration%22%3A%7B%22password%22%3A%22SxJJc5FUsK%22%2C%22initialDirectory%22%3A%22%2F%22%2C%22host%22%3A%22185.27.134.11%22%2C%22username%22%3A%22if0_37036530%22%2C%22port%22%3A21%7D%2C%22actionName%22%3A%22getFileContents%22%2C%22context%22%3A%7B%22remotePath%22%3A%22%2Fhtdocs%2Ftest.json%22%7D%7D';
function get_data($post_data){
$ch = curl_init();
    $headers = array(
    'accept:application/json, text/plain, */*',
'accept-encoding:gzip',
'accept-language:en-US,en;q=0.9,en-IN;q=0.8,hi;q=0.7',
'content-length:'.strlen($post_data),
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
    $body = $post_data;

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $json=curl_exec($ch);
	$dump=json_decode($json,true);
	#$dump["data"]=base64_decode($dump["data"]);
	#$dump=json_encode($dump,true);
	return base64_decode($dump["data"]);}
	
	function refresh_jio_token($getCRED)
{
  $JIO_AUTH = json_decode($getCRED, true);

  if (!empty($JIO_AUTH)) {
    $ref_TokenApi = "https://auth.media.jio.com/tokenservice/apis/v1/refreshtoken?langId=6";
    $ref_TokenPost = '{"appName":"RJIL_JioTV","deviceId":"' . $JIO_AUTH['deviceId'] . '","refreshToken":"' . $JIO_AUTH['refreshToken'] . '"}';
    $ref_TokenHeads = array(
      "accesstoken: " . $JIO_AUTH['authToken'],
      "uniqueId: " . $JIO_AUTH['sessionAttributes']['user']['unique'],
      "devicetype: phone",
      "versionCode: 331",
      "os: android",
      "Content-Type: application/json"
    );

    $process = curl_init($ref_TokenApi);
    curl_setopt($process, CURLOPT_POST, 1);
    curl_setopt($process, CURLOPT_POSTFIELDS, $ref_TokenPost);
    curl_setopt($process, CURLOPT_HTTPHEADER, $ref_TokenHeads);
    curl_setopt($process, CURLOPT_HEADER, 0);
    curl_setopt($process, CURLOPT_TIMEOUT, 20);
    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
	$refdata=curl_exec($process);
    curl_close($process);
	$ini_cred_data=json_encode($JIO_AUTH,true);
	if (strpos( $refdata, "authToken") !== false){
		$data=json_decode($refdata,true);
		$JIO_AUTH['authToken']=$data['authToken'];
		$final_cred_data=json_encode($JIO_AUTH,true);
  }else{$final_cred_data=json_encode($JIO_AUTH,true);}}
  
return update_data_on_remote($ini_cred_data,$final_cred_data);}
function update_data_on_remote($initial_data,$final_data){
	$initial_data_encoded=base64_encode($initial_data);
	$final_data_encoded=base64_encode($final_data);
	$data_for_post='request=%7B%22connectionType%22%3A%22ftp%22%2C%22configuration%22%3A%7B%22password%22%3A%22SxJJc5FUsK%22%2C%22initialDirectory%22%3A%22%2F%22%2C%22host%22%3A%22185.27.134.11%22%2C%22username%22%3A%22if0_37036530%22%2C%22port%22%3A21%7D%2C%22actionName%22%3A%22putFileContents%22%2C%22context%22%3A%7B%22remotePath%22%3A%22%2Fhtdocs%2Ftest.json%22%2C%22fileContents%22%3A%22'.$final_data_encoded.'%22%2C%22originalFileContents%22%3A%22'.$initial_data_encoded.'%22%2C%22confirmOverwrite%22%3Afalse%7D%7D';
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
return 'refreshed';}
	echo refresh_jio_token(get_data($get_post_data));
	
	
?>