<?php

// データベースへの接続
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

// テーブルを作成する（この時点で実行はできない）。IF NOTを加えることでテーブルが存在していない場合の処理ができる（存在している場合はalerdy existと出る）
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

$user_name = htmlspecialchars($_GET["user_name"]);//form.phpから値を取得//エスケープ処理
$user_pass = htmlspecialchars($_GET["user_pass"]);
$user_mail = htmlspecialchars($_GET["user_mail"]);
// echo $user_name; echo $user_pass; echo $user_mail;   //表示確認用

$user_infor = array (
    "user_name"=>$user_name,
    "user_pass"=>$user_pass,
    "user_mail"=>$user_mail,
);
print_r($user_infor);//表示確認用（配列の中身を全表示）
echo $user_infor["user_name"];//表示確認用（配列の中身を個別に全表示）

$query = "INSERT INTO users (user_name, user_pass, user_mail) VALUES ('{$user_infor['user_name']}', '{$user_infor['user_pass']}', '{$user_infor['user_mail']}')";
//↑クエリ内で配列操作する場合はダブルクォートと中括弧 ({}) で囲むことで正常にsqlが実行される
$db->exec($query);


?>