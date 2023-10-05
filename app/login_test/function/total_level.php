<?php
//検証用
// require_once '../common/db.php';
// require_once '../common/session.php';
// $user_id = $_SESSION["login"]["user_id"];

function total_level($db, $user_id) {
// DB接続
// global $db;//pdo接続のための変数をグローバル化
try {//tryにより、この中で一つでも処理にエラー（例外）があれば、catch で変わりの処理をする（例外処理）
    // トランザクション開始
    $db->beginTransaction();//$db->commit();までDB操作は保留になる
    //もし一つの処理が成功しても別の箇所で失敗が出たら、その両方ともDBに入ってしまうので、処理が成功するまでDB繁栄は保留にする

    // 現在のユーザーレベルを取得
    $stmt0 = $db->prepare("SELECT user_level FROM users WHERE user_id = :user_id");//ユーザーレベルをセレクト
    $stmt0->bindParam(':user_id', $user_id, PDO::PARAM_INT);//idをバインド
    $stmt0->execute();
    $result0 = $stmt0->fetch(PDO::FETCH_ASSOC);//fecthして配列保存
    $current_level = (int)$result0['user_level'];//$result0['user_level'] を参照すると、選択したユーザーの level 値を取得

    // favorite_idのカウント
    $stmt1 = $db->prepare("SELECT COUNT(favorite_id) as count FROM favorites WHERE user_id = :user_id");//user_idと一致するfavorite_idをカウント
    $stmt1->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt1->execute();
    $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $favorite_id_count = (int)$result1['count'];//favorite_idをカウントした合計値が配列に保存、$favorite_id_count変数化
    
    // Level count ロジック。 favorite_idカウントによるレベルの計算
    $count1 = min($favorite_id_count, 9);//favorite_idのカウント数と9のうち、小さい方を$count1に代入する

    // goodsのカウント
    $stmt2 = $db->prepare("SELECT SUM(goods) as count FROM favorites WHERE user_id = :user_id");
    $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt2->execute();
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $count2 = (int)$result2['count'];

    // 新しいレベルの計算
    $new_level = max($current_level, $count1 + $count2);//$current_levelか自作＋コピーの合計で大きい方を代入
    // $count1 + $count2は、レベル9以降だと$current_levelよりも大きくなるので、その値を下記でレコードにアプデし、その値が再び$current_levelに回ってくる
    //なのでレコードをfavorite_id、goodsレコードを消してもレベルは下がらない

    // user_levelカラムの更新
    $stmt3 = $db->prepare("UPDATE users SET user_level = :level WHERE user_id = :user_id");//ユーザーレベルをアップデート
    $stmt3->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt3->bindParam(':level', $new_level, PDO::PARAM_INT);
    $stmt3->execute();

    // トランザクション完了（コミット）
    $db->commit();//全ての処理が成功されたら、ここでＤＢを更新

    // 結果の出力
    echo '<div class="side_childrens"><p>レベル' . $new_level . '到達！</p></div>';
} catch (Exception $e) {//catchブロックではExceptionオブジェクト（ここでは$e）を引数に取る（お作法）
    // エラーが発生した時はロールバック
    $db->rollBack();//もしＤＢ更新処理でのエラーが発生したら、エラー表示
    echo "Failed: " . $e->getMessage();
}
}

?>