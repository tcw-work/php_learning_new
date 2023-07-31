<?php
//"registration_ids"はFirebase Cloud Messaging (FCM) のAPIにおいて、通知を送信するデバイスのトークンを指定するための配列（FCMによって予め用意されている）。
//1つのリクエストで最大で500個のデバイストークンを指定することが可能
// $json = '{
//     "registration_ids": [
//         "crA2scdnANsrHkgOeK7LZx:APA91bEbz07H79p4tJ-XbmZN8d3HSppEsyybJZdJrrevwudagLn1ilzRIvv3CGd52K5fqOXsGjk-ZV0GnYVYidtpAf0QBIrnB6HlZqX8PwVDgnyu9gBxy2fb7rAdmBdstvNIpfeasubp",
//                 "cN6jzNvbveVenmY6kdOg2L:APA91bHZQYaxUGCXHUt2z4yY4CA282sRZYsc3Ha_tChrA7v-5SW7F-MXSNrZHNyMkEEe5CWySwe4IL_pfAWykT6pzum3-DRiWh0mgKRTGf3ykmyTkqb5e_b8kpQEITsz7Owb77DxQfUe",
//     ],
//         "notification":
//         {
//             "title": "TCWプッシュ通知テスト送信",
//             "body": "TCW 送信テストですの本文です",
//              "click_action":"/"
//         },

//     }';

// $ch = curl_init();//PHPのライブラリのcURLを使ってAPIリクエスト（新しいcURLセッショ）を初期化して開始

// $headers = array(
//     'Content-Type: application/json',
//     'Authorization: key=AAAAjiugIag:APA91bE1zbizmImQbn6ZlKl03EecHgPY2CVekWy5CDqofPRV-wQ0pvtGAdBZ1gKlbiNNwgRsqq6dixGSArZjD79QceVTwRe1gp1am6v92PhnrHYj_rGBYCbd0bd4pD2ZehgnSTmEP7jA'
//     //Authorization（サーバーキー）はFirebase Cloud Messagingへのリクエストを認証するために必要（FCMの管理ページ参照）
// );

// curl_setopt_array($ch, array(//URL、HTTPヘッダー（'Content-Type'と'Authorization'）、POSTデータ（$json）はFirebaseのAPI仕様に従って設定する必要がある
//     CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',//cURLで要求するURLを指定’（Firebase Cloud MessagingのAPIエンドポイント）
//     CURLOPT_HTTPHEADER => $headers,//求に含めるHTTPヘッダーにContent-TypeとAuthorization（Firebaseプロジェクトのサーバーキーを含む認証情報）を指定
//     CURLOPT_SSL_VERIFYPEER => true,//cURLがSSL証明書の検証を行うかどうかを決定
//     CURLOPT_POST => true,//HTTP POSTメソッドを使ってデータを送信
//     CURLOPT_RETURNTRANSFER => true,//cURL実行時にデータを直接出力するのではなく、文字列として返すように指示
//     CURLOPT_POSTFIELDS => $json//HTTP "POST"操作で全てのデータを送信します。ここでは$json変数の中身がPOSTフィールドとして送信
// ));

// $response = curl_exec($ch);//実際にAPIリクエストを実行し、レスポンスを受け取る

// curl_close($ch);//cURLセッションを閉じる

?>





<?php


include 'common/db.php';

// DBのトークン取得
$sql = "SELECT `token` FROM `tokens`";
$tokens = [];

try {
    foreach($db->query($sql) as $row) {
        $tokens[] = $row['token'];//$rowとして全てのトークンデータをループで取得し、$tokens[]配列に格納
    }
} catch (PDOException $e) {//例外時はエラー表示
    http_response_code(422);
    echo "トークン取得に失敗: " . $e->getMessage();
    exit;
}

// 通知データの準備。jsonとして送るデータを$dataとしてPHPスタイルで定義し、それをjson形式にエンコードして送信している
$data = [
    "registration_ids" => $tokens,//registration_idsなどはFCMのAPIで定義されているプロパティ名なので、変更しないように注意
    "notification" => [
        "title" => "テスト環境のプッシュ通知テスト送信",
        "body" => "テスト環境の本文です",
        "click_action" => "/"
    ]
];

$json = json_encode($data);//json形式でFCMのサーバーに送信されることで、登録済みのデバイスにプッシュ通知が可能になる

$ch = curl_init();//PHPのライブラリのcURLを使ってAPIリクエスト（新しいcURLセッショ）を初期化して開始

$headers = array(
    'Content-Type: application/json',
    'Authorization: key=AAAAjiugIag:APA91bE1zbizmImQbn6ZlKl03EecHgPY2CVekWy5CDqofPRV-wQ0pvtGAdBZ1gKlbiNNwgRsqq6dixGSArZjD79QceVTwRe1gp1am6v92PhnrHYj_rGBYCbd0bd4pD2ZehgnSTmEP7jA'
    //Authorization（サーバーキー）はFirebase Cloud Messagingへのリクエストを認証するために必要（FCMの管理ページ参照）
);

curl_setopt_array($ch, array(//URL、HTTPヘッダー（'Content-Type'と'Authorization'）、POSTデータ（$json）はFirebaseのAPI仕様に従って設定する必要がある
    CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',//cURLで要求するURLを指定’（Firebase Cloud MessagingのAPIエンドポイント）
    CURLOPT_HTTPHEADER => $headers,//求に含めるHTTPヘッダーにContent-TypeとAuthorization（Firebaseプロジェクトのサーバーキーを含む認証情報）を指定
    CURLOPT_SSL_VERIFYPEER => true,//cURLがSSL証明書の検証を行うかどうかを決定
    CURLOPT_POST => true,//HTTP POSTメソッドを使ってデータを送信
    CURLOPT_RETURNTRANSFER => true,//cURL実行時にデータを直接出力するのではなく、文字列として返すように指示
    CURLOPT_POSTFIELDS => $json//HTTP "POST"操作で全てのデータを送信。ここでは$json変数の中身がPOSTフィールドとして送信
));

$response = curl_exec($ch);//実際にAPIリクエストを実行し、レスポンスを受け取る

curl_close($ch);//cURLセッションを閉じる

echo $response; // Show response for debugging

?>