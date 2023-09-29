<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
</head>

<body>
    <div class="wrap">
        <?php //未ログインで検索からお気に入り保存に失敗して飛ばされてきたユーザー
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "お気に入り保存を行うにはログインするか新規登録をおこなってください。") {
                        echo '<div style="color: red;">お気に入り保存を行うにはログインするか新規登録をおこなってください。</div>';
                    }
                }
        ?>
        <form action="register.php" method="GET">
            <!--送信エラー時に入力値が消えないようにvalueを設定-->
            <input type="text" name="user_mail" placeholder="メールアドレス"
                value="<?php echo isset($_GET['user_mail']) ? htmlspecialchars($_GET['user_mail']) : ''; ?>"><br>
            <?php
            if (isset($_GET["error_message"])) {
                $error_message = $_GET["error_message"]; // パラメーターからエラーメッセージを取得
                if ($error_message === "メールアドレスを入力してください") {
                    echo '<div style="color: red;">メールアドレスを入力してください</div>';
                }
            }
            ?>
            <?php
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "メールアドレスを半角英数字で入力してください") {
                        echo '<div style="color: red;">メールアドレスを半角英数字で入力してください</div>';
                    }
                }
            ?>
            <?php
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "既に使われているメールアドレスです") {
                        echo '<div style="color: red;">既に使われているメールアドレスです</div>';
                    }
                }
            ?>
            <input type="text" name="user_name" placeholder="ユーザー名"
                value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>"><br>
            <?php
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "ユーザー名を入力してください") {
                        echo '<div style="color: red;">ユーザー名を入力してください</div>';
                    }
                }
            ?>
            <input type="text" name="user_pass" placeholder="パスワード"
                value="<?php echo isset($_GET['user_pass']) ? htmlspecialchars($_GET['user_pass']) : ''; ?>"><br>
            <?php
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "パスワードを入力してください") {
                        echo '<div style="color: red;">パスワードを入力してください</div>';
                    }
                }
            ?>
            <input type="submit">
        </form>
    </div>
</body>

</html>