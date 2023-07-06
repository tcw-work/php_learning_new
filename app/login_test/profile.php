<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <script src="https://corporate.t-creative-works.com/js/jquery-3.5.0.min.js"></script>
</head>
</body>

<?php //削除成功時にdelete.phpから受け取るメッセージ表示
    if (isset($_GET["delete_message"])) {
        // URLデコードを行い、メッセージを取得
        $delete_message = urldecode($_GET["delete_message"]);// URLエンコードでは、スペースは %20 と表現されるので、rawurldecode() 関数を使用してデコードする
        echo '<div style="color: red;">' . $delete_message . '</div>';
    }
?>


<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include 'common/db.php';

require_once 'common/session_admin.php';//ログインID確認用。本番アップ前にユーザーIDは非表示にする

require_once 'function/item_list.php';//全てのアイテム表示


?>


<!-- <script src="js/ajax.js"></script>

<script>
ajaxSubmit('.myForm', "delete.php");
</script> -->

</body>


</html>