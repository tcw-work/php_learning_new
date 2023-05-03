<h1>関数・引数の使い方</h1>


<?php
function tashizan( $a, $b ) {//引数を指定
	$result = $a +$b; //指定した引数をどう使うかを定義する
	return $result; //関数の戻り値
}
echo tashizan( 3, 5 ); //引数の数字を入れて関数呼び出し
?>


<?php
function te2 ($v) {
	return ($v * $v);
}
echo te2(5); //上記で定義した「関数te2()」の引数に5を外で指定することで引数$vに5入る。そしてreturnの中も5×5になる
?>