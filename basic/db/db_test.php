<html>

<head>
    <meta charset="utf-8" />
    <title>SQLFX</title>
</head>

<body bgcolor="#f8f0f0">// SQLの入力フォームを表示

    <h1>SQLiteデータベースファイルを使った実行テスト</h1>



    <?php
$query = isset($_GET["query"]) ? $_GET["query"] : "";
$q_html = htmlspecialchars($query);
echo <<< _FORM_
<form>
    <div>SQL文:</div>
    <textarea name="query" rows="5" cols="70">{$q_html}</textarea>
    <div><input type="submit" value="実行" /></div>
</form>
_FORM_;
// SQLを実行する
if ($query != "") {
    $db = new PDO("sqlite:test.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        // 実行して結果を表示する
        $html = $head = "";
        foreach ($db->query($query, PDO::FETCH_ASSOC) as $row) {
            if ($head == "") {
                $keys = array_keys($row);
                $head .= "<tr>";
                foreach ($keys as $c) {
                    $c_html = htmlspecialchars($c);
                    $head .= "<th>{$c_html}</th>";
                }
                $head .= "</tr>";
            }
            $html .= "<tr>";
            foreach ($row as $c) {
                $c_html = htmlspecialchars($c);
                $html .= "<td><pre>{$c_html}</pre></td>";
            }
            $html .= "</tr>\n";
        }
        echo "<p style=\"font-weight:bold; color: blue;\">実行しました</p>";
        echo "<table border=\"1\" bgcolor=\"#fff\" cellpadding='4'>";
        echo $head . $html;
        echo "</table>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<div style=\"color:red\">{$msg}</div>";
    }
}
?>
</body>


<h2>テーブルとカラム作成</h2>
<!-- 
    <p>
        CREATE TABLE test (<br>
        カラム名1 カラム型1,<br>
        カラム名2 カラム型2,<br>
        カラム名3 カラム型3<br>
        )
    </p> -->
<h3>ユーザー情報のひな形</h3>
<p>
    CREATE TABLE user (<br>
    user_id INTEGER,<br><!-- integerは整数 -->
    name TEXT,<br><!-- textは文字-->
    email TEXT,<br>
    memo TEXT<br>
    )
</p>

<h3>テーブルにデータを挿入</h3>
INSERT INTO user (user_id,name ,email)
VALUES(1,'taro','taro@example.com');
<!-- VALUES(2,'jiro','jiro@example.com'); -->

<h3>テーブルにデータを更新（既存のカラムのみ）</h3>
UPDATE user SET email='changed@example.com' WHERE user_id=2;
<br>
UPDATE テーブル名<br>
SET カラム='値' WHERE 条件式（user_id2など）;<br>


<h3>テーブルにカラムを追加</h3>
ALTER TABLE [テーブル1]
ADD [カラム1] [データ型] [NULL or NOT NULL];
<br>
ALTER TABLE items ADD review INTEGER NULL;


<h3>テーブル情報を確認</h3>
select * from sqlite_master;

<h3>テーブルの中身を表示</h3>
select * From user;

<h3>任意のデータを表示（抽出）</h3>
select * From user WHERE user_id=2;

<h3>ソート（大きい順）で検索</h3>
SELECT * FROM user ORDER BY user_id DESC LIMIT 2;
<!-- ①FROM chatlogはこのテーブルから ②ORDER BY log_idはログIDを基に ③DESCはソート（大きい順）に選択　④ESC LIMIT ”番号”で何件表示すか指定 -->



<h3>テーブル情報を削除</h3>
DROP TABLE user;

<h3>データを削除</h3>
DELETE FROM user WHERE user_id=1
<br>
DELETE FROM テーブル名 WHERE 条件式

</html>