<?php
//"registration_ids"はFirebase Cloud Messaging (FCM) のAPIにおいて、通知を送信するデバイスのトークンを指定するための配列（FCMによって予め用意されている）。
//1つのリクエストで最大で500個のデバイストークンを指定することが可能
$json = '{
    "registration_ids": [
        "ffglqDJSkqPehnLxJ2SQAz:APA91bHOw0ShfYC700S3SVibnqDD1M9XVc64PluGjFQ6XZR7OYL887kWCowpGl4IMWDpnf7XfDfizMA91HTxkGxmn03336QwojlUBTtqEFUsqOSV_jXbXebwQbFOgFn7r_6-KDTLL-Um",
                "cN6jzNvbveVenmY6kdOg2L:APA91bHZQYaxUGCXHUt2z4yY4CA282sRZYsc3Ha_tChrA7v-5SW7F-MXSNrZHNyMkEEe5CWySwe4IL_pfAWykT6pzum3-DRiWh0mgKRTGf3ykmyTkqb5e_b8kpQEITsz7Owb77DxQfUe",
    ],
        "notification":
        {
            "title": "TCWプッシュ通知テスト送信",
            "body": "TCW 送信テストですの本文です",
             "click_action":"/"
        },

    }';

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
    CURLOPT_POSTFIELDS => $json//HTTP "POST"操作で全てのデータを送信します。ここでは$json変数の中身がPOSTフィールドとして送信
));

$response = curl_exec($ch);//実際にAPIリクエストを実行し、レスポンスを受け取る

curl_close($ch);//cURLセッションを閉じる

?>