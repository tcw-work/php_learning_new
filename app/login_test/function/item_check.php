<?php
// 既に同じアイテムが保存されているかどうかを確認する関数
function isItemSaved($db, $user_id, $item) {//呼び出しもとでこの三つが揃ってる必要がある
    $check_query = "SELECT COUNT(*) FROM favorites WHERE user_id = ? AND item = ?";//user_idとitemが一致する全てのレコードを抽出
    //COUNT(*)関数は、全ての列（*）に対して適用され、一致するレコードの数を返す
    $stmt = $db->prepare($check_query);
    $stmt->execute([$user_id, $item]);//selectのプレースホルダに代入。execute メソッドは新しい配列を作成し、それに$user_idと$itemの値を順に格納
    $count = $stmt->fetchColumn();//fetchColumn();をつかうことで、selectで取得した（該当する）全レコードを一つの結果として返す
    return $count > 0;//$countが0より大きい場合、trueを返す（呼び出しもとでこの結果を使えるようにする）
}
?>