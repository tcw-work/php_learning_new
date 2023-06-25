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

// $apiKey = "ad889080055d9e27bb1d349144e8deb"; // あなたのAPIキーに置き換えてください
// $isbn = "9784834021759"; // 検索する書籍のISBNに置き換えてください
// $apiUrl = "https://api.calil.jp/check?appkey={$apiKey}&isbn={$isbn}&callback=no";

// $curl = curl_init();

// curl_setopt_array($curl, array(
//     CURLOPT_URL => $apiUrl,
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_TIMEOUT => 30,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "GET",
//     CURLOPT_HTTPHEADER => array(
//         "cache-control: no-cache"
//     ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     $responseArray = json_decode($response, true);

//     // 必要な情報を取得
//     // 以下は一例です、レスポンスに含まれるデータによって異なります
//     $bookTitle = $responseArray['books'][$isbn]['title'];
//     $bookAuthor = $responseArray['books'][$isbn]['author'];

//     echo "Title: {$bookTitle}<br>";
//     echo "Author: {$bookAuthor}<br>";
// }

?>