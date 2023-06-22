<?php

$api_key = 'ad889080055d9e27bb1d349144e8debe';  // あなたのアプリケーションキー
$isbn = '9784834021756';  // 検索したいISBN番号（ハイフン無し）

// APIリクエストURLの生成
$url = "https://api.calil.jp/check?appkey={$api_key}&isbn={$isbn}&callback=no";

// cURLを使用してAPIにリクエストを送信
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// APIからのレスポンスをデコード
$response_data = json_decode($response, true);

// ISBNがレスポンスに存在するか確認
if (isset($response_data['books'][$isbn])) {
    // 必要な情報を出力（例えば、都道府県名と図書館名）
    foreach($response_data['books'][$isbn] as $systemid => $systeminfo) {
        echo "SystemID: {$systemid}<br>";
        foreach($systeminfo['libkey'] as $libname => $status) {
            echo "Library: {$libname} Status: {$status}<br>";
        }
    }
} else {
    echo "No data found for ISBN: {$isbn}<br>";
}

?>