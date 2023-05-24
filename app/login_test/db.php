<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
try {//{}の中で処理が失敗したら、catch{}の中の処理を執行
    $dsn = 'mysql:host=localhost;dbname=c_app';
    $username = 'root';
    $password = '';
    $db = new PDO($dsn, $username, $password);//接続するDB指定。もし指定されたパスにデータベースファイルが存在しない場合、new PDO()の呼び出し時に自動的にファイルが作成される
} catch (PDOException $e) {//↑が失敗したら実行する処理。tryにnew PDOを使う場合はPDOExceptionを使用しておく（でないとブラウザにPHPのエラーが直接出る）
    //$eは例外オブジェクトをキャッチした際に代入される変数（任意の文字）。PDOExceptionはデータベース接続時に発生する可能性があるいくつかのエラーをキャッチするために使用（エラーの詳細な情報を取得し、適切なエラーハンドリングを行うことができる）
    echo "データベースに接続できません。" . $e->getMessage();//getMessage()は例外のエラーメッセージを取得したり、エラーの特定が容易になるという意味で使用される
    //$eに格納されている例外オブジェクトのgetMessage()メソッドを呼び出して、該当の例外のエラーメッセージを取得する。
    exit;
}

//-----テーブルを作成-----------------------------------------------------------------------------------------------------------------------------------------------------------
// テーブルは作成してもこの時点では実行不可能。IF NOTを加えることでテーブルが存在していない場合の処理ができる（存在している場合はalerdy existと出る）
$create_table = <<<_TABLE_
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY, /* ユーザーID（自動で割り振り） */
    user_name TEXT, /* ユーザー名 */
    user_pass TEXT, /* パスワード */
    user_mail TEXT, /* メールアドレス */
    user_document TEXT /* 文字保存 */
);
_TABLE_;
$result = $db->exec($create_table);//ここでテーブルが作成される

//-----受け取った情報を処理-----------------------------------------------------------------------------------------------------------------------------------------------------------
$user_name = htmlspecialchars($_GET["user_name"]);//form.phpから値を取得//エスケープ処理
$user_pass = htmlspecialchars($_GET["user_pass"]);//この時点ではパスワードはハッシュ化しない
$user_mail = htmlspecialchars($_GET["user_mail"]);
// echo $user_name; echo $user_pass; echo $user_mail;   //表示確認用

if (!empty($user_name) && !empty($user_pass)) {//名前とパスワードが空でない場合はtrue処理
    $user_infor = array (
        "user_name"=>$user_name,//サニタイジングした情報を連想配列＋新しい変数に格納
        "user_pass"=>$user_pass = hash("sha512", $user_pass),//パスワードはハッシュ化。第一引＝はハッシュアルゴリズムで第二引数は入力データ
        "user_mail"=>$user_mail,
    );
    print_r($user_infor);//表示確認用（配列の中身を全表示）
    echo $user_infor["user_name"];//表示確認用（配列の中身を個別に全表示）

    $query = "INSERT INTO users (user_name, user_pass, user_mail) VALUES ('{$user_infor['user_name']}', '{$user_infor['user_pass']}', '{$user_infor['user_mail']}')";
    //↑クエリ内で配列操作する場合はダブルクォートと中括弧 ({}) で囲むことで正常にsqlが実行される
    $db->exec($query);//DBに対してsql(insert)を実行

    include 'session.php';//セッション処理をまとめた関数を格納したファイル
    sesstion_login($user_name);//ログイン時にユーザー名をセッションに保管

    if (!empty($user_mail)) {//メールアドレスを登録しているならメール送信
        // echo "メールも成功";
        include 'mail.php';//メール送信に関する関数を格納しているmail.phpを呼びだし
        send_mail($user_name, $user_mail);//mail.php内に定義された関数に引数を加えて実行
    }

        
        header("location: index.php");// ページをリロードする
        exit;

} else if (empty($user_name)) {
    echo "名前が空です";
} else if (empty($user_pass)) {
    echo "パスワードが空です";
}


?>