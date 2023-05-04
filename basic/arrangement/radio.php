<h2>連想配列テスト</h2>
<?php
$colors = array(
	"red" => "#FF0000",
	"blue" => "#000FF",
	"green" => "#00FF00"
);
foreach ($colors as $name => $code) {
	echo "$name = $code<br>";
}
?>
<br><br><br>

<h2>関数を組み合わせたラジオボタン</h2>
※グローバル変数は基本的に使用されていないので、関数内で定義されたローカル変数がそれぞれの関数内で書き換わっている
<br><br>

<?php //関数を実行
Show_header();
Show_form();
?>

<?php
function Show_header() {
	$color = "#FFFFFF"; //デフォルト白(ローカル変数)
	if(isset($_GET['color'])) {//もし色の入った値を受け取ったら（デフォルトで白が入ってるので、elseはいらない）
		$color = htmlspecialchars($_GET['color']); //受け取った値をサニタイジングして$colorに上書き
	}
	echo "<html><body bgcolor ='$color'>"; //ローカル変数として、bodyのバックグラウンドカラーに代入
	echo "</body></html>";
}
?>

<?php
function Show_form() {
$colors = array(//連想配列で色とカラーコードを紐づけ
	"赤" => "FF0000",
	"水色" => "00FFFF",
	"白" => "FFFFFF",
);
	echo "<form>";
	foreach ($colors as $name => $color) {//$colorsに入った連想配列を$nameに変換し、カラーコードは$colorと命名(ローカル変数)
		echo create_radio_code($name, $color);//下で作った関数の中に色名とカラーコードの入った変数を引数として代入
	}
	echo "<input type='submit' value='色変更'>";
	echo "</form>";
}
?>

<?php
function  create_radio_code($name, $code) {//関数を呼び出すときに$nameと$codeに引数をセットすれば下記の変数の値もそれに変わる ※$codeには上記で$colorが代入される
		return <<< __RADIO__
			<input type="radio" id="$name" name="color" value="$code"><!--ラジオボタンのname属性は必ず同じものでなければならない（でないと選択肢として認識されない）-->
			<label for="$name">$name</label><!--ラジオボタンとlabelのidとforは統一されている必要がある-->
		__RADIO__;
	}
?>
