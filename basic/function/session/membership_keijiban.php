<?php
$users = array(
    // ユーザー名 => パスワード (SHA1でハッシュ化)
    "takeshi" => "a94a8fe5ccb19ba61c4c0873d391e987982fbbd3", //test
    "yutaka" => "ee3f7d52ca341c51c694af9288701f4ce43be0ad", //rabit
    "akiko" => "f91a8ee646a277a2f1359709604b99c1b32d9f24" //-panda
);

$script = $_SERVER["SCRIPT_NAME"]; // このPHPファイルのパス

// セッションを開始する
session_start();


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



// ログイン後の処理・表示

$savefile = dirname(__FILE__).'/log.txt';//ログを保存するテキス
// session_start();
// ログイン状態や送信されたパラメータにより分岐
if (isset($_SESSION["login"])) { // 既に$_SESSIONに値が入っているか（ログインしているか?）
    show_login_contents();//ログインしていればこの処理からスタート
}

// ログイン時のコンテンツを表示
function show_login_contents() {
    $m = isset($_GET["m"]) ? $_GET["m"] : ""; // 必要な処理があれば分岐する

    switch ($m) {
        case "logout"://ログアウト選択したら
            show_logout();
            break;
        case "write"://書き込む選択したら
            write_log();
            break;
        default:
            show_log();
            break;
    }
}

// ログの表示
function show_log() {
    global $script, $savefile;
    $user = $_SESSION["login"]["user"];//$_SESSION["login"]の中にある連想配列に格納されているユーザー名
    echo "<h1>こんにちは{$user}さん!</h1>";
    echo "<p>現在ログイン中</p>";
    echo "<a href='$script?m=logout'>ログアウトする</a>";//m=logoutはパラメーターとして送信され$_GET["m"]で処理される。

    // 掲示板の表示
    echo "<h3>Logs</h3>";
    $log = array();//空の配列を作る
    if (file_exists($savefile)) {//もしlog.txtのファイルが存在したら
        $log = unserialize(file_get_contents($savefile));//取得した中身を表示するために、txtのない内容を取得し、unserializeでphpのオブジェクト（配列の形）に変換
    }
    echo "<ul>";
    foreach ($log as $entry) {//lgの中身（連想配列）にループを掛ける
        $name = htmlspecialchars($entry["name"]);//name要素各々を変数に格納
        $body = htmlspecialchars($entry["body"]);//body要素各々を変数に格納
        echo "<li>$name: $body</li>";
    }
    echo "</ul>";

    // 書き込みフォームを表示
    echo "<form action='$script' method='get'>";
    echo "<input type='text' name='body' size='40' />";
    echo "<input type='hidden' name='m' value='write' />";
    echo "<input type='submit' value='書き込む' />";
    echo "</form>";
}

// ログの書き込み
function write_log() {
    global $script, $savefile;
    if (empty($_GET["body"])) {
        echo "Invalid input.";
        exit;
    }

    $log = array();//空の配列を作る
    if (file_exists($savefile)) {//もしlog.txtのファイルが存在したら
        $log = unserialize(file_get_contents($savefile));//取得した中身を表示するために、txtのない内容を取得し、unserializeでphpのオブジェクト（配列の形）に変換
    }

    $log[] = array("name" => $_SESSION["login"]["user"], "body" => $_GET["body"]);//$logに入っている配列に新たな配列を加える際は変数名の後に[]をつける（お作法）
    file_put_contents($savefile, serialize($log));//txtにシリアライズした書き込みを保存

    // ページをリロードする
    header("location: $script");
    exit;
}

// ログアウト処理を行う
function show_logout() {
    global $script;
    unset($_SESSION["login"]);//unset変数を使用すればセッション情報を削除できる→ログアウトしたことになる
    echo "<a href='$script'>Go back</a>";
    exit;
}
?>