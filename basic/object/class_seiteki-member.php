<h1>静的メンバ</h1>
※インスタンスを作成せずに作成できるプロパティやメソッド<br><br>
※$serialはそれぞれのインスタンスが持つことになるが、$carNumberは1つしか存在せず、スクリプト内で共有される<br><br><br>



<?php
class Car {
    private $serial = 0; // 製造番号(インスタンスプロパティ)
    private static $carNumber = 0; // 生産台数の初期値 (静的プロパティ)。静的メンバの定義は頭にstaticを付ける

    function __construct() {
        //new Car()が呼び出されるたびに、Carクラスの新しいインスタンスが作成され、その都度、コンストラクタ(__construct())が自動的に呼び出されてインクリメントも行われる＋serialに代入される。
        //クラス外で静的メンバCar::showCarNumber()を呼び出すと、その時点での$carNumber（すなわち生産台数）が表示される
        self::$carNumber++; // 静的メンバの値（初期値0）をインクリメント
        $this->serial = self::$carNumber; // id を決める。インクリメントした値を$serialに代入
        //クラス内から静的メンバ（$carNumber）を呼び出すときは「self::」を付ける決まり
    }
    // 自動車の製造番号の表示(インスタンスメソッド)
    function showSerial() {
        echo "&nbsp;&nbsp; 製造番号: {$this->serial} <br>";
    }

    // 自動車の生産台数を求める (静的メソッド)
    static function showCarNumber() {//プロパティと同じく静的メンバの定義は頭にstaticを付ける
        $number = self::$carNumber;
        echo "生産台数: {$number}<br>";
    }
}

// 自動車の生産台数の表示
Car::showCarNumber();//静的メンバ（ここではメソッド）の呼び出しにはインスタンス作成は不要だが、クラス::メンバ名（メソッド）のようにして呼び出す決まりがある

// 1台目の自動車のインスタンス生成。それぞれが生存番号をもっている＋それは静的プロパティ（$carNumber）から作られている
$car1 = new Car();
$car1->showSerial();

// 自動車の生産台数の表示
Car::showCarNumber();//インスタンスを作らずに静的メンバの呼び出し

// 3台目の自動車のインスタンス生成
$car2 = new Car();
$car2->showSerial();

$car3 = new Car();
$car3->showSerial();

// 自動車の生産台数の表示
Car::showCarNumber();//インスタンスを作らずに静的メンバの呼び出し

?>



<ul>
    <li>①つまり三回のインスタンス作成処理が行われるため、このコンストラクタもその都度処理が行われる。</li>
    <li>②インスタンスそれぞれが処理を行うが、クラス内に書かれた処理内容は共有されている</li>
    <li>③そのため各々が全体を通したクラス内の処理結果を表示できる。インスタンスはそれぞれ独立した$serialプロパティ（製造番号）を保持する</li>
    <li>④プロパティである$carNumberはここまでの値を保持しているため、静的メソッド「Car::showCarNumber()」を呼び出すと、全ての処理が終わった後の結果ではなく、その時点までの結果（生産台数）を返す。
    </li>
    <li>※privateでカプセル化された $carNumber をクラス外からプロパティ値を変更したり、直接表示することは不可能だが、それを使った使った静的メソッドは表示できる（引数も設定可能）</li>
</ul>