<h1>ファイル書き込み読み込みテスト</h1>

<!--ファイル書き込みの基本-->
<?php
$filename = "test01.txt";//ファイルパス（ファイル名）を指定し変数化
file_put_contents($filename, "テスト。テスト。");//ファイルに書き込みを行う　※この時点で同じディレクトリにtest.txtが自動で生成される
$str = file_get_contents($filename);//ファイルからデータを読み込んで返す
echo $str;//ブラウザでtest.txtの内容が表示されるか確認
?>



<br><br><br>


<h2>パスを指定した書き方</h2>
<?php
//ファイルパス指定
$target_dir = dirname(__File__);//dirname関数はパスの部分だけを取り出せる。dirname(__FILE__)は自身(このファイル)がいるディレクトリの絶対パスを返す
$target_file = $target_dir . "/test02.txt";//ファイルパス＋ファイル名を変数化（今回は同じ階層という意味）
//ファイルに文字列を書き込み
file_put_contents($target_file, "file_put_contentsのテスト");//$target_fileに入っているtest02.txtに文字代入。file_put_contentsは第一第二引数とセットで覚える
//ファイルから文字列を読み込み
$str = file_get_contents($target_file);//file_get_contentsは引数に指定したファイルからファイル内のすべてのデータを読み込んで返す（画面に表示したい倍は）
echo "ファイル内のコンテンツは:$str";
?>
<br><br><br>


<h2>読み取り、書き込みが可能かを調べながら書く方法</h2>
※サーバーによっては書き換え権限がない場合（ファイル読み取りしか権限がないなど）もあるのでそれを調べる（原因特定）目的で書く<br>
file_exists() 引数のファイル、もしくはディレクトリが存在しているか<br>
is_writable() 引数のファイルにデータの書き込みが可能かどうか<br>
is_readable() 引数のファイルから読み取りが可能かどうか
<br><br>

<?php
//ファイルパス指定
$target_dir = dirname(__FILE__);
$target_file = $target_dir . "/text03.txt";

//-------------------------------------------------------------------------------------------------------------------
//※書き込み編
//①このディレクトリに書き込み可能か調べる
if(!is_writable($target_dir)) {//is_writeable()でファイルへデータの書き込みが可能かを調べる（！なのでできなければという意味）
	echo "(1)ディレクトリに書き込みができません: $$target_dir";
	exit;
}
//②ファイルが既に存在しているか調べる
if(file_exists($target_file)) {//file_exists()でファイル、もしくはディレクトリが既に存在しているかを調べる
	//③ファイルに書き込めるか調べる
	if(!is_writable($target_file)) {//ファイルが存在していて、もしデータの書き込みが可能でなければ...
		echo "(3)ファイル書き込みができません: $$target_dir";
		exit;
	}
}
//ファイルに文字列を書き込む
file_put_contents($target_file, "ファイル操作の実験中");

//-------------------------------------------------------------------------------------------------------------------
//※読み込み編
//④ファイルに書き込めるか調べる
if(!file_exists($target_file)) {//もしファイルが存在していたら（！なので逆の意味）
	echo "(4)ファイルが存在しません: $$target_dir";
	exit;
}
//⑤このファイルを読み込めるか否かを調べる
if(!is_readable($target_file)) {//is_readable()でファイルからデータの読み取りが可能かを調べる
	echo "(4)ファイルの読み込みができません";
	exit;
}
//⑥ファイルから見時列を読み込み
$str = file_get_contents($target_file);
echo "ファイル内のコンテンツは:$str";
?>
<br><br><br>



<h2>old.txtを読み込んでnew.txtへ保存する</h2>

