<?php
$savepath = dirname(__FILE__) . '/chatlog.db';//テスト用のDB
$script_name = $_SERVER["SCRIPT_NAME"]; // このプログラムのパス

// データベースへの接続
try {
    $db = new PDO("sqlite:$savepath");//DBへ接続。もし指定されたパスにデータベースファイルが存在しない場合、new PDO()の呼び出し時に自動的にファイルが作成されます。
} catch (PDOException $e) {//もし接続処理に引っかかったら、エラー内容を表示
    echo ":" . $e->getMessage();
    exit;
}

// チャットログのテーブル定義（sqlを変数に格納）
$create_query = <<< _SQL
CREATE TABLE IF NOT EXISTS chatlog (
    log_id INTEGER PRIMARY KEY, /* ID PRIMARY KEYをせっとしておけば自動的にid番号付与してくれる */
    name TEXT, /* 名前 */
    body TEXT, /* 本文 */
    ctime INTEGER /* 投稿日時 */
);
_SQL;

$db->exec($create_query);

// 書き込み処理があったか?
if (isset($_GET["name"]) && isset($_GET["body"])) {//もしnameとbodyに値が入っていたら
    if ($_GET["name"] == "" || $_GET["body"] == "") {//値が空であれば、終了
        // echo "<p>tilta. </p>";
        exit;
    }

    // データベースに挿入
    $template = "INSERT INTO chatlog (name, body, ctime) VALUES (?, ?, ?)";//VALUESの値にはphpのデータを
    $stmt = $db->prepare($template);//prepareステートメントを使うと、excuteステートメント実行時にSQLの任意の部分にPHPのデータを埋め込める（prepareはあくまでもexcuteの実行準備）
    $stmt->execute(array($_GET["name"], $_GET["body"], time()));//arrayの中身を引数として埋め込める。time()は一旦タイムスタンプとして嗄声
    header("location: $script_name");//リロードする
    exit;
}

// 書き込みフォームの表示
echo <<<_FORM_
<h3></h3>
<form action="$script_name" method="GET">
    <div id="chatform">
        名前:<input type="text" name="name" size="8">
        本文:<input type="text" name="body" size="40">
        <input type="submit" value="書き込み">
    </div>
</form>
_FORM_;

// ログの表示
$select_query = "SELECT * FROM chatlog ORDER BY log_id DESC LIMIT 2";//①FROM chatlogはこのテーブルから ②ORDER BY log_idはログIDを基に ③DESCはソート（大きい順）に選択・小さい順の場合はASC　④ESC LIMIT ”番号”で何件表示すか指定
$stmt = $db->query($select_query);
foreach ($stmt as $row) {//$stmt（テーブル一行文の内容をループで全表示）
    $name = htmlspecialchars($row["name"]);
    $body = htmlspecialchars($row["body"]);
    $ctime = date("H:i:s", $row["ctime"]);//さっき作ったタイムスタンプをdate関数でH:i:sに変換
    echo "<div class='log'>($ctime) $name &gt; $body</div>";
}
?>