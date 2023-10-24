<?php include __DIR__ . '/common/db.php'; ?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/side.php'; ?>
<?php
// require_once 'common/session.php';//ログイン前後の出し分けを要素を管理
// session_part_01($script);
?>


<main class="profile_form">

    <?php //削除成功時にdelete.phpから受け取るメッセージ表示
    if (isset($_GET["delete_message"])) {
        // URLデコードを行い、メッセージを取得
        $delete_message = urldecode($_GET["delete_message"]);// URLエンコードでは、スペースは %20 と表現されるので、rawurldecode() 関数を使用してデコードする
        echo '<div style="color: red;">' . $delete_message . '</div>';
    }
?>



    <?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
// include 'common/db.php';
// require_once 'common/session.php';//ログイン前後の出し分けを要素を管理
// session_part_01($script);
require_once  __DIR__ . '/function/item_list.php';//全てのアイテム表示
?>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>