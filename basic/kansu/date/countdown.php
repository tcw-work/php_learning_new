<h2>カウントダウン</h2>


<?php
//strtotime(日時文字列)
$t = strtotime("2023-07-24");//strtotimeは特定の日時のエポックタイムスタンプ（Unixタイム）に変換
echo date("Y/m/d");
echo "<br><br>";
echo date("Y/m/d", $t);
?>

<br><br><br>


<?php
//mktime(時,分,秒,月,日,年)
$m = mktime(0, 0, 0, 7, 24, 2020);//より詳細にタイムスタンプを作成
echo date("Y/m/d");
echo "<br><br>";
echo date("Y/m/d", $m);
?>

<br><br><br>
<h2>strtotime()は相対的な指定も可能</h2>
<?php
$k = strtotime("next friday", time()); //第一引数には数字ではなく文字列での指定もできる。第2引数にtime()関数を渡すことで、現在時刻を基準として指定した日付や時間を取得することができます。
echo "次の月曜日は". date("Y/m/d", $k); //$kに代入されたUnixタイムスタンプを、"Y/m/d"のフォーマットで表示
?>


<h2>カウントダウン</h2>
<?php
$stamp = strtotime("2033/12/31");//この時点ではまだ秒で算出されている（作成時2019596400秒→1970/1/1から）
$now = time();//現在のタイムスタンプ
$stamp02 = $stamp - $now;//未来のタイムスタンプから現在のタイムスタンプを引いて差分を出す(336216926秒)
$days = ceil($stamp02 / (24*60*60)); //一日（24*60*60＝86400秒）を予定日までの日数（$stamp2→336216926秒）で割れば「3891.39960648日」になる＋ceil関数は端数（小数点）の切り上げ。
echo "2033年12月31日まであと{$days}日";
//echo $stamp;
//echo $stamp02;
?>

