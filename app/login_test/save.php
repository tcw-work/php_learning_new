<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include 'function/db.php';

//-----セッション参照-----------------------------------------------------------------------------------------------------------------------------------------------------------
session_start();// セッションを開始する
if (isset($_SESSION['login'])) {
    if (!isset($_POST['logout'])) {
        echo 'SessionID: ' . $_SESSION["login"]["user_id"] . '<br>'; // セッションIDとユーザーIDがリンクしているかを表示して確認
    }
}

//-----テーブルを作成-----------------------------------------------------------------------------------------------------------------------------------------------------------
$create_table = <<<_TABLE_
CREATE TABLE IF NOT EXISTS favorites (
    favorite_id INT AUTO_INCREMENT PRIMARY KEY, /* お気に入りレコードの一意のID （ユニークな値で自動的に生成される） */
    user_id TEXT, /* ユーザーID（紐づけ） */
    item TEXT /* お気に入りアイテム */
);
_TABLE_;
$db->exec($create_table);

//-----保存処理-----------------------------------------------------------------------------------------------------------------------------------------------------------

if (isset($_SESSION['login'])) {
    if (!isset($_POST['logout'])) {
        $item = rtrim(htmlspecialchars($_GET["complete"]));//語尾に空白文字があった場合は削除
        $user_id = $_SESSION["login"]["user_id"];
        $insert_query = "INSERT INTO favorites (user_id, item) VALUES ('$user_id', '$item')";// データの挿入クエリ
        $result = $db->exec($insert_query);// クエリを実行
        echo "{$item}を保存しました";
        // header("location: index.php?save_item=". urlencode($item));
    }
}else {
    echo '<p>ログインするか新規登録をおこなってください。</p>';
    echo '<a href="register_form.php">新規登録する</a><br>';
    echo '<a href="login_form.php">ログインする</a>';
}

?>

<br>
<br>
<a href="index.php">トップページに戻る</a>
<br>
<a href="profile.php">プロフィールページで確認する</a>