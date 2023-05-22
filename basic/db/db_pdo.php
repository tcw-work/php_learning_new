<?php
// データベースへの接続
try {//{}の中で処理が失敗したら、catch{}の中の処理を執行
    $db = new PDO("sqlite:test.db");//接続するDB指定（mysqlの場合はユーザー名やパスワードも必要）。もし指定されたパスにデータベースファイルが存在しない場合、new PDO()の呼び出し時に自動的にファイルが作成されます。
} catch (PDOException $e) {//↑が失敗したら実行する処理。tryにnew PDOを使う場合はPDOExceptionを使用しておく（でないとブラウザにPHPのエラーが直接出る）
    //$eは例外オブジェクトをキャッチした際に代入される変数（任意の文字）。PDOExceptionはデータベース接続時に発生する可能性があるいくつかのエラーをキャッチするために使用（エラーの詳細な情報を取得し、適切なエラーハンドリングを行うことができる）
    echo "データベースに接続できません。" . $e->getMessage();//getMessage()は例外のエラーメッセージを取得したり、エラーの特定が容易になるという意味で使用される
    //$eに格納されている例外オブジェクトのgetMessage()メソッドを呼び出して、該当の例外のエラーメッセージを取得する。
    exit;
}

// テーブルを作成する（この時点で実行はできない）。IF NOTを加えることでテーブルが存在していない場合の処理ができる（存在している場合はalerdy existと出る）
$create_query = <<< _SQL_
CREATE TABLE IF NOT EXISTS items (
    item_id INTEGER, /* 7174ID */
    name TEXT, /* 商品名 */
    price INTEGER /* 値段 */
);
_SQL_;

$result = $db->exec($create_query);//$dbに格納されているデータベースオブジェクトを参照し、exec()メソッドで$create_queryに格納されているsqlを実行。$resultには実行結果の行数や成功したかどうかの情報が格納
//↑この時点でsqlは実行される

if ($result === false) {//もし$resultの戻り値がfalseの場合。trueは基本的に行数（ステートメントの数）で帰ってくるが、失敗の場合はfalseで帰ってくる
    print_r($db->errorInfo());//print_rはechoとは異なり、変数の内容を文字列として直接表示するのではなく、変数のデータ構造を詳細に表示（配列の場合は[0] => apple、[1] => bananaなど）
    //errorInfor()メソッドは最後に実行されたデータベース操作のエラーに関する情報を取得するために使用される。データベース（$db）に関するエラー情報（errorInfor）へ->で参照
    exit;
}

$db->exec("DELETE FROM items");//新たなデータを挿入する前にitemsテーブルをリセットする（カラムは削除されずに行であるレコードが毎回削除される）

// 挿入するデータを連想配列として格納
$idata = array(
    array("item_id" => 1, "name" => "+", "price" => 150),
    array("item_id" => 2, "name" => "1", "price" => 300),
    array("item_id" => 3, "name" => "15", "price" => 270),
    array("item_id" => 4, "name" => "", "price" => 980),
    array("item_id" => 5, "name" => "", "price" => 210)
);

foreach ($idata as $i) {//foreachである分だけループ処理。$idataのデータを取り出して$iに格納
    //挿入する値をクォートする
    $item_id = intval($i["item_id"]);//$i($idata)の中のitem_idキーにアクセス
    $name = $db->quote($i["name"]);//nameを直接埋め込むと”もついてくるので、quoteメソッドでエスケープする
    // 文字列にクォート('...') を足す
    $price = intval($i["price"]);
    $result = $db->exec(//DBを参照し、下記のレコードを挿入（creatではなく）をループで実行
        "INSERT INTO items (item_id, name, price) VALUES ($item_id, $name, $price)"
    );

    if ($result === false) {
        print_r($db->errorInfo());
    }
}

// データを表示
$stmt = $db->query("SELECT * FROM items");//itemsテーブルの中身を参照
while ($row = $stmt->fetch()) {//$rowは結果を格納するためのもので、条件式とは無関係。$stmt->fetch()メソッドは、テーブルからレコード（行）を取得し、それを連想配列またはインデックス配列として返す。
    //もしループを使わずに$stmt->fetch()を実行すると、1回の実行では最初の行のデータしか取得できない。それを最初から最後まで繰り返すためにwhileループをかける
    //while文には> や < などの比較演算子などは必ずしも必要ではない。$stmt->fetch()のような単体処理もオッケー
    $item_id = $row["item_id"];//$rowを使用して取得したデータにアクセス
    $name = $row["name"];
    $price = $row["price"];
    echo "($item_id) $name → {$price}円\n";
}
?>