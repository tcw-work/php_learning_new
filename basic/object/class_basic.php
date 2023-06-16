<?php
class Car { // 自動車クラス
    public $speed; // スピードのプロパティ
    public $number; // ナンバーのプロパティ
    //publicはメンバへクラスの内外からアクセス可能

    // コンストラクタ。インスタンス作成時に一度だけ呼び出される（インスタンスの初期化処理を行う）
    function __construct() {
        echo "インスタンス生成 <br>";
    }

    // 走行メソッド
    function drive() {
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
$car =new Car(); //インスタンス作成
$car->number = "あ12-34"; //ナンバー設定（クラス内でpublicで定義しているので、ここからプロパティにアクセス可能）
$car->speed = "100"; //スピード設定
//プロパティへのアクセスにはアロー演算子を使う（アクセスするメンバの$は不要）
$car->drive(); //メソッドを呼び出すと上記で設定した変数の値が「$this->number」として代入される
$car->stop(); //主語と動詞のように「$carがstopする」といった「～の～」と覚えればオッケー

//ひとつのクラスからインスタンスを複数作ることで、プロパティとメソッドを使いまわして異なる操作が可能
//これをclassを使わずに行うと、複数のへんすうや関数を作成しなければならないので、それを簡略化できる
$car02 =new Car();
$car02->number = "い43-12";
$car02->speed = "40";
$car02->drive();
$car02->stop();
?>