<?php
$fp = fopen("ejdict-hand-utf8.txt", "r");//ファイルを指定モード（r=読み込み用）で開く
$db = new PDO("sqlite:ejdict.db");//接続するDB指定
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//PDOのエラーモードを設定。エラーが発生した場合に例外をスローして処理を停止するように設定

// テーブルを作成する（この時点で実行はできない）。IF NOTを加えることでテーブルが存在していない場合の処理ができる（存在している場合はalerdy existと出る）
$create_query = <<< __SQL__
CREATE TABLE IF NOT EXISTS words (
    word_id INTEGER PRIMARY KEY,
    title TEXT,
    body TEXT
)
__SQL__;
$db->exec($create_query);//テーブル作成を実行

//英単語をDBに挿入
$insert_query = <<< __SQL__
INSERT INTO words (title, body) VALUES (?, ?)
__SQL__;
$insert_stmt = $db->prepare($insert_query);//executeを行う前にprepareでてクエリ（データベースに対して情報を要求するために使用されるコマンド）を準備する

$db->beginTransaction(); // $db->beginTransaction()を呼び出すことで、新しいトランザクションを開始。トランザクションは、一連のデータベース操作（挿入、更新、削除など）をまとめて実行するための仕組み。
//トランザクションを使用していない場合、各クエリは個別に実行され、それぞれが即座にデータベースに反映されます（エラーのもはDBには反映されない）。
//transactionを使用していた場合、一つでもエラーが発生すると、トランザクション内で実行されたすべてのクエリの変更は取り消されます（ロールバック）
//1つのクエリが失敗しても他のクエリには影響を与えない場合や、データベースの一貫性が保たれなくても問題ない場合は、トランザクションを使用する必要ない。

// テキストファイルを読み込んで辞書に挿入する
while (($line = fgets($fp)) !== false) {//fgets($fp) = $fpに入っているtxtファイルから一行読み込んで返すという作業をループ。
    //!== falseは値がfalseになるまでという意味。ファイルの終端に達した場合、fgetsはfalseを返ってくるので終了となる。
    list($title, $body) = explode("\t", $line, 2);//explode関数は指定した区切り文字（2）で文字列を分割し、配列として返す。
    //変数$lineに格納されている文字列をタブ(\t)で区切られている場所を見つけ、その結果を$titleと$bodyという変数に代入。タブ区切りが見つからない場合、結果は空で返される
    //ist($title, $body)はリスト代入と呼ばれる構文で、配列やオブジェクトの値を複数の変数に同時に代入するために使用。単純な文字列ではなく、配列などを入れるので注意
    if ($title === "") continue; // 空ならスキップ。exitではなくcontinue
 // データベースに挿入
    $insert_stmt->execute(array($title, $body));//executeは準備されたクエリ（prepareステートメント）を実行。
    //array($title, $body)は$title変数の値が?の位置に代入され、$body変数の値が2番目の?の位置に代入される。
    echo $title . "\n" . $body. "<br>"; // 経過報告を出力
}

$db->commit(); // トランザクションの変更を確定（コミット）し、それまでの変更をデータベースに反映させるメソッド
echo "*** completed ***";
?>