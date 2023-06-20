<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include 'function/db.php';

session_start();// セッションを開始する
if (isset($_SESSION['login'])) {
    if (isset($_POST['logout'])) {
        unset($_SESSION['login']);
        header("Location: $script"); // ログアウト後にページをリダイレクト（これが無いとリロードすると何も表示されなくなる）
        exit();
    }
    echo 'UserID: ' . $_SESSION["login"]["user_id"] . '<br>'; // セッションIDとユーザーIDがリンクしているかを表示して確認
    echo '<p>ログイン中です</p>';
}
?>


<form action="repository.php" method="GET">
    <input type="text" name="keyword" placeholder="キーワード">
    <input type="submit">
</form>