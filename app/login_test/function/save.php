<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include '../common/db.php';

include 'item_check.php'; // itemの重複チェックファイルをインクルード

//-----セッション参照-----------------------------------------------------------------------------------------------------------------------------------------------------------
session_start();// セッションを開始する
if (isset($_SESSION['login'])) {
    if (!isset($_POST['logout'])) {
        // echo 'SessionID: ' . $_SESSION["login"]["user_id"] . '<br>'; // セッションIDとユーザーIDがリンクしているかを表示して確認
    }
}

//-----テーブルを作成-----------------------------------------------------------------------------------------------------------------------------------------------------------
$create_table = <<<_TABLE_
CREATE TABLE IF NOT EXISTS favorites (
    favorite_id INT AUTO_INCREMENT PRIMARY KEY, /* お気に入りレコードの一意のID （ユニークな値で自動的に生成される） */
    user_id TEXT, /* ユーザーID（紐づけ） */
    item TEXT, /* お気に入りアイテム */
    good TEXT /* いいね数 */
);
_TABLE_;
$db->exec($create_table);

//-----保存処理-----------------------------------------------------------------------------------------------------------------------------------------------------------

if (isset($_SESSION['login'])) {
        $item = rtrim(htmlspecialchars($_GET["complete"]));//語尾に空白文字があった場合は削除
        $user_id = $_SESSION["login"]["user_id"];

        $count_query = "SELECT COUNT(*) FROM favorites WHERE user_id = '$user_id'";//sessionからuser_idを参照してfavaritesテーブルを選択
        $count_result = $db->query($count_query)->fetchColumn();//dbからクエリぞ実行。PDOStatementオブジェクトのfetchColumnメソッドは、次の行から単一のカラムをす
        //fetchColumn()は本来一つの値（結果）しか取得できないが、select文によって特定のuser_idを持つレコードが指定されている。その結果、そのIDを持つ複数のレコード（select部分）を一つの結果（fetchColumn）として返している

        if ($count_result >= 20) {//カラムの合計が20以上の場合
            echo 'アイテムの保存上限に達しています。これ以上は保存できません。';
            return;
        } 
        if (isItemSaved($db, $user_id, $item)) {//「もし$db, $user_id, $itemの組み合わせが既にデータベースに存在するなら…（item_check.php）
            echo "既に{$item}は保存されています。";
            return;
        }
        $insert_query = "INSERT INTO favorites (user_id, item) VALUES ('$user_id', '$item')";// データの挿入クエリ
        $result = $db->exec($insert_query);// 挿入クエリを実行
        echo "{$item}を保存しました";

} else {
    echo '保存するにはログインするか、新規登録を行ってください。';
}

?>