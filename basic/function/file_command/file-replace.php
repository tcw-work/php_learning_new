<h1>old.phpの文字列をnew.phpへ置換して保存</h1>
<br><br><br>


<h2>str_replaceとfile_put_contentsを使う方法</h2>

<?php
//"old.txt" と "new.txt" は存在するファイルである必要がある
$txt = file_get_contents("old.txt");//old.txtの内容を取得
$txt = str_replace("old@example.com", "new@example.com", $txt);//第一引数には置換対象の文字列、第二引数には置換後の文字列、第三引数には置換対象の文字列が含まれている変数（つまりold.txtの中身）を指定
file_put_contents("new.txt", $txt);//置換後のnew.txtにアドレス部分だけを置換した内容が書き込まれる
echo "ok";
?>


<br><br><br>


<h2>F系関数を使う方法</h2>
<?php
$handle_r = fopen("old02.txt", "r");//ファイルを指定したモードで開き、ハンドル（$handle_r）を返す。"r"は、"old02.txt"というファイルを読み込み専用モードで開くという意味
$handle_w = fopen("new02.txt", "w");//"w"は、"new02.txt"というファイルを書き込み専用モードで開くという意味

//ファイルの終端に達するまで繰り返し処理を行うためのループ処理（一行一行読み込むため）
while (!feof($handle_r)) {//feof($handle_r)は、ファイルポインターがファイルの終端に達しているかどうかを確認
	$line = fgets($handle_r);//ループの中で、fgets($handle_r)を使用してファイルから一行ずつ読み込み、その内容を返します。
	$line = str_replace("old@example.com", "new@example.com", $line);//リプレイス
	fwrite($handle_w, $line);//書き込み用のファイルポインタ$handle_wを介して新しいファイル("new02.txt")に書き込み
}

//ファイルを開いたままにしておくと、システムリソースを無駄に占有してしまったり、エラーや予期しない動作が発生する可能性がある。なのでfclose()で閉じるのはお作法として覚えておく。
//ファイルポインタを閉じることで、ファイルへの操作が完了し、データが正しく書き込まれることを保証します。
fclose($handle_r);//ファイルを閉じる
fclose($handle_w);
echo "ok";
?>