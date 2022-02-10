
<?php
phpinfo();

//접속 할 URL을 지정
$url = "https://www.google.com/";

//cURL 세션 초기화
$ch = curl_init();

//URL과 옵션을 설정
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//cURL 실행
$res = curl_exec($ch);

//결과 표시
var_dump($res);

//세션을 종료
curl_close($conn);



?>