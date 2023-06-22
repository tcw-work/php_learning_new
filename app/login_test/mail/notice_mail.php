<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------

require_once '../function/db.php';
//DBのメールカラムをセレクトし、変数に格納
$check_infor = "SELECT user_mail, user_name FROM users";//ここではまだカラムだけを選択した状態で中身は未取得
$result = $db->query($check_infor);

//-----メールクラスへのアクセス-----------------------------------------------------------------------------------------------------------------------------------------------------------
include 'mail.php';//メール送信に関する関数を格納しているmail.phpを呼びだし
$from_mail = "tomizawa@t-creative-works.com";//インスタンス作成時に__constructに入れる引数（送りてのアドレス）
$mailSender = new MailSender($from_mail);//mail.phpの内容はクラスで作られているので、インスタンス化

$mailSender->subject = "告知メール";//プロパティへ（件名代入）
// $mailSender->send($c_name, $result);//ここで実行するとすべてのユーザーには送れないので、後ほどループで処理する


$file = dirname(__FILE__) . '/notice_content.txt';//現在のディレクトリと同階層のファイルを変数に格納
if (file_exists($file)) {
    $c_content = file_get_contents($file);
    $mailSender->setContent($c_content);//メソッドへアクセス（文言代入）
}


while($row = $result->fetch(PDO::FETCH_ASSOC)) {//fetch() は結果セット（セレクトしたカラム）から1行ずつデータ（中身）を取得するために使用し、それをPDO::FETCH_ASSOC定数で連想配列として返す
    $user_mail = $row['user_mail'];//$rowに連想配列として入っているuser_mailを変数に送信用変数に
    $user_name = $row['user_name'];
    echo $user_mail . "<br>";//各行は fetch() メソッドによって連想配列として取得＋user_mail カラムの値が出力（管理者確認用）
    $mailSender->send($user_name, $user_mail);//メソッドへアクセス（引数をセットして関数実行）。全員に送りたいので、ループでDBから取得した分だけ送信
}



?>