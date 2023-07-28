<?php
$clientId = '2000242047';
$clientSecret = 'e0e0badf1da21d3553c8cb081f184c01';
$callback = 'http://192.168.11.6/coding/local_coding/php_learning/app/login_test/api/line/callback.php';

if(isset($_GET['code'])) {
    $code = $_GET['code'];

    $url = 'https://api.line.me/oauth2/v2.1/token';

    $params = [
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $callback,
        'client_id' => $clientId,
        'client_secret' => $clientSecret
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($params)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    $tokenInfo = json_decode($response, true);

    if(isset($tokenInfo['access_token'])) {
        $accessToken = $tokenInfo['access_token'];

        $userInfoUrl = 'https://api.line.me/v2/profile';
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => 'Authorization: Bearer ' . $accessToken
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($userInfoUrl, false, $context);
        $userInfo = json_decode($response, true);

        print_r($userInfo);
    }
}
?>