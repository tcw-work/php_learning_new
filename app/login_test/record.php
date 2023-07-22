<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include 'common/db.php';
require_once 'common/session.php';//ログイン前後の出し分けを要素を管理
session_part_01($script);
?>

<?php //ログインで検索からお気に入り保存に成功して飛ばされてきたユーザーに表示
    if (isset($_GET["correct_message"])) {
        // URLデコードを行い、メッセージを取得
        $correct_message = urldecode($_GET["correct_message"]);// URLエンコードでは、スペースは %20 と表現されるので、rawurldecode() 関数を使用してデコードする
        echo '<div style="color: red;">' . $correct_message . '</div>';
    }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <script src="https://corporate.t-creative-works.com/js/jquery-3.5.0.min.js"></script>
</head>

<body>

    <form action="function/repository.php" method="GET" class="myForm">
        <input type="text" name="keyword" placeholder="キーワードを入力">
        <input type="submit">
    </form>
    <div id="response-message"></div>

    <script src="js/ajax.js"></script>

    <script>
    ajaxSubmit('.myForm', "function/repository.php");
    </script>
</body>


</html>