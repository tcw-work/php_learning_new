<h1>引数付きで呼び出す場合</h1>

<?php
class Car { // 自動車クラス
    private $number;//下のメソッド内の$this->number = $number; から代入される
    //privateの場合、 $car->number = "あ12-34"; のようにクラス外からメンバへのアクセスはできない（これをカプセル化と呼ぶ）。
    //$this->number = $number; のようにクラスの内からのみアクセス可能（それがここに代入される）
    //ここでのprivateは、あっても無くても表示は変わらないが、合った方がどのような機能をサインをもっているのかが分かりやすくなる。つまりprivateを使う場合は引数を利用する
    private $speed;


    function __construct($number) {//インスタンス作成時に引数が渡される
        $this->number = $number;//ここでは $car =new Car("あ12-34"); から受け取った値が引数として代入される
        echo "{$number}のインスタンス生成 <br>";
    }

    // 走行メソッド
    function drive($speed) {
        $this->speed = $speed; //$car->drive(50); から受け取った値が代入される
        echo "「{$this->number}」が{$this->speed}km/hで走行<br>"; //$thisは自身のインスタンス（$car）内にあるプロパティを表す疑似変数（ここでは$car->number、$car->speed がそれに該当する）
        //メソッドにアクセスする際は上記のように書く
    }

    // 停車メソッド
    function stop() {
        echo "「{$this->number}」が停車<br>";
        $this->speed = 0;
    }
}
?>

<?php
$car =new Car("あ12-34"); //ここに引数をセットすれば、インスタンス作成時に「コンストラクタに$numberとして値」を渡せる。$car->number = "あ12-34";のようにプロパティへのアクセスを省略できる。
$car->drive(50); //メソッドへのアクセスの際に、$speedとして引数を渡すことができる。
$car->stop(); //主語と動詞のように「$carがstopする」といった「～の～」と覚えればオッケー

$car02 =new Car("い43-12");
$car02->drive(40);
$car02->stop();
?>