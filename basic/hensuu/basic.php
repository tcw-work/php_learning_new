<?php
echo "<h2>変数と計算</h2>";

$price = "3000";
$price02 = $price * 1.10;
echo $price;
echo "<br/>";
echo $price02;
echo "<br/>";

$price = "4000(3000の値に再代入)";
echo $price;
echo "<br/>";

$renkei01 = "この文字と";
$renkei02 = "この文字を";


echo $renkei01.$renkei02."連携しています。";
echo "<br/>";

echo "{$renkei01}{$renkei02}連携しています。({}で変数を括るバージョン)";
echo "<br/>";

$apple = 160;
$apple_count = 3;
$banana = 120;
$banana_count = 6;
$tax = 1.10;
echo "合計は". ( ($apple * $apple_count) + ($banana * $banana_count) ) * $tax ."です<br/><br/>";
//(())で計算式優先

echo "<h2>変数の代入</h2>";

$v = 100;
echo "代入前の数字{$v}<br/>";

$v = 100 + 50;
echo "代入後の数字{$v}<br/>";

$v = 100 + 10;
echo "再代入後の数字{$v}<br/>";

echo "代入を繰り返しても「変数＄v」のもともとの数字は100として扱われる<br/><br/>";


echo "<h2>インクリメント優先順位</h2>";
$a = 10;
echo ++$a;//この時点で値が変更
echo "<br/>";
echo $a;
echo "<br/>";
$b = 20;
echo $b++;//この時点では値が変更されていない（代入中）
echo "<br/>";
echo $b;


echo "<h2>インクリメント応用</h2>";
$c = 10;
echo $c + 20;//ベーシックな書き方
echo $c +=20;//省略記法
echo "<br/>";
$d = 10;
echo $d * 2;//ベーシックな書き方
echo $d *=2;//省略記法
echo "<br/>";
$e = 500;
$f = "yen";
echo $e . $f;//文字列と値を合わせるときは「.」を使う
?>
