<h1>qrコード作成</h1>


<?php
//パラメータが送信されているかチェック
$param = "";//$_GET["param"]が定義されていない場合、$param変数は自動的に定義されず、PHPエラーが発生する可能性があるので、空の場合を定義。下記のif文にelseとして入れてもよい。
if (isset($_GET["param"])) $param = $_GET["param"]; //if文が単一であればこのように括弧を省略できる
//パラメーターによって条件分岐
switch( $param ) { //"param"に入っている文字は上記で$param変数にセットされている。「$param = "";」がなければ、そもそも変数が存在しないと判断されエラーが発生する
	case "big-qrcode": //big-codeという文字がparamに格納されていたら
		show_qrcode(300); //show_qrcodeという関数に引数300をセットして実行
		break;
	case "small-qrcode":
		show_qrcode(150);
		break;
	default:
		show_form();//デフォルトではformが表示される
		break;
}
//上記で表示するための関数設定
function show_qrcode($size) {
	$url = urlencode($_GET["url"]);//inpuで入力したurlを「%3A%～～」のようにエンコードして下記のAPIurlのパラメーターとして使用。パラメーターには://が使えないのでためエンコードする必要がある。
	$api = "https://chart.apis.google.com/chart?cht=qr&"; //google chart APIによってグラフ作成が可能。変数として格納
	$src = $api."chs={$size}x{$size}&chl={$url}";//上記のAPIにパラメーターとしてサイズを付ける。エンコードしたurlが入った変数（$url）も最後に加える
	echo "<img src='{$src}'>";//上記の表示したいサイトのurl（パラメーター）が入った状態のAPIurl（$srcという変数）をimgのリンクとして入れる → APIの機能としてQRコードが画像として生成される
}

function show_form() {
	//下記の「echo <<< END_OF_FORM...END_OF_FORM;」はヒアドキュメントといい、複数行にわたる文字列を表示できる。一行一行にechoを毎回書く必要がなくなるので便利。
	//type="text"をechoで出力する場合、""を''にするかtype=￥text￥のようにエスケープする必要があるが、それが不要
	//PHPのキーワードとして使える文字であれば「END_OF_FORM」でなくても好きな文字で指定できるがプログラムに関連した命名をした方が吉。
	echo <<< END_OF_FORM
	<form action="" method="get">
	<h3>QRコードに変換したいURLとサイズを選択</h3>
	<input type="text" name="url">
	<select name="param">
		<option value="big-qrcode">大</option>
		<option value="small-qrcode">小</option>
	</select>
	<input type="submit" value="変換">
</form>
END_OF_FORM;
}
?>