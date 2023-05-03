<h1>訪問者に毎回違う回答を返す</h1>
<br><br>


<h2>swich文で書いた場合</h2>
<?php
$num = rand(1,5);
switch ($num) { //ここにはrand(1,5)をいれてもいい。値によって分岐
	case 1:
		$msg = "へっ！";
		break;//breakを毎回書かないと、その下の処理も実行される
	case 2:
		$msg = "よっ！";
		break;
	case 3:
		$msg = "ども！";
		break;//最後にbreakとdefaultを置くのはお作法
	default://4,5をその他とする場合
		$msg = "オッス！";
}
echo $msg;
?>


<br><br>


<h2>if文で書いた場合</h2>
<?php
$num = rand(1,5);
if ($num == 1) {
	$msg = "へっ！";
} else if ($num == 2) {
	$msg = "よっ！";
} else if ($num == 3) {
	$msg = "ども！";
} else {
	$msg = "オッス！";
}
echo $msg;
?>

<br><br>
※「$msg」に画像のパスを入れてimgのsrcに変数を入れて毎回違う画像を表示させることも可能