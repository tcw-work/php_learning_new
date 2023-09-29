<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include '../common/db.php';

require_once '../common/session.php';//ログイン前後の出し分けを要素を管理
session_part_01($script);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
    <script src="https://corporate.t-creative-works.com/js/jquery-3.5.0.min.js"></script>
</head>

<body>

    <form action="library_data.php" method="GET" class="myForm">
        <input type="text" name="bookTitle" placeholder="キーワードを入力">
        <input type="submit">
    </form>

    <!-- 出力結果表示エリア -->
    <div id="response-message"></div>

    <!-- <script src="../src/js/ajax.js"></script>
    <script>
    ajaxSubmit('.myForm', "library_data.php");
    </script> -->
</body>

</html>