<?php
$clientId = '2000242047';
$clientSecret = 'e0e0badf1da21d3553c8cb081f184c01';
$callback = 'http://192.168.11.6/coding/local_coding/php_learning/app/login_test/api/line/callback.php';

$authUrl = 'https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=' . $clientId . '&redirect_uri=' . $callback . '&state=testState&scope=profile';

header('Location: ' . $authUrl);
exit;
?>