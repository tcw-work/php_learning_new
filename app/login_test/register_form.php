<?php include 'includes/header.php'; ?>


<?php include 'includes/side.php'; ?>
<main class="register_form.php">
    <div class="decoration">
        <p>Source Pack</p>
    </div>
    <?php //未ログインで検索からお気に入り保存に失敗して飛ばされてきたユーザー
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "お気に入り保存を行うにはログインするか新規登録をおこなってください。") {
                        echo '<div class="red mb_32">お気に入り保存を行うにはログインするか新規登録をおこなってください。</div>';
                    }
                }
        ?>
    <form action="register.php" method="GET">
        <h2 class="common_ttl">新規登録</h2>
        <p class="form_des">テキストテキストテキストテキストテキスト</p>
        <!--送信エラー時に入力値が消えないようにvalueを設定-->
        <input type="text" name="user_mail" placeholder="メールアドレス"
            value="<?php echo isset($_GET['user_mail']) ? htmlspecialchars($_GET['user_mail']) : ''; ?>">
        <?php
            if (isset($_GET["error_message"])) {
                $error_message = $_GET["error_message"]; // パラメーターからエラーメッセージを取得
                if ($error_message === "メールアドレスを入力してください") {
                    echo '<div class="red">メールアドレスを入力してください</div>';
                }
            }
            ?>
        <?php
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "メールアドレスを半角英数字で入力してください") {
                        echo '<div class="red">メールアドレスを半角英数字で入力してください</div>';
                    }
                }
            ?>
        <?php
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "既に使われているメールアドレスです") {
                        echo '<div class="red">既に使われているメールアドレスです</div>';
                    }
                }
            ?>
        <input type="text" name="user_name" placeholder="ユーザー名"
            value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
        <?php
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "ユーザー名を入力してください") {
                        echo '<div class="red">ユーザー名を入力してください</div>';
                    }
                }
            ?>
        <input type="text" name="user_pass" placeholder="パスワード"
            value="<?php echo isset($_GET['user_pass']) ? htmlspecialchars($_GET['user_pass']) : ''; ?>">
        <?php
                if (isset($_GET["error_message"])) {
                    $error_message = $_GET["error_message"];
                    if ($error_message === "パスワードを入力してください") {
                        echo '<div class="red">パスワードを入力してください</div>';
                    }
                }
            ?>
        <input type="submit">
    </form>
</main>