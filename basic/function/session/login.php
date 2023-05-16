<h1>ログイン機能</h1>
sessionは任意の値をデバイスではなくWebサーバー保存できるので、ユーザー認証が可能
<br><br><br>

<?php
// ユーザーとパスワードの一覧（DBではなく連想配列として格納）
$users = array(
    // ユーザー名 => パスワード (SHA1でハッシュ化)
    "takeshi" => "a94a8fe5ccb19ba61c4c0873d391e987982fbbd3", //test
    "yutaka" => "ee3f7d52ca341c51c694af9288701f4ce43be0ad", //rabit
    "akiko" => "f91a8ee646a277a2f1359709604b99c1b32d9f24" //-panda
);

$script = $_SERVER["SCRIPT_NAME"]; // このPHPファイルのパス

// セッションを開始する
session_start();

// ログインしているか?
if (isset($_SESSION["login"])) {//settionにloginというキー（変数）が入っているか（後述）
    show_login_contents();//入っていればログイン用の表示を格納している関数を実行
    exit;
}

// ログインフォームからの入力があるか?
if (isset($_POST["user"])) {//input経由でuserというname属性が入っていれば
    check_login();//ログインするかチェックする関数を実行
} else {
    show_login_form(); // 入っていなければ再びログインフォームを表示
}

// ログインフォームを表示
function show_login_form() {
    global $script;//現在のPHPファイルのパスが入った変数をグローバル化
    echo <<<FORM
<div id="loginform">
    <form action="$script" method="POST">
        <h3>ログインしてください</h3>
        <label>ユーザー名</label>
        <input type="text" name="user" />
        <label>パスワード</label>
        <input type="password" name="pass" />
        <button type="submit">ログイン</button>
    </form>
</div>
FORM;
}

// ログインするかチェック
function check_login() {
    global $users, $script;//アイパスの入った配列を格納した変数と現在のPHPファイルのパスが入った変数をグローバル化
    // 入力を検証する
    if (empty($_POST["pass"])) {//もしパスワードが空だったら
        echo "パスワードが入力されていません。";
        exit;
    }
    if (empty($users[$_POST["user"]])) {//もしユーザーＩＤが空だったら
        echo "ユーザーが存在しないかパスワードが違います。";
        exit;
    }
    // パスワードが合致しているかチェック（tureの時の処理）
    $pass_correct = $users[$_POST["user"]];//連想配列のパスワードへアクセスする＋ユーザー側から受け取った値$_POST["user"]と一致しているパスワードを参照＋新たな変数に格納
    if (sha1($_POST["pass"]) != $pass_correct) {//$_POST["pass"] に格納されたパスワードを SHA-1 ハッシュ関数を使用してハッシュ化＋連想配列にアクセスした$pass_correctと異なっていれば
        echo "ユーザーが存在しないかパスワードが違います。";
        exit;
    }
    // ログインしたことをセッションに記録（新規ログイン時の機能は今回なし）
    $_SESSION["login"] = array("user" => $_POST["user"]);//ユーザー名だけを格納する連想配列を変数化
    echo "<a href=\"$script\">ログインしました!</a>";
}

// ログインしているときの処理
function show_login_contents() {
    $user = $_SESSION["login"]["user"];//これは$_SESSION["login"]というスーパーグローバル変数の中にある配列キー"user"にアクセスするという意味の書き方。$_SESSION["user"] = ～のような処理を行わずに配列操作可能
    //このような書き方をすることで、セッション変数に保存されたデータを階層的にアクセスできる。PHPにおいて「多次元配列へのアクセス」と呼ばれている
    echo "<h1>こんにちは、{$user}さん!</h1>";
    echo "<p>このページはログインした人にだけ見える秘密のページです。</p>";
}
?>