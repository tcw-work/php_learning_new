<?php
$c_name = htmlspecialchars($_POST['c_name']);
$c_mail = htmlspecialchars($_POST['c_mail']);
$c_content = htmlspecialchars($_POST['c_content']);

//クラスをインスタンスして操作
include 'mail.php';//メール送信に関する関数を格納しているmail.phpを呼びだし
$mailSender = new MailSender();//mail.phpの内容はクラスで作られているので、インスタンス化
$mailSender->setContent($c_content);//メソッドへアクセス（文言代入）
$mailSender->subject = "お問い合わせ";//プロパティへ（件名代入）
$mailSender->send($c_name, $c_mail);//メソッドへアクセス（引数をセットして関数実行）


//日本語設定を行う
// mb_language("Japanese");
// mb_internal_encoding("UTF-8");

// function send_mail($c_name, $c_mail, $c_content) {// $user_name, $user_pass, $user_mail を使用してメールの処理を行う（引数の内容はregister.phpで呼び出されたときに定義されている）
//     // 言語とエンコードをセット（お作法として覚えておく）
//     mb_language("Japanese");//日本語の文字列処理やエンコードが必要な場合には、mb_language("Japanese")を設定しておく
//     mb_internal_encoding("UTF-8");//文字エンコーディング
//     //送信者を宛名をセット
//     $from = "tomizawa@efit.co.jp"; //送信元
//     $to = $c_mail; //充て先。（register.phpで定義）
//     //メールヘッダー作成
//     $encodedFrom = mb_encode_mimeheader($from);//念のため送信元をエンコードしておく（特殊な文字列が使われなければ不要）
//     $header = "From: $encodedFrom\n";
//     $header .= "Reply-to: $encodedFrom";
//     //件名や本文をチェック
//     $subject = "登録メールのテスト";
//     $body = "こんにちは{$c_name}さん。メールの本文「{$c_content}」です。";//。$user_nameはregister.phpで定義
//     //日本語メール送信
//     $r = mb_send_mail($to, $subject, $body, $header);
//     //mb_send_mail(宛先, 件名, 本文, 追加ヘッダー); 追加ヘッダーには送信者（from）や返信先（to）が入っている
//     if ($r) {//もしmb_send_mail関数が実行して成功（true）したら
//         echo "メール送信成功";
//     } else {
//         echo "メール送信失敗";
//     }
//     }
//     send_mail($c_name, $c_mail, $c_content);

    //$action = $_POST['action'];
    // $mail = "以下の内容が送信されました。\n\n";
    // $mail = "【お名前】\n";
    // $mail = $c_name."\n\n";
    // $mail = "【メールアドレス】\n";
    // $mail = $c_mail."\n\n";
    // $mail = "【お問い合わせ内容】\n";
    // $mail = $c_content."\n\n";
    // //    ↑これだと一番下のしか表示されない

    // //    「.」連結を意味する
    // $mail = "以下の内容が送信されました。\n\n"."【お名前】\n".$c_name."\n\n"."【メールアドレス】\n".$c_mail."\n\n"."【お問い合わせ内容】\n".$c_content."\n\n";

    // $mail_to = "tomizawa@efit.co.jp";//送信先メールアドレス
    // $mail_subject = "TESTメールフォーム\n".$c_name."より送信されました";//メールの件名
    // $mail_body = $mail;//メールの本文
    // $mail_header = "from:".$c_mail;//フォームで入力されたメールアドレスを送信元として表示する

    // //↓$returnPathは送信先からエラーなどがあった際に通知されるアドレス
    // $returnPath = '-f'.'tomizawa@efit.co.jp';
    // $mailsend = mb_send_mail($mail_to, $mail_subject, $mail_body, $mail_header, $returnPath);


    ?>

<!-- // if (empty($c_name)) {
// $c_name = 'value="名前が入力されていません" class="error_class"';
// } else {
// $c_name;
// }
// if (empty($c_mail)) {
// $c_mail = 'value="メールアドレスが不正です" class="error_class"';
// }else {
// $c_mail;
// }
// if (empty($c_content)) {
// $c_content = 'お問い合わせ内容が空欄です';
// }else {
// $c_content;
// }


// class MyError {
// public $error;
// function setError ($error) {
// $this->error = $error;
// }
// function getError () {
// return $this->error;
// }
// }

// $te = new MyError;
// $te->setError("ああああ");
// echo "名前: {$te->getError()}";



// class Person {

// private $name; //カプセル化で外部からアクセス不可なので、setとgetの引数でアクセス

// // $nameのセッター
// function setName ($name) {
// $this->name = $name;
// }

// // $nameのゲッター
// function getName() {
// return $this->name;
// }

// }

// // インスタンスの生成
// $p = new Person();
// $p->setName("やまだ");
// echo "名前: {$p->getName()}";//getを使って出力をクラス外で行う



 -->



<!-- 
<form action="contact_check.php" method="post">
    <input type="text" id="c_name" name="c_name" placeholder="名前" <?php echo $c_name; ?>>
    <input type="text" id="c_mail" name="c_mail" placeholder="メールアドレス" <?php echo $c_mail ?>>
    <textarea class="input" id="c_content" name="c_content" rows="7"
        placeholder="お問い合わせ内容"><?php echo $c_content ?></textarea>
    <input type="submit" value="送信する" class="submit">
</form> -->