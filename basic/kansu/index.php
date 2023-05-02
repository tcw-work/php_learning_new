<h1>インチからcm</h1>


<ul>
	<li>isset() セットされていたら</li>
	<li>floatval() 実数で小数点含めて出力</li>
	<li>initval() 整数の小数点切り捨て</li>
</ul>

<?php
if(isset($_GET["inch"])) { //フォームからinchが送信されたかを判定
	$inch = $_GET["inch"];
	$inch_v = floatval($inch);//時数に変更
	$cm = 2.54 * $inch; //入力した数字をcmに変換
	echo "<div>結果{$inch_v}インチ = {$cm}センチメートル</div>";
} else {
	$self = $_SERVER["SCRIPT_NAME"]; //このURLを取得
	echo "<form action='$self' method='GET'>";
	echo "<input type='text' name='inch'>";
	echo "<input type='submit' value='変換'>";
	echo "</form>";
}
?>