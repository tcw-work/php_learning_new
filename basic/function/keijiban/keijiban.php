<h1>掲示板</h1>
<br><br><br>


<h2>配列の内容をtxtに保存し、表示するテスト</h2>
<?php
// 作成した配列を文字列に変換してtxtに入れる
$fruites = array("banana","apple","orange");
file_put_contents("test.txt",serialize($fruites));//配列のままだと直接ファイルに保存できないため、serializeで配列を文字列データに変換し、file_put_contentsでファイルに保存

// txtに入った文字列を表示する（txtさえあれば↓だけでも動く）
$str = file_get_contents("test.txt");//txtの中身を取得
$fruites = unserialize($str);//取得した中身を表示するために、unserializeでphpのオブジェクト（配列の形）に再変換
echo $fruites[1];
?>


<br><br><br>


<h2>掲示板</h2>
<?php

// 初期設定 (データファイルの保存先)
$save_file = dirname(__FILE__) . "/bbslog.txt";

// 掲示板の機能に応じて処理を振り分ける
$mode = isset($_GET["mode"]) ? $_GET["mode"] : "show";//$_GET["mode"]が存在する場合はその値を$modeに代入し、存在しない場合はデフォルト値として"show"を使用
switch ($mode) {
    case "show"://name="mode"の値が空だった場合 = $modeにはshowが入る
        mode_show();
        break;
    case "write"://name="mode"の値がwriteでデータを受け取った場合 = $modeにはwriteが入る（「書く」押した後に処理が走る）
        mode_write();
        break;
    default:
        mode_show();
        break;
}

// データの表示
function mode_show() {
    // 書き込みフォームを表示
    show_form();
    // データの読込み
    $log = load_data();// ファイルの読み書きで使用したデータが入った関数を実行
    // ログを表示
    echo "<ul>";
    foreach ($log as $entry) {
        $name = htmlspecialchars($entry["name"]);
        $body = htmlspecialchars($entry["body"]);
        echo "<li><b style='color:red;'>$name</b>: $body</li>\n";
    }
    echo "</ul>";
}

// 入力フォームを表示
function show_form()
{
    echo <<<_FORM_
    <form>
    ■名前: <input type="text" name="name" size="8"/>
    本文: <input type="text" name="body" size="30" />
    <input type="submit" value="書く" />
    <input type="hidden" name="mode" value="write" />
    </form> <hr />
    _FORM_;
}

// データの書き込み
function mode_write()
{
    // データの検証
    if ($_GET["name"] == "" || $_GET["body"] == "'") {
        echo "名前か本文が空です。入力してください";
        exit;
    }
    // 既存のデータを読み込む
    $log = load_data();
    array_unshift($log, $_GET);
    save_data($log);

    $self = $_SERVER['SCRIPT_NAME'];
    echo "<a href=\"$self\">書き込みました!!</a>";
}

// ファイルの読み書き
function load_data() {
    global $save_file;
    $log = array();

    if (file_exists($save_file)) {
        // ファイルがあれば読み込む
        $txt = file_get_contents($save_file);
        $log = unserialize($txt); // テキストからデータを復元
    }
    return $log;
}

function save_data($log)
{
    global $save_file;
    $txt = serialize($log);
    file_put_contents($save_file, $txt);
}
?>