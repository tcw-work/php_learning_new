<h1>ループでボタン100個作成</h1>


<!--forはwhileとは違い、条件式を指定できる（回数を指定した処理にも向いている）-->
<?php
function Click_btn() {//関数化しておくと便利
	for ( $i = 1; $i <=100; $i++ ) { //「$i <= 100;」で回数指定、「$i++」で増産式
		echo "<input type='submit' name='btn' value='{$i}' style='width; '50px>"; //サブミットにもnameで値を載せれる
		if ($i == 70) break; //breakwoを指定するとループを途中で抜けることができる
	}
	if(isset($_GET["btn"])) {
		$btn = intval($_GET["btn"]); //押されたinptの「name='btn'」から値を取得
		echo"<br><br>ボタンの{$_GET["btn"]}番目が押されました";
	}
}

?>


<form>
	<?php Click_btn(); ?><!-- 関数呼び出し-->
</form>