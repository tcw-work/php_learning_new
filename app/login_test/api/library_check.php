<?php

$bookTitle = "1週間でPHPの基礎が学べる本";
$apiUrl = "https://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=title%3D%22" . urlencode($bookTitle) . "%22&recordSchema=dcndl_simple";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    die("cURL Error: " . $err);
}

if (!$response) {
    die("Empty response");
}

header("Content-Type: text/plain");//HTTPレスポンスのヘッダーを設定。レスポンスの本文がプレーンテキスト（テキストの形式化されていない単純なテキスト）であることをクライアント（ブラウザ）示す。
echo $response;//レスポンスの本文表示
exit;


?>