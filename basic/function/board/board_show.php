<h1>一言メッセージ（message.txtに内容を表示）</h1>
※サーバーアップ時にエラーが起きたらパーミッションを確認
<br><br><br>


<?php
include 'include.php';
if (!file_exists($save_file)) {//もしファイルがなければ
	echo"まだメッセージがありません";
	exit;
}
$msg = file_get_contents($save_file);//message.txt内の内容を取得
$msg_html = htmlspecialchars($msg);//エスケープ処理。<などが入力されている場合、正しく表示されないケースがある
$msg_html = str_replace("/n","<br>",$msg_html);//
echo <<<__HTML__
    <div>
		{$msg_html}
    </div>
__HTML__;
?>


