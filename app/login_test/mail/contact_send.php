<?php

$c_name = htmlspecialchars($_POST['c_name']);
$c_mail = "tomizawa@t-creative-works.com";//受け取りてのアドレス
$from_mail = htmlspecialchars($_POST['c_mail']);//インスタンス作成時に__constructに入れる引数（送りてのアドレス）
$c_content = htmlspecialchars($_POST['c_content']);
$mailTrue_message = "contactSend";


//クラスをインスタンスして操作
require_once 'mail.php';//メール送信に関する関数を格納しているmail.phpを呼びだし
$mailSender = new MailSender($from_mail);//mail.phpの内容はクラスで作られているので、インスタンス化
$mailSender->setContent($c_content);//メソッドへアクセス（文言代入）
$mailSender->subject = "お問い合わせ";//プロパティへ（件名代入）
$mailSender->send($c_name, $c_mail, $mailTrue_message);//メソッドへアクセス（引数をセットして関数実行）
    ?>