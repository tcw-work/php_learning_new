<?php

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
echo "合計は". ( ($apple * $apple_count) + ($banana * $banana_count) ) * $tax ."です";
//(())で計算式優先

?>