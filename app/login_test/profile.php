<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include 'db.php';

session_start();// セッションを開始する
if (isset($_SESSION['login'])) {
    if (isset($_POST['logout'])) {
        unset($_SESSION['login']);
        header("Location: $script"); // ログアウト後にページをリダイレクト（これが無いとリロードすると何も表示されなくなる）
        exit();
    }
    echo 'UserID: ' . $_SESSION["login"]["user_id"] . '<br>'; // セッションIDとユーザーIDがリンクしているかを表示して確認
    echo '<p>ログイン中です</p>';

//-----テーブルデータへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
$user_id = $_SESSION["login"]["user_id"];//userのユニークIDを変数化
$query = "SELECT * FROM favorites WHERE user_id = '$user_id'";// テーブルから該当するuser_idのレコードを取得
$result = $db->query($query);//sql実行

// 結果を出力。条件満たすまで（DBから対象のカラムを全部取り出し、falseが帰ってくるまで）ループ
function session_part_01($result) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {//fetch() は結果セット（先ほどのIDに連なるカラム）から1行ずつデータを取得するために使用される。結果としてほしいカラムを抽出できる（結果は$rowに全て保存）
       //取得したらfetch関数は次の行に進む。もし取得できる行がなくなった場合、fetch関数はfalseを返すため、ループは終了となる（whileには必ずしも比較演算子は必要ない）。
        echo "お気に入りID: " . $row['favorite_id'] . "<br>";//$row連想クエリの結果セットの各行が連想配列として格納されるので、favorite_idを連想配列のキーとして呼び出す
        echo '<input type="checkbox" name="delete_items[]" value="' . $row['favorite_id'] . '">'; // 削除用のラジオボタンを表示
        echo "・" . $row['item'] . "<br>";
        echo "<br>";
        echo "<br>";
    }
}

$script = $_SERVER["SCRIPT_NAME"]; // このPHPファイルのパス
echo '<form action="' . $script . '" method="POST">';//action属性に変数セットする時の書き方　"' . $script . '"
session_part_01($result);//ループ処理呼び出し
echo '<input type="submit" name="delete_button" value="選択したアイテムを削除">';// 削除ボタンを表示
echo '</form>';


// 削除ボタンが押された場合の処理
if (isset($_POST['delete_button'])) {//値の入ったボタンがセット（クリック）されていたら
    if (isset($_POST['delete_items'])) {//ラジオボタンの値がセット（クリック）されていたら
        $delete_items = $_POST['delete_items'];//POSTで送られてきたdelete_itemsという値（$row['favorite_id']でアイテムIDが入っている）

        // 選択されたアイテムを削除
        foreach ($delete_items as $favorite_id) {
            $delete_query = "DELETE FROM favorites WHERE favorite_id = '$favorite_id'";
            $db->exec($delete_query);
        }

        echo "選択したアイテムを削除しました。";
        // ページをリダイレクトしてキャッシュを避ける
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}



}
?>