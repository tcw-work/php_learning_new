<?php
session_start();// セッションを開始する
if (isset($_SESSION['login'])) {
    if (isset($_POST['logout'])) {
        unset($_SESSION['login']);
        header("Location: $script"); // ログアウト後にページをリダイレクト（これが無いとリロードすると何も表示されなくなる）
        exit();
    }
    echo 'UserID: ' . $_SESSION["login"]["user_id"] . '<br>'; // セッションIDとユーザーIDがリンクしているかを表示して確認
    echo '<p>ログイン中です</p>';

    include dirname(__DIR__).'/function/total_goods.php';//総いいね数を表示
    $user_id = $_SESSION["login"]["user_id"];
    $counter = new GoodsCounter($db, $user_id);//インスタンス作成
    $counter->displayTotalGoods();//デフォルトのいいね文言
}
?>