<h2>配列とdate()を使った実験</h2>
<?php
$list = array(0=>"red", 6=>"green"); //日曜日なら=0なのでグレイ、土曜日なら=6でブルー（今回は1～5は下記でその他という扱いになる）
$w = intval(date("w"));//date関数に"w"を引数として入れると、現在の曜日を1～6で取得（日曜は0、月曜は1...）
$color = isset($list[$w]) ? $list[$w] : "blue"; //ifの代わりに三項演算子（条件式 ? 式1 : 式2）。
//↑$list[]で配列の中にアクセス。$wには曜日別の番号をdate()で取得しているので、その番号が連想配列の中の番号とマッチしたものが=色が$colorに入る。当てはまらなければ白色。
echo "<body style='color:$color;'>";
echo date("Y/m/d(1)");
echo "</body>";
?>
<br><br><br>


<h2>※カレンダーは複雑</h2>
<br><br><br>


<h2>5月のカレンダー(簡単バージョン)</h2>
<?php
$s_year = 2023;
$s_moon = 5;
$s_cur = strtotime("$s_year-$s_moon-1");//初日のタイムスタンプ。「1682892000」のように秒で出る。つまり、2023-04-30 23:59:59」を表すタイムスタンプが生成される。
//↑その後、1秒進めて「2023-05-01 00:00:00」を表すタイムスタンプを求めています。

for(;;) {//for(;;) は括弧の中を無限ループする。従来のfor($s_d=1; $s_d <=31; $s_d++)だと月によって29だったり30日までだったりするので、無限ループさせる。
//	これから表示するタイムスタンプの月
	$s_cur_moon = intval(date("m", $s_cur));//$s_curで出した2023年5月のタイムスタンプがdate()の第一引数"m"（月）によって「5」に変換
	$s_d = date("d", $s_cur);//$s_curで出した2023年5月のタイムスタンプがdate()の第一引数"d"（日）によって「1～31」に変換(その為にforで無限ループさせてる)
	if ($s_cur_moon > $s_moon) break;//もしdate関数で取り出した$s_cur_moonの小数点切り捨てられた数字の月（5）が$s_moon（5）を超えたら終了
	$s_cur += 24*60*60;//forの外側で書いたタイムスタンプを一日進める（2023-05-01 00:00:00）のタイムスタンプへとして生成。先ほどの$s_cur_moon = intval(date("m", $s_cur));は5月のタイムスタンプへとなる
	echo $s_d;
}
?>


<br><br><br>



<h2>5月のカレンダー(難しいバージョン)</h2>
<?php
//showStyleTag();
$yotei = array(5=>"Aさん打合せ", 10=>"Bさんと打合せ");
//showCalendar(2023,5, $yotei);
function showCalendar($year, $moon, $yotei) {
	$week_list = array("日","月","火","水","木","金","土");
	$colors = array(0=>"#fff0f0", 6=>"#f0f0ff");
	$cur = strtotime("$year-$moon-1");//初日のタイムスタンプ
	echo "<table>";
	for(;;) {
		
	}
	
	
	echo "</table>";
}
?>