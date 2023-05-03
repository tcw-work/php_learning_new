
<h1>数字ジェネレーター</h1>

<?php
switch ( rand(1, 5) ) {//rand関数で1～5の間でランダムな数字を出す
	case 1: //条件が1の時
		echo "ケース1";
		break;//breakを毎回書かないと、その下の処理も実行される
	case 2:
		echo "ケース2";
		break;
	case 3:
		echo "ケース3";
		break;
	default: //4,5をその他とする場合
		echo "その他";
}
?>

<br><br>

<?php
$r = rand(1,6);
if ($r %2 == 0) { //「3 % 2 = 1」のように2で割り切れるかを判定
	$msg = "サイコロの目は偶数";
} else {
	$msg = "サイコロの目は奇数";
}
echo "$r ( $msg )";
?>


<br><br>


<?php
for ($i = 1; $i <= 10; $i ++) {//forとrandを組み合わせればランダムな生成が可能
	echo "ランダム数字". rand(1000,9999);
	echo "<br>";
}
?>








































