<h1>継承</h1>

<?php
// 計算クラス (足し算・引き算しかできない)
class Calc {
    // 数値1
    protected $num1;//protected修飾子は外部からのアクセスは不可だが、子クラスからはアクセス可能にする
    // 数値2
    protected $num2;

    // 値の設定
    function setNumbers($num1, $num2) {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    // 足し算の結果表示
    function add() {
        $ans = $this->num1 + $this->num2;
        echo "{$this->num1} + {$this->num2} = {$ans}<br>";
    }

    // 引き算の結果取得
    function sub() {
        $ans = $this->num1 - $this->num2;
        echo "{$this->num1} - {$this->num2} = {$ans}<br>";
    }
}

// 拡張計算クラス (掛け算・割り算もできる)
class CalcEx extends Calc {//class 子クラス extend 親クラス　でsetNumbers、add,subメソッドを継承（ここでは主にsetNumbers()の値を継承）
    // 掛け算の結果表示
    function mul() {
        $ans = $this->num1 * $this->num2;
        echo "{$this->num1} × {$this->num2} = {$ans}<br>";
    }

    // 割り算の結果取得
    function div() {
        $ans = $this->num1 / $this->num2;
        echo "{$this->num1} ÷ {$this->num2} = {$ans}<br>";
    }
}

// インスタンスの生成
$calc = new CalcEx(); // CalcExクラスのインスタンス生成

// 値の設定
$calc->setNumbers(12, 3);

// 加減乗除の計算の実行
$calc->add(); // 加算 (Calcクラスのメソッド)
$calc->sub(); // 減算 (Calcクラスのメソッド)
$calc->mul(); // 乗算 (CalcExクラスのメソッド)
$calc->div(); // 除算 (CalcExクラスのメソッド)

?>