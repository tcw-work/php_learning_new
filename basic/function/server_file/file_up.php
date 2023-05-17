<h1>webサーバーにファイル保存</h1>

<?php
$file = "test.jpeg";//「jpeg」ファイルという形式を確かめるためのプログラム
$f = finfo_open(FILEINFO_MIME_TYPE);//ファイルタイプを確かめるための設定
$type = finfo_file($f, $file);//test.jpegのファイル
echo "$file --- $type"; //echoでファイル名とファイルタイプを表示
?>


<br><br><br>
<h2>ファイルをフォームからアップロード</h2>

<?php
// ファイルがアップロードされたか調べる
if (isset($_FILES["upfile"])) {//スーパーグローバル変数$_FILESに値があれば
    save_jpeg();
} else {
    show_form();
}

// ファイルのアップロードフォームの表示
function show_form() {
    $self = $_SERVER["SCRIPT_NAME"];//リダイレクト用url設定
    $maxsize = 1024 * 1024 * 3; // 3MB
    echo <<<FORM_
    <form action="$self" method="POST" enctype="multipart/form-data"><!-- enctype=～、はお作法として必要 -->
        JPEGファイルをアップロード: <br/>
        <!-- 最大ファイルサイズ(バイト)の指定 -->
        <input type="hidden" name="MAX_FILE_SIZE" value="$maxsize" /><!-- MAX_FILE_SIZEは元々HTMLで用意されている機能で、HTML側で容量制限を超えるアップロードを制御するためのおまじないとしての役割を果たす -->
        <!-- アップロードの指定 -->
        <input type="file" name="upfile" /> <br/>
        <input type="submit" value="ファイル送信" />
    </form>
    FORM_;
}

// アップロードされたファイルを保存する
function save_jpeg() {
    // ファイルのパスを指定する
    $tmp_file = $_FILES["upfile"]["tmp_name"];//tmp_name は、$_FILES["upfile"] 配列内の要素として定義されており、ファイルのアップロード時にPHPによってキーとして自動的に設定sされる
    $save_file = dirname(__FILE__) . '/test.jpeg'; // 指定ファイルがアップロードされたものかチェック
    if (!is_uploaded_file($tmp_file)) {//もしアップされたファイルが$tmp_file（jpegが一時保存されているファイルにない場合）である場合
        echo "アップロードされたファイルが不正です。";
        exit;
    }

    // アップロードされたファイルの形式を調べる（検証作業）
    $finfo = finfo_open(FILEINFO_MIME_TYPE);//ファイルタイプを確かめるための設定
    $type = finfo_file($finfo, $tmp_file);//test.jpegのファイル
    if ($type != "image/jpeg") {//image/jpegはMIMEタイプ（メディアタイプ）を表している。
        echo "送信されたファイルがJPEGではありません。";
        exit;
    }

    // ファイルを指定ディレクトリに保存
    if (!move_uploaded_file($tmp_file, $save_file)) {//もしアップロードされたファイル（$save_file）が（$tmp_file）のパスへ移動していなかったら（php.iniで指定されたフォルダへ一時的保存されていなかったら）
        echo "アップロードに失敗しました。";
        exit;
    }

    // アップした画像を表示する（検証をクリアしたら）
    echo "<h1>画像ファイルをアップしました!!</h1>";
    echo '<img src="test.jpeg" />';
}

// $_FILES["upfile"]の中にある要素の構造
// $_FILES = array(
//     "upfile" => array(
//         "name" => "example.jpg", // アップロードされたファイルの元の名前
//         "type" => "image/jpeg", // ファイルのMIMEタイプ
//         "tmp_name" => "/tmp/phpxyz123", // アップロードされたファイルの内容が一時的に保存されるファイルのパス。サーバー上の一時ディレクトリ。/tmp/phpxyz123/example.jpgという意味
//         "error" => 0, // エラーコード（アップロードに成功した場合は0）
//         "size" => 12345 // ファイルサイズ（バイト単位）
//     )
// );
?>


<p>※type="file"によってアップロードされたファイルはphp.iniで指定された一時的なファイルへ保存される</p>
<p>※jpegからpngに名前を変えただけではjpegとして認識される</p>
<p>$_FILESには下記のような指定も可能</p>
<ul>
    <li>$_FILES["upfile"]["tmp_name"];</li>
    <li>$_FILES["upfile"]["size"];</li>
    <li>$_FILES["upfile"]["type"];</li>
</ul>