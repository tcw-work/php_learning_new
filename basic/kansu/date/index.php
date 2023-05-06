<?php
date_default_timezone_set("Asia/Tokyo");// 冒頭でロケール設定。お作法として必ず書く、もしくは最初にphp.iniの中に設定するのが一般的
$now = time();// 現在時刻を取得(1970/1/1からの経過を秒で表示）
echo date("Y/m/d H:i:s",$now);//第二引数に$now（time関数）が入ってなくても現在時刻がデフォルトで入るが、あえて入れると明確に「現在時刻」を取得していることが明確になる
?>


<br><br><br>


<?php
date_default_timezone_set("Asia/Tokyo");
$now = time();

//下記でshow_divの関数に引数を設定して実行($str関数の中にdate()関数、その中に引数というイメージ)
show_div("red", date("Y/m/d", $now)); //2022/05/06
show_div("red", date("h:i:s", $now)); //03:28:15(※hを大文字にすると表示が15に変わる)
show_div("blue", date("Y年n月j日", $now)); //2023年5月6日※Yを小文字にすると表示が23に変わる)
show_div("blue", date("H時i分s秒", $now)); //16時36分18秒
//↓より特殊で詳細な書式
show_div("green", date("c", $now));
show_div("green", date("r", $now));

//↓曜日を配列で管理
$week = array("日","月","火","水","木","金","土");
show_div("red", $week[date("w", $now)]);//週番号（wが現在の州番号である配列を検知し、その番号を表示（土曜日なら6個目の土曜日表示）
show_div("red", date("w", $now));//週番号（月曜を1とした場合、土曜日は6で表示される

//実行する関数を設定
function show_div ($color, $str) {//↑上記で設定した第一、第二引数の値は$color, $strとしてセットされる
	$str = htmlspecialchars($str); //第二引数に入った値（日付）はサニタイジング
	echo "<div style='color: $color;'>$str</div>";
}
?>

<br><br><br>

<h2>メモ</h2>
date() strftime()も同じ効果で使える<br>
<?php
	echo date("Y/m/d H:i:s");
	echo "<br>";
	echo strftime("%Y-%m-%d %H:%M:%S");//iとsは正しい指定子ではないので、%Mを使って分を表示し、%Sを使って秒を表示する
?>