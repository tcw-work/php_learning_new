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
$save_file = dirname(__FILE__) . "/bbslog.json";

// 掲示板の機能に応じて処理を振り分ける
$mode = isset($_GET["mode"]) ? $_GET["mode"] : "show";//$_GET["mode"]が存在する場合はその値を$modeに代入し、存在しない場合はデフォルト値として"show"を使用
switch ($mode) {
    case "show"://name="mode"の値が空だった場合 = $modeにはshowが入る
        mode_show();
        break;
    case "write"://name="mode"の値がwriteでデータを受け取った場合 = $modeにはwriteが入る（「書く」押した後に処理が走る）
        mode_write();
        break;
    case "reset"://name="mode"の値がresetでデータを受け取った場合 = $modeにはresetが入る
        mode_reset();
    default:
        mode_show();
        break;
}

// データの表示
function mode_show() {
    // 書き込みフォームを表示
    show_form();
    // データの読込み
    $log = load_data();// ファイルの読み書きで使用したデータが入った関数を実行（アンシリアライズで復元された配列データが入っている）
    // ログを表示
    echo "<ul>";
    foreach ($log as $entry) {//foreachでlogに入っているデータを一つ一つをある分だけ$entryとして格納
        $name = htmlspecialchars($entry["name"]);//$entryに入っている連想配列をnameで指定。中身は「name=>入力した名前」が入っているので、nameにすることで文字列を取り出せる
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
    </form>
    <!--リセット(フォームタグは区切る) -->
    <form>
    <input type="hidden" name="mode" value="reset" />
    <input type="submit" value="掲示板の初期化" />
    </form> <hr />
    _FORM_;
}


// データの書き込み
function mode_write() {
    // データの検証
    if ($_GET["name"] == "" || $_GET["body"] == "'") {//inputの値が空の場合
        echo "名前か本文が空です。入力してください";
        exit;
    }
    // 既存のデータを読み込む
    $log = load_data();//この関数の中にはアンシリアライズして復元された配列データ（$log）が入っている
    array_unshift($log, $_GET);//既存の配列に新たな配列を加える。$_GETは、URLパラメータ（クエリ文字列）から送信されたデータを格納する連想配列なので、phpの機能として備わっている。"name" => "John",のような形で連想配列として格納される。
    save_data($log);//save_data()はシリアライズするための処理が入っていて、$logにはシリアライズ済みの配列データが入っている（ここまではデータ格納のみで表示自体はされない）

    $self = $_SERVER['SCRIPT_NAME'];//現在のURL
    echo "<a href=\"$self\">書き込みました!!</a>";
}

// データのアンシリアライズを行う
function load_data() {//load_data()にはアンシリアライズして復元された配列データ（$log）が入っている
    global $save_file; //$save_file変数をグローバル変数として扱う。$save_fileは関数の外で定義されているため、扱うにはglobalする必要がある。これをやらないと関数内で変数を使用できない。
    $log = array();//空の配列$logを作成（後で読み込まれたデータを格納するためのもの）
    if (file_exists($save_file)) {//ファイルが存在するかチェック
        // ファイルがあれば読み込む
        $txt = file_get_contents($save_file);// ファイルの内容をテキストとして取得
        $log = json_decode($txt, true); // unserialize()json_decode()を使用。この関数は第2引数に true を指定することで、連想配列としてデコードすることができます。（お作法として覚える）
    }
    return $log;// 読み込んだデータ（unserializeしたもの）を返す
}

//データのシリアライズを行う
function save_data($log) {
    global $save_file;//$save_file変数をグローバル変数として扱う
    $txt = json_encode($log);//serialize()json_encode()を使用。
    file_put_contents($save_file, $txt);//シリアライズしたデータを保存
}

// リセットボタン押したときの設定
function mode_reset() {
    save_data(array());//セーブしたデータの中身（配列）を空にする。※からの配列を引数に設定するだけ
    echo "掲示板をリセットしました";
}
?>