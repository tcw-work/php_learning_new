<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
</head>

<body>
    <div class="wrap">
        <div class=""></div>
        <div class="login">
            <?php
include 'session.php';//ログイン前後の出し分けを要素を管理
session_part_01($script);
?>
        </div>
        <p>ダミー要素</p>
    </div>
</body>

</html>