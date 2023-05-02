<h1>インチからcmに変換</h1>


<ul>
	<li>isset() セットされていたら</li>
	<li>floatval() 実数で小数点含めて出力</li>
	<li>initval() 整数の小数含めずに出力</li>
</ul>

<?php
if(isset($_GET["inch"])) { //フォームからinchが送信されたかを判定
	$inch = $_GET["inch"];
	$inch_v = floatval($inch);//時数に変更
	$cm = 2.54 * $inch; //入力した数字をcmに変換
	echo "<div>結果{$inch_v}インチ = {$cm}センチメートル</div>";
} else {
	$self = $_SERVER["SCRIPT_NAME"]; //現在のページのURL
//	このURLをformにセットしておけば、URLやディレクトリが変わってもオッケー！
	echo "<form action='$self' method='GET'>";//↓formタグの中身をhtmlタグとして表示
	echo "<input type='text' name='inch'>";
	echo "<input type='submit' value='変換'>";
	echo "</form>";
}
//※GETメソッドで送信したときは内容がURLにパラメーターとして表示される（POSTは表示されない）
?>