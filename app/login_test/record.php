<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include 'function/db.php';
require_once 'function/session_admin.php';//ログインID確認用。本番アップ前にユーザーIDは非表示にする
?>

<?php //ログインで検索からお気に入り保存に成功して飛ばされてきたユーザーに表示
    if (isset($_GET["correct_message"])) {
        // URLデコードを行い、メッセージを取得
        $correct_message = urldecode($_GET["correct_message"]);// URLエンコードでは、スペースは %20 と表現されるので、rawurldecode() 関数を使用してデコードする
        echo '<div style="color: red;">' . $correct_message . '</div>';
    }
        ?>
<form action="repository.php" method="GET">
    <input type="text" name="keyword" placeholder="キーワードを入力">
    <input type="submit">
</form>