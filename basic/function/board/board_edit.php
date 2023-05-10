<h1>一言投稿ボード(message.txt経由でデータのやりとり)</h1>

<br><br><br>
<h2>htmlspecialcharsによるエスケープテスト</h2>
<?php
$s = "<script>alert('aaaa')</script>";
echo htmlspecialchars($s, ENT_QUOTES);//ENT_QUOTESはシングルクォーテーション含めてHTMLにしてくれる。これがないと、フォームに値を埋め込まれるなどで問題が起こる場合もある
?>
<br><br><br>


<h2>ボード作成→message.txtに内容を保存→board_show.phpで表示</h2>
<?php
// ファイルの保存先を指定
include 'include.php';//共通パーツ
// 更新用パスワード指定
$master_password = "aaa";
// 投稿があるか？
if (isset($_POST["msg"])) {//textareaに文字が入ってれば
	$pass = isset($_POST["pass"]) ? $_POST["pass"] : "";//$passにパスワードを入れたinputの内容を格納
	if ($pass !== $master_password) { //そのうえでもしパスワードが本物と一致しなければ...
		echo "パスワードが違います";
		exit;//exit; を使用することで、条件に合致しない場合に特定のメッセージを表示し、それ以上の処理を続行せずにプログラムを終了させる
		//これをしないとパスワードが間違っているにもかかわらずファイルが上書き保存される。したがって、セキュリティ上の観点から、パスワードが一致しなかった場合はプログラムの実行を終了することがお作法
	}
	file_put_contents($save_file, $_POST["msg"]); ///message.txt（$save_file）に$_POST["msg"]で受け取ったメッセージを保存(txtの内容が全て上書きされる)
	//もしも全上書きせずに既存の内容の末尾にメッセージを追加したい場合は、「file_put_contents($save_file, $_POST["msg"], FILE_APPEND)」を使う
	echo "保存しました";
} else {
	$self = $_SERVER["SCRIPT_NAME"];////現在のページのURL
	// このURLをformにセットしておけば、URLやディレクトリが変わってもオッケー！
	echo <<<__FORM__
    <form action="$self" method="POST"> <!-- 修正: "POAT" を "POST" に修正 -->
        <textarea name="msg" cols="60" rows="6">
            ここにメッセージを記入してください
        </textarea><br>
        パスワード:
        <input type="password" name="pass">
        <input type="submit" value="記録">
    </form>
__FORM__;
}
?>
<br><br><br>