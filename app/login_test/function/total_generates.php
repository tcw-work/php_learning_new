<?php

class GeneratesCounter {//文言を使いまわせるようにクラスで作成しておく
    private $db;
    private $user_id;
    
    public function __construct($db, $user_id) {//インスタンス時に必ず行われる処理
        $this->db = $db;
        $this->user_id = $user_id;
    }

    public function getTotalGenerates() {//インスタンス内での処理
        $stmt = $this->db->prepare("SELECT COUNT(favorite_id) as total_generates FROM favorites WHERE user_id = :user_id");//user_idと一致するfavorite_idをカウント
        $stmt->bindParam(':user_id', $this->user_id);//上記の:user_idに引数から取得したuser_idをバインド
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);//$resultは連想配列で、そのキーであるtotal_generatesにはSUM(favorite_id)が格納されている
        //$resultはfetchした結果なので、他のカラムは格納されていない（あくまでも今回のカウント処理だけ）
        return $result['total_generates'];//ここに格納された結果にreturnをつけることで、下記の呼び出しもと（関数外）で表示、利用できる
        //値をアクション実行ではなく、値を設定する場合は戻り値をつける（それ以外はtrueもしくは省略、falseでOK）
    }

    public function displayTotalGenerates($messageFormat = '<div class="side_childrens"><a href="profile.php" class="link">現在の保存履歴：%d個！</a></div>') {//インスタンス作成後に呼び出される処理
        //$messageFormat = "<p>自作回数：%d</p>"はデフォルト引数として設定しているので、呼び出しもとでは引数をセットしないようにする
        $total_generates = $this->getTotalGenerates();//getTotalGenerates();で作ったカウント結果を取得
        echo sprintf($messageFormat, $total_generates);//sprintf関数により$messageFormatの%d（sprintf関数の機能の一部で、書式指定子という）は$total_generates（カウント結果）に置き換わる
        //%dは%dは整数値を指す書式指定子で、sprintf関数はこの位置に$total_generatesの値を置き換える（他にも%s（文字列）、%f（浮動小数点数）などがある）
    }
}

?>