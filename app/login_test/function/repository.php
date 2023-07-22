<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include '../common/db.php';
require_once '../common/session.php';//ログインID確認用。本番アップ前にユーザーIDは非表示にする

//SQL実行準備//$db（PDOインスタンス）は関数内のスコープ内からアクセスできないので、引数として値を渡す（基本的に関数内からは外部の変数にアクセスできない）
$keyword = "";
if(isset($_GET["keyword"])) {
    $keyword = htmlspecialchars($_GET["keyword"]);//inputから送られてきたデータをサニタイジング
}
$stmt = $db->prepare("SELECT item, MIN(favorite_id) as favorite_id FROM favorites WHERE item LIKE :keyword GROUP BY item");//itemデータ取り出し

//MIN(favorite_id) AS favorite_id は favorite_id（数字）列の最小値（一番若い番）を選択し、その結果を favorite_id という名前で取得する。
//MIN(favorite_id)のみだと、後の$result['favorite_id']が$result['min_favorite_id]という名前で保管され、ややこしくなるので、favorite_idという元の名前を新しく作る形になっている
//GROUP BYはitemカラム全体をグループ化する。item カラムの値が同じレコードを1つのグループと見なす。そしてそのグループの中で favorite_id の最小値（つまり、MIN(favorite_id)）を取り出す。
//keywordはプレースホルダでありSQL文を準備する際に具体的な値に置き換えられる予定（これはSQLインジェクションといった攻撃から保護するための一般的な方法で、プレースホルダを安全な方法で具体的な値に置き換える）

$stmt->bindValue(':keyword', '%' . $keyword . '%');//bindValueメソッド内で%記号がキーワードの前後にあるのは、キーワードが文字列の任意の位置にある場合に一致するという条件を設けているため（%はワイルドカードと呼ぶ）
//例えば「abc%」とすると、abcで始まる任意の文字列と一致、「%abc」とすると、abcで終わる任意の文字列と一致する。ワイルドカードの位置によって検索条件を柔軟に制御できる
//bindValue()メソッドはSQL文の中のプレースホルダ（:keywordなど）に値をバインド（結びつけ）するためのもの。プリペアドステートメントと一緒に使われる。
$stmt->execute();//sql実行
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetchして全レコード抽出


//selectしたデータをループで表示する
$script = $_SERVER["SCRIPT_NAME"]; // このPHPファイルのパス
echo '<form action="function/repository_save.php" method="POST" class="myForm">';//action属性に変数セットする時の書き方　"' . $script . '"
if (empty($results)) { // $resultsが空の場合（結果が0の場合）
    header("location: ../record.php?correct_message=". urlencode("結果が見つかりませんでした。"));
} else {
    foreach ($results as $result) {//DBから抽出したキーワードを含む全レコードに対してループを掛けてある分だけだす。foreach(変数, 代入される配列変数)で配列の要素を一つずつ順番に取り出す
        echo '<input type="checkbox" name="save_items[]" value="'.$result['item'].'">'; // 保存用に送るチェックボックスを表示。
        //name属性に[]を追加することで、複数選択が可能なチェックボックスを作ることができる（後にsave_itemsはforeachループで処理する）
        $_SESSION['favorite_id'][$result['item']] = $result['favorite_id']; // セッションにfavorite_idの値を保存
        echo $result['item'] . '<br>';
        echo $result['favorite_id'] . '<br>';
    }
    echo '<input type="submit" name="save_button" value="選択したアイテムを保存">';// 保存ボタンを表示
}
echo '</form>';
?>