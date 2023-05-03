<h2>配列の中身をoptionとして出力</h2>
<?php
$goods = array( "目薬","日焼け止め","シャンプー","虫よけスプレー","石鹸","ガム","チョコレート","バナナ" );//グローバル変数として商品をgoods配列に格納
if(isset($_GET["goods"])) { //{/selectのoptionに値がセットされていれば(選んだ状態)アイテムを表示
	show_item();
} else {
	show_form();//selectのoptionは選ぶまでセットされていないのでformを表示（初期状態）
}

//商品を選択した後の処理
function show_item() {
	//↓この場合はグローバル変数を変更する必要がないため、globalキーワードは使用しない（グローバルのためにあえてややこしく「$goods」をつかっているが、別のでもオッケー）
	$goods = $_GET["goods"]; //goods変数にselectに入った値をローカル変数として代入（この中だけで使うので、globalにする必要はない）
	$goods_html = htmlspecialchars($goods);//エスケープ
	echo "商品「{$goods_html}」を購入しました";//
}

//フォームのoptionに表示するための部品作成(初期状態にoption出す)
function show_form() {
	//↓関数内でグローバル変数を変更する場合は、globalキーワードを使用してその変数がグローバルスコープで定義されていることを明示する必要があ
	global $goods; //グローバルスコープされている$goodsを変更するために関数内で宣言する（goodsには配列の情報が入っている）
	$options = ""; //optionは下記で代入するので最初は空の状態にしておく
	foreach ($goods as $item) { //ここでは一番最初の$goodsに入ったものをforeachで一つ一つをある分だけ$itemとして格納
		$options .= "<option value='$item'>$item</option>";//配列の中にある分だけoptionとして出力
	}
//フォーム表示（ヒアドキュメント）
echo <<<_form_
<form>
	<select name="goods">
		<option>商品を選択</option>
		{$options}<!--先ほど作った配列の中身をループして作った「options」を記述（optionsはローカル変数なので、このまま出力可能）-->
	</select>
	<input type="submit" value="購入">
	</form>
_form_;
}
?>




