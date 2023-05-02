<h1>肥満度チェックツール</h1>

<ul>
	<li>pow() (2,3)2の3乗のようにべき乗して返す</li>
	<li>ceil() 小数点切り上げ</li>
	<li>floor() 数点切り捨て（floor(5410/100)で100の単位で切り捨て設定も可能＝結果3500）</li>
</ul>

<?php
if(isset($_GET["cm"]) && isset($_GET["kg"])) { //&&でissetを二つ書く
	$cm = floatval($_GET["cm"]);
	$kg = floatval($_GET["kg"]);
	$bmi = floor($kg / pow($cm / 100,2)); //関数の中でも関数を使用
	//	↑bmiの計算は体重÷身長（m）×身長（m）が必要。cmを100で割ってmに変換し、その後powで二乗する必要がある
//	$bmi = $kg / (($cm / 100) * ($cm / 100)); //こっちでも行けるが長くなる
	
	echo "身長{$cm}、体重{$kg}は、<br>";
	echo "BMIが{$bmi}です<br>";
	
	
	if ($bmi >= 24) {//$bmiが24と同等かそれ以上の場合
		echo "平均的なBMIよりも高めです。";
	}
	if ($bmi == 23) {//$bmiが23と同等の場合
		echo "平均的なBMIです。";
	}
	if ($bmi <= 22) {//$bmiが22と同等かそれ以下の場合
		echo "平均的なBMIよりも少なめです";
	}
} else {
	$self = $_SERVER["SCRIPT_NAME"]; //現在のページのURL
//	このURLをformにセットしておけば、URLやディレクトリが変わってもオッケー！
	echo "<form action='$self' method='GET'>";//↓formタグの中身をhtmlタグとして表示
	echo "<input type='text' name='cm'>cm";
	echo "<br>";
	echo "<input type='text' name='kg'>kg";
	echo "<br>";
	echo "<input type='submit' value='変換'>";
	echo "</form>";
}
?>