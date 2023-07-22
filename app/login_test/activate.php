<?php
require_once 'common/db.php';

$activation_key = htmlspecialchars($_GET["key"]);//urlからアクティベートキーを変数に格納

$query = "UPDATE users SET is_activated = 1 WHERE activation_key = :activation_key";//is_activated"フィールドの値を1に更新。WHERE～ではプレースホルダをセット
//WHERE activation_key = :activation_key はSET部分ををactivation_keyフィールドの値が$activation_key変数と一致する行に対して実行する。
$stmt = $db->prepare($query);
$stmt->bindParam(':activation_key', $activation_key);//activation_keyフィールドにURLの$activation_keyを代入（登録時と同じであればUPDATEの処理が走る）
$stmt->execute();

if ($stmt->rowCount() > 0) {//もし$stmtが1行以上に影響を及ぼしたら。rowCount()は最後に実行したSQLステートメントが影響を及ぼした行数を返す。
    //つまり、UPDATE、INSERT、または DELETE ステートメントの結果を返す・最後に実行したUPDATEクエリが1行以上のデータに影響を及ぼしたかどうかを確認
    echo "アカウントが有効化されました。";
    //ここからactivateキーを基にユーザー名を取得（session.phpに渡してログイン後に名前を表示するため）
    $query = "SELECT user_name FROM users WHERE activation_key = :activation_key";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':activation_key', $activation_key);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_name = $result['user_name'];

    $activate_message = "";//topへリダイレクトする際に、登録済みのパラメーターを持たせる
    header("location: index.php?activate_message=" . urlencode($activate_message));// ページをリロードする
} else {
    echo "有効化キーが無効です。";
}

if (isset($_GET['unique'])) {  // URLに'unique'パラメータが存在するか確認
    $user_id = $_GET['unique'];  // パラメータの値を変数に代入
}
require_once 'common/session.php';
session_login($user_id, $user_name);//パラメーターで渡されたユーザーIDをログイン時にセッションに保管（ログイン前後の画面だし分け）
//user_nameは代わりに空文字列を渡して無効にする
?>