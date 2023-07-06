<?php

// $user_id = $_SESSION["login"]["user_id"];
// $stmt = $db->prepare("SELECT SUM(goods) as total_goods FROM favorites WHERE user_id = :user_id");//下記はuser_idを基にfavoriteテーブルの中のgoodsレコードの合計をsum関数で算出
// //AS total_goods の部分はエイリアス（別名）を設定。SUM(goods) の結果（つまり、goodsの合計値）を参照するための名前として total_goods を使う
// $stmt->bindParam(':user_id', $user_id); // ユーザーIDをバインド
// $stmt->execute();

// $result = $stmt->fetch(PDO::FETCH_ASSOC);
// $total_goods = $result['total_goods']; // 合計いいね数を取得

// echo "いいね獲得数「{$total_goods}」回達成！";



class GoodsCounter {//文言を使いまわせるようにクラスで作成しておく（）
    private $db;
    private $user_id;
    
    public function __construct($db, $user_id) {//インスタンス時に必ず行われる処理
        $this->db = $db;
        $this->user_id = $user_id;
    }

    public function getTotalGoods() {
        $stmt = $this->db->prepare("SELECT SUM(goods) as total_goods FROM favorites WHERE user_id = :user_id");//user_idを基にfavoriteテーブルの中のgoodsレコードの合計をsum関数で算出
        //AS total_goods の部分はエイリアス（別名）を設定。SUM(goods) の結果（つまり、goodsの合計値）を参照するための名前として total_goods を使う
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_goods'];
    }

    public function displayTotalGoods($messageFormat = "<p>いいね獲得数「%s」回達成！</p>") {//インスタンス作成後にこれを呼び出し（文言変更可能）
        $total_goods = $this->getTotalGoods();//上記メソッド呼び出し時にgetTotalGoods()も実行される
        echo sprintf($messageFormat, $total_goods);
    }
}

?>