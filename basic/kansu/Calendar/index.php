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
//下記のforの中で、1秒進めて「2023-05-01 00:00:00」を表すタイムスタンプを求めています。

for(;;) {//for(;;) は括弧の中を無限ループする。従来のfor($s_d=1; $s_d <=31; $s_d++)だと月によって29だったり30日までだったりするので、無限ループさせる。
//	これから表示するタイムスタンプの月
	$s_cur_moon = intval(date("m", $s_cur));//$s_curで出した2023年5月のタイムスタンプがdate()の第一引数"m"（月）によって「5」に変換
	$s_d = date("d", $s_cur);//$s_curで出した2023年5月のタイムスタンプがdate()の第一引数"d"（日）によって「01」に変換(その為にforで31まで無限ループさせてる)
	$s_cur += 24*60*60;//forの外側で書いたタイムスタンプを一日進める（2023-05-01 00:00:00）のタイムスタンプへとして生成。先ほどの$s_cur_moon = intval(date("m", $s_cur));は5月のタイムスタンプへとなる
	if ($s_cur_moon > $s_moon) break;//もしdate関数で取り出した$s_cur_moonの小数点切り捨てられた数字の月（5）が$s_moon（5）を超えるまで続く
	echo $s_d;
}
?>


<br><br><br>



<h2>5月のカレンダー(難しいバージョン)</h2>
<?php
showStyleTag();//ヒアドキュメントでstyleを書いた関数（後に記述）
$yotei = array(5=>"Aさん打合せ", 10=>"Bさんと打合せ"); //5と10の日付に予定を設定
showCalendar(2023,5, $yotei);//下記の自作showCalendar()関数を呼び出し。第1、2、3引数に入れる値も設定。

function showCalendar($year, $mon, $yotei) {//実行時に引数の値を入れると、下記の中身の値も変わる
	$week_list = array("日","月","火","水","木","金","土");//日～土までの日付を配列に格納
	$colors = array(0=>"#fff0f0", 6=>"#f0f0ff");//連想配列で0番と6番に色を付与
	$cur = strtotime("$year-$mon-1");//初日のタイムスタンプから－1を設定し、2023-04-30 23:59:59を表すタイムスタンプを生成
	echo "<table>";
	for(;;) {//for(;;)でbreakまで無限ループ
//		月番号、日付、曜日の取得
		$cur_mon = intval(date("m", $cur));//一番下で作成されたタイムスタンプを基に、月（5）を算出
		if ($cur_mon > $mon) break;//上記の5が引数で設定した$mon（5）より大きかったら処理をストップ
		$d = date("d", $cur);//が月の曜日（1）が生成されるが無限ループにより、31まで生成
		$w = date("w", $cur);//日～土までの曜日をを番号で取得
		$weekname = $week_list[$w];//$weeklistに入っている配列を$w（曜日番号）で指定し、64行目で呼び出し
		$color = isset($colors[$w]) ? $colors[$w] : "white";//$colors配列に入った番号が$W(曜日番号)と照らし合わせる。0もしくは6だったら$colorsの色を格納。それ以外の場合は白色で各j脳
//		予定がある場合
		$i =intval($d);//※$dの状態だと01、02...のように文字列型になっているので、連想配列と照会できない。なのでこれをinitvalで「1,23...」のように整数型に変換する必要がある
		$sc = isset($yotei[$i]) ? $yotei[$i] : "なし";//$yotei連想配列の中に1～31の数字でアクセ（ループ）し、数字合致したもの、してないものそれぞれ$scに入る
//		HTML出力
		echo "<tr style='background-color:$color'>";//連想配列に照らし合わせった結果の$colorがここに入る
		echo "<td>$d</td><td>$weekname</td>";//1～31をそれぞれ表示。連想配列に照らし合わせった結果の$weeknameがここに入る
		echo "<td>$sc</td>";//$yoteiの連想配列にアクセスした$i（1～31）と照らし合わせ、数字が重なれば予定として表示
		echo "</tr>";
		$cur += 24*60*60;//2023-04-30 23:59:59に一日＋することで、5/1のタイムスタンプを作成
	}
	echo "</table>";
}

function showStyleTag() {//cssをヒアドキュメントで表示
	echo <<<_STYLE_
	<style>
	table { border-top: solid 1px black; border-collapse: collapse; border-spacing: 0; }
	td { border-bottom: solid 1px black; padding: 6px; margin: 0; }
</style>
_STYLE_;
}
?>