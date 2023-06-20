<?php
session_start();// セッションを開始する

function session_login($user_id) {
//ログイン情報をセッションに記録
$_SESSION["login"] = array("user_id"=>$user_id);//セッションIDとしてユーザーIDを保存
}

function session_part_01($script) {//リダイレクト先のindex.phpで呼び出し

    class State {//ログイン状態の有無の表示をクラスで管理
        public $state_log;
        function __construct($state_log) {
            $this->state_log = $state_log;
            echo "<p>{$this->state_log}時のインスタンステスト</p>";
        }
    }

    if (isset($_SESSION['login'])) {
        if (isset($_POST['logout'])) {//ログアウト切り替え処理
            unset($_SESSION['login']);
            header("Location: $script"); // ログアウト後にページをリダイレクト（これが無いとリロードすると何も表示されなくなる）
            exit();
        }
        echo 'UserID: ' . $_SESSION["login"]["user_id"] . '<br>'; // セッションIDとユーザーIDがリンクしているかを表示して確認
        $state = new State("ログインしている");//クラスのインスタンス実行
        echo <<<_logout_
        <form action='$script' method="POST">
            <input type="hidden" name="logout"><br>
            <input type="submit" value="ログアウトする"><br>
            <a href="notice_mail.php">メール一斉送信実行（管理者用になる予定）</a>
        </form>
        _logout_;
        return true;//return 文は特定の条件が満たされた場合や処理を終了したい場合に使用。これがなければログアウトしたときに下記のif文も実行されてしまい、両方とも表示される
    }

    // ログアウト状態（セッション変数になにも入っていない場合の表示）＝新規ユーザー向け
    $state = new State("ログインしていない");//クラスのインスタンス実行
    echo '<a href="register_form.php">新規登録する</a><br>';
    echo '<a href="login_form.php">ログインする</a><br>';
    echo '<a href="notice_mail.php">メール一斉送信実行（管理者用になる予定）</a>';
}


$script = $_SERVER["SCRIPT_NAME"]; // このPHPファイルのパス

?>