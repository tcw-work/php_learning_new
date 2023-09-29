<?php
//register.phpとcontact.send.phpで使いまわす
class MailSender {
    private $from;//使用する全てのプロパティをクラス定義の冒頭で明示的に定義することが一般的
    private $header;///書かなくても動くが、メソッドを明示的にしておく（推奨）
    private $contentPass;//書かなくても動くが、メソッドを明示的にしておく（推奨）
    public $subject;//件名はプロパティ操作で動的に設定

    //privateはアクセス修飾子
    //$this-> の部分がクラスのプロパティにあたる
    //function()で定義されるものはクラスのメソッド

    public function __construct($from_mail) {//共通項目はコンストラクタで必ず処理されるようにする
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $this->from = mb_encode_mimeheader($from_mail); 
        // $this->header = "From: {$this->from}\nReply-to: {$this->from}";
        $this->header = "From: {$this->from}\nReply-to: {$this->from}\nMIME-Version: 1.0\nContent-Type: text/html;";// /nMIME-Version～以降はHTML日本語文字のエンコーディング設定
        // $this->header = "From: {$this->from}\nReply-to: {$this->from}\nMIME-Version: 1.0\nContent-Type: text/html; charset=UTF-8"; //上記が本番環境で反映されなければこちらを試す
    }

    public function setContent($content) {//インスタンス時にメソッド操作として文言、変数を代入。あえてメソッドを使っているが、単一なのでsubjectみたいにプロパティで操作してもよい
        $this->contentPass = $content;
    }

    public function send($name, $mail) {
        $to = $mail;//プロパティにしてもいいが、あえてこのままやってみる。このfunction（メソッド）外で使いまわしはできない
        $body = "{$name}さん。{$this->contentPass}";//{$this->greeting}はプロパティを参照するので、このように書く

        $r = mb_send_mail($to, $this->subject, $body, $this->header); //関数実行

        if ($r) {//送信確認用
            $mailTrue_message = "";//topへリダイレクトする際に、登録済みのパラメーターを持たせる
            header("location: ./index.php?mailTrue_message=" . urlencode($mailTrue_message));// ページをリロードする
        } else {
            $mailFalse_message = "";//topへリダイレクトする際に、登録済みのパラメーターを持たせる
            header("location: ./index.php?mailFalse_message=" . urlencode($mailFalse_message));// ページをリロードする
        }
    }
}

?>