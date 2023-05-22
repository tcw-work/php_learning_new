<h1>ブラウザを叩くとDBにitemsテーブルが保存される</h1>
既にテーブルがある場合はエラーが出る
<br><br><br>

<?php
$db = new PDO("sqlite:test.db");//どのDBを開くか指定
$db->exec(//$db->exec() メソッドは、データベースに対して SQL ステートメントを実行するために使用。 INSERT、UPDATE、DELETE などの更新系のクエリを実行するために使用される。
    //オブジェクトのメソッドやプロパティにアクセスするために使用される演算子（お作法）
    "CREATE TABLE items(name,price)"//itemsというテーブルっ＋その中にnameとpriceのカラムを作成
);
$db->exec(
    "INSERT INTO items(name,price)".//itemsテーブルのnameとpriceに下記の値を挿入
    "VALUES('okasi',300)"
);

// itmesテーブルの内容を全て表示
$r = $db->query("SELECT * FROM items");//$db->query()はSELECT や他の結果セットを返すクエリを実行するために使用される。
while($i = $r->fetch()) {//fetch() は PDOStatement オブジェクトのメソッドであり、結果セットから1行ずつデータを取得するために使用される（結果は連想配列として返される）
    //ここでは$rに入っているitemsテーブルに対して一行ずつデータ取得
    echo $i['name']."--".$i["price"];//$i（テーブル）のnameキーの値を表示
    echo "<BR>";
}
?>