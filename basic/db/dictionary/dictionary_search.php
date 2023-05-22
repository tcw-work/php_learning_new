<?php
$db = new PDO("sqlite:ejdict.db"); // データベースに接続する
$script_name = $_SERVER["SCRIPT_NAME"];

$title = isset($_GET["title"]) ? trim($_GET["title"]): ""; //入力単語を得る（あるかないかを条件式で記入
//trim() 関数は、指定された文字列から先頭および末尾の空白（スペース、タブ、改行など）を取り除く関数

// 英単語の検索フォームを表示する
$title_html = htmlspecialchars($title);//サニタイジング
echo <<<_FORM_
<h3>英和辞書</h3>
<form action="$script_name" method="get">
    英単語: <input type="text" name="title" value="$title_html" />
    <input type="submit" value="検索" />
</form>
_FORM_;

// 検索するか?
if ($title != "") {//入力欄が空白ではなかったら
    $stmt = $db->prepare("SELECT * FROM words WHERE title LIKE ? LIMIT 20");//DBのwordテーブルへexcuteステートメント実行準備（LIKEはあいまい検索オプション）
    $stmt->execute(array($title. "%"));//実行。レコードには$title（入力された値）が入る。. "%"と上記のLikeを組合せることであいまい検索が可能になる
    foreach ($stmt as $row) {//foreachループで配列操作
        $word = htmlspecialchars($row["title"]);
        $body = str_replace("/", "\n", $row["body"]);
        $body = htmlspecialchars($body);
        $body = str_replace("\n", "<br/>", $body);//tr_replace( $検索文字列 , $置換後文字列 , $検索対象文字列)文字列置換
        echo "<h4>$word</h4><div class='body'>$body</div>";
    }
}
?>