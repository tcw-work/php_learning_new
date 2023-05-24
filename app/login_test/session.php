<?php

function sesstion_login($user_name) {
// セッションを開始する
session_start();//sessionを開始するにはこの関数で呼び出し
//ログイン情報をセッションに記録
$_SESSION["login"] = array("user_name"=>$user_name);
echo "ログイン成功";
//ログインしている場合
$user_name_logged = $_SESSION["login"]["user_name"];//スパーグローバル変数に入った連想配列から名前を取り出す
echo "こんにちは、{$user_name_logged }さん!";

}



session_start();

function session_part_01($script) {
    if (isset($_SESSION['login'])) {
        if (isset($_POST['logout'])) {
            unset($_SESSION['login']);
            header("Location: $script"); // ログアウト後にページをリダイレクト（これが無いとリロードすると何も表示されなくなる）
            exit();
        }
        echo '<p>ログイン中です</p>';
        echo <<<_logout_
        <form action='$script' method="POST">
            <input type="hidden" name="logout"><br>
            <input type="submit" value="ログアウトする">
        </form>
        _logout_;
        return true;//return 文は特定の条件が満たされた場合や処理を終了したい場合に使用。これがなければログアウトしたときに下記のif文も実行されてしまい、両方とも表示される
    }

    if (isset($_SESSION['logout'])) {//ログアウト状態（セッション変数にlogoutの値が入っている場合の表示）
        unset($_SESSION['login']);
        echo '<p>ログインしていません。</p>'; // ログインしていない場合の表示
        echo '<a href="login.php">ログインする</a>';
        return false;//明示的な値を指定する場合の違いが明確でない場合や、関数の戻り値を利用しない場合には、特に false や true を指定する必要ない
    }

    // ログアウト状態（セッション変数になにも入っていない場合の表示）＝新規ユーザー向け
    echo '<p>ログインしていません。</p>';
    echo '<a href="login.php">ログインする</a>';
}

$script = $_SERVER["SCRIPT_NAME"]; // このPHPファイルのパス

?>