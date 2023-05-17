<?php
// 言語とエンコードをセット（お作法として覚えておく）
mb_language("Japanese");//日本語の文字列処理やエンコードが必要な場合には、mb_language("Japanese")を設定しておく
mb_internal_encoding("UTF-8");//文字エンコーディング
//送信者を宛名をセット
$from = "tomizawa@efit.co.jp"; //送信元
$to = "jbjbjb7712@gmail.com"; //充て先
//メールヘッダー作成
$encodedFrom = mb_encode_mimeheader($from);//念のため送信元をエンコードしておく（特殊な文字列が使われなければ不要）
$header = "From: $encodedFrom\n";
$header .= "Replay-to: $encodedFrom";
//件名や本文をチェック
$subject = "メールのテスト";
$body = "こんにちはメールの本文（テスト）です。";
//日本語メール送信
$r = mb_send_mail($to, $subject, $body, $header);
//mb_send_mail(宛先, 件名, 本文, 追加ヘッダー); 追加ヘッダーには送信者（from）や返信先（to）が入っている
if ($r) {//もしmb_send_mail関数が実行して成功（true）したら
    echo "メール送信成功";
} else {
    echo "メール送信失敗";
}
?>

<p>Xamppでメール送信するにはphp.iniを修正する必要がある</p>

①「C:/xampp/php/php.ini」のファイルに行く（メール送信の設定）
②「;sendmail_path = 」の部分を「sendmail_path = "/"C:/xampp/sendmail/sendmail.exe/" -t"」に変更
④「C:/xampp/sendmail/sendmail.ini」のファイルに行く（送信元のアイパスなどを入力）
④appachを再起動