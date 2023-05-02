<h1>年齢計算ツール</h1>


<?php
$i = 2;
while( $i <= 10 ) {//ループ処理の基本
	echo "({$i})";
	$i++;
}
?>
<br>
<br>

<?php
$date = date("y-m-d");
echo "今日は20{$date}です！<br>";
$date = date("y:m:d");
echo "今日は20{$date}です！";
?>
<br>
<br>


<form>
	<select name="year"><!--selectを使う場合optionで選んだ値がここに入る-->
		<option>西暦を選んでください</option>
		<?php
		$this_year = date("Y"); // 今年の値を取得する関数（y,m,dなどがある）
		$end_year = $this_year - 80; // 今年から80を引く=2023～1943年まで表示
		$y = $this_year; //whileループの内部では、$yを減算していくことで、選択肢の値が年を遡る$this_yearは常に今年の西暦を保持するために使用)
		while ($y >= $end_year) { //2023（y）が1943（end_year）より大きかったら、{ }の中を繰り返し処理（1943まで）
//			※whileは上記の条件が正しい間、処理を続けるので、無限ループに注意
			echo "<option value='$y'>西暦{$y}年</option>";//optionのvalueはselectの選択（name）として格納される
			$y--; // $y（今年）から1年ずつ減算
		}
		?>
	</select>
	<input type="submit" value="計算">

	<?php
	if (isset($_GET["year"])) { // selectの値がセットされていたら
		$age = $this_year - intval($_GET["year"]); // 2023-選んだ西暦が$ageに格納
		echo "今年" . $age . "才です。";
	}
	?>
</form>