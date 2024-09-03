<?php

function refresh_jio_token()
{
		$getCRED = '{"authToken":"eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImF1dGhUb2tlbklkIjoiNzdlMWRkOGQtMTgxOC00ZDMwLTk3ZjYtN2YyODIzYjJkYzU3IiwidXNlcklkIjoiNDkyZTQ5YWYtZDk0Yi00ZTEwLTkzMDMtMzhlNmUyYmQwODRiIiwidXNlclR5cGUiOiJKSU8iLCJvcyI6ImFuZHJvaWQiLCJkZXZpY2VUeXBlIjoicGhvbmUiLCJhY2Nlc3NMZXZlbCI6IjkiLCJkZXZpY2VJZCI6Ijg2MTUwYTNkMzJiMTc3OWQiLCJleHRyYSI6IntcIm51bWJlclwiOlwiOVBsSVdiQ1ZEUnBkcGxCd3h5d1RqRUI4SmJVakErWjJYUG1JekUwcHlxNU1kRGUxNlpSZ2gzYz1cIixcInBsYW5kZXRhaWxzXCI6e1wiUGFja2FnZUluZm9cIjpbe1wicGxhbmlkXCI6XCIxXCIsXCJzdWJzY3JpcHRpb25zdGFydFwiOjE2NjY0MDE4NDAsXCJzdWJzY3JpcHRpb25lbmRcIjoxNzU2NDg0OTEwLFwicGxhbnR5cGVcIjpcInByZW1pdW1cIixcImJ1c2luZXNzVHlwZVwiOlwiamlvXCIsXCJub3Rlc1wiOlwiXCJ9XX0sXCJqVG9rZW5cIjpcIjk2YjhhMWVkNWEyZWQ0ZTliM2ViZjZmOTFiYTQ3NzhiLjI2YjkwN2ViOGM1NzQyMTYzMGM0MDEzOGM5NDMyMjVkODI2ZWYwZjJlN2JiN2M4YjYxMjQ4YWE2NGE4NmIyM2ZmN2I3N2ZlNGM5Nzg3MWQwYTRhMTNhOWQ4YzFmMWM1MjRmN2UxYWY0ZDQwMjUwNjc1NDY2Y2RlMThkZDQzMmNkMjdjYjFjZGIzNDNkOWVjYjBmOGI2MzQ5NGVmOWZmMjE2OThkMzRmMDliMzgyOWMxM2ViNWJjYzUxMmMzN2YzNDVhNzFiNTViOTlkM2YxN2Q3N2MwNGY4Nzk0ZjYyYmY4NWRkNWQ4MWJhNGZlZWUxMmZjYzNmM2EwMzBlZDI5ZTA1MzkzOWJiZjlhYjViOWY2Zjk4OTI1NjIzN2YzN2MxZjhiNjBiNTRmMDViYTFlYTE1Y2I5OWU5NTVkMDg1YTBjMTAwZGFjZGIxMmQyZmMxMTcxYTliN2Y1YmRkYTZhNzYxMTI1MzFjNmJlOWI2NmNhZjU5OTcyZTkxYjE5OTE1NDJkMDlkZGVkZWZjNGM2NTQwYjc1MzFhNTFmNGRkMjNhZGJmMGM5NGE2ZmU4NmNjOWNlOWRlMjFjMTcxMmIyZjlmNjQ3YzUzYzQ4M2QyZmNiM2E1NzUzNWM4Y2UzNmNlMzMwMTJiZGU0ZTBiMTJkYWVlZTczOGFjZTA1ZDgxOWYyYzA0ZDc1MDhmMzE2NjQxMTg1ZmExYzM5NGEzZTkyZGVjYjgzOTFjMWZiYmE4ZDgzY2Q1NWY3NmE1MDZmMzdhYTZmNjZhYTljMGFkNjk4NGI5YTI1NDNkZTNjMWFlYWFiMDBkNjE1ZTliYThlMzY0Njg1NmFjYjUwZGI1Nzc0NTE1MWQ5NTc3MzVjZmM0NWJmZmZlN2YzYjgwODc2NGY0MTA2ZTlhMGQ4NjZlZjhiMWRhNDNhNmZkOTUzYWEyMzdhXCIsXCJ1c2VyRGV0YWlsc1wiOlwiY2JZdmRFWWRjWk5xMllIc0ovSnNxNmNoSnc1S1Jwdm91K09tYXhQS2xUMyt3Z0FORUVnekxER3c1THYvbnc0SE5ZaEJVc2E2NmZYQW1UTUJjcFd0THpkT1VEOHEwTUFQWmpweHhtN2FxcWpWVnRKcDdvaldKQ0xGME9IOWFrQUxYQjJ0N1p5Y2Q0VlY1eG9ienlzRVM4dGJmOWIweE1FNDZBZ3N6K0E0d1V0WmREVjUxSWNkMXRIa29MU3NNRVVoN2FkKzFHNzN2Y3Vja1FxTzM2NzVoODI1dVUrZUN3NGdHZ0xkRitQd2FGaFNFb1NseDQ0SERwdHNoZnhyOUFmY045L3p3T0Z3NkZhNE14QTZ3L2lYM3BOczJjbG9WRTlXdnhtMWZMbTZCMEpmXCJ9Iiwic3Vic2NyaWJlcklkIjoiNzIyMTY4MjExOSIsImFwcE5hbWUiOiJSSklMX0ppb1RWIiwidmVyc2lvbiI6InYxIn0sImV4cCI6MTcyNTU1MzcxMCwiaWF0IjoxNzI0OTQ4OTEwfQ.z2tFeeouQUycPv1MO-Pfk8zH2ESpB9psQyard0wW4W6dZ5NvLRUP0eX-1Xu7PQqxjz4hIOgSVSsNuwwD6WpaRw","refreshToken":"2667e47e-2836-4f7d-a418-97ce7a047b91","ssoToken":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjcmVhdGVkRm9yIjoiSmlvVFYiLCJkZXZpY2VJZCI6Ijg2MTUwYTNkMzJiMTc3OWQiLCJpYXQiOjE3MjQ5NDg5MTAsInNJZCI6IlUyRnNkR1ZrWDErMVMwWGxPUDI5UlYwTzU0Wk1qS0ZGVC9QdVhEenhsRHM9IiwidW5pcXVlIjoiNDkyZTQ5YWYtZDk0Yi00ZTEwLTkzMDMtMzhlNmUyYmQwODRiIiwidXNlclR5cGUiOiJKSU8ifQ.BZPogJlKOS7yKL8tiWszycWQADHcSdBnRX2sbeJZ5kg","sessionAttributes":{"user":{"commonName":"ainish chauhan","mobile":"+918010506419","preferredLocale":"en-US","ssoLevel":"20","subscriberId":"7221682119","uid":"ainish.chauhan","unique":"492e49af-d94b-4e10-9303-38e6e2bd084b"}},"jToken":"96b8a1ed5a2ed4e9b3ebf6f91ba4778b.26b907eb8c57421630c40138c943225d826ef0f2e7bb7c8b61248aa64a86b23ff7b77fe4c97871d0a4a13a9d8c1f1c524f7e1af4d40250675466cde18dd432cd27cb1cdb343d9ecb0f8b63494ef9ff21698d34f09b3829c13eb5bcc512c37f345a71b55b99d3f17d77c04f8794f62bf85dd5d81ba4feee12fcc3f3a030ed29e053939bbf9ab5b9f6f989256237f37c1f8b60b54f05ba1ea15cb99e955d085a0c100dacdb12d2fc1171a9b7f5bdda6a76112531c6be9b66caf59972e91b1991542d09ddedefc4c6540b7531a51f4dd23adbf0c94a6fe86cc9ce9de21c1712b2f9f647c53c483d2fcb3a57535c8ce36ce33012bde4e0b12daeee738ace05d819f2c04d7508f316641185fa1c394a3e92decb8391c1fbba8d83cd55f76a506f37aa6f66aa9c0ad6984b9a2543de3c1aeaab00d615e9ba8e3646856acb50db57745151d957735cfc45bfffe7f3b808764f4106e9a0d866ef8b1da43a6fd953aa237a","ssoLevel":"20","lbCookie":"1","newUser":false,"ip":"1dbaa1322b90bb2fe668e27d51aeeba7","deviceId":"86150a3d32b1779d","analyticsId":"492e49af-d94b-4e10-9303-38e6e2bd084b","profileId":"","name":""}';
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
    curl_setopt($process, CURLOPT_TIMEOUT, 10);
    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
	$refdata=curl_exec($process);
    $ref_data = json_decode($refdata, true);
    curl_close($process);
	echo $refdata;
    $resp = [
      'status' => 'error',
      'message' => '',
      'authToken' => ''
    ];

    if (isset($ref_data['message']) && !empty($ref_data['message'])) {
      $resp["message"] = "JioTV [OTP Login] - AuthToken Refresh Failed";
    }

    if (isset($ref_data['authToken']) && !empty($ref_data['authToken'])) {
      $resp["status"] = "success";
      $resp["message"] = "JioTV [OTP Login] - AuthToken Refreshed Successfully";
      $resp["authToken"] = $ref_data['authToken'];
    }
  }

  return $refdata;
}

echo refresh_jio_token();