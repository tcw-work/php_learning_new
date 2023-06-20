<?php

$c_name = htmlspecialchars($_POST['c_name']);
$c_mail = htmlspecialchars($_POST['c_mail']);
$c_content = "告知メールのテストです";

//クラスをインスタンスして操作
require_once 'mail.php';//メール送信に関する関数を格納しているmail.phpを呼びだし
$mailSender = new MailSender();//mail.phpの内容はクラスで作られているので、インスタンス化
$mailSender->setContent($c_content);//メソッドへアクセス（文言代入）
$mailSender->subject = "お問い合わせ";//プロパティへ（件名代入）
$mailSender->send($c_name, $c_mail);//メソッドへアクセス（引数をセットして関数実行）
    ?>