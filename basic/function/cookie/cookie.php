<h1>Cookie</h1>
<ul>
    <li>・ユーザーのデバイスに一時的に情報を書き込んで、次回来た時に利用する</li>
    <li>setcookie()関数はヘッダー情報と一緒に送信されるので、基本的に一番最初に書く</li>
    <li>cookieを削除する場合は過去を指定する（setcookie("size", "", time() - 3600);）</li>
    <li>Cookieはサーバーリクエストの際にも端末に保存された値として一緒に通信さる</li>
    <li>Cookieは保存できる容量が決まっている（4096バイトまで）なので、多大なデータは保存できない</li>
</ul>
<br><br><br>

<h2>訪問回数を保存して表示</h2>
<?php
//まずは既存のcoolieの値を取得（$_COOKIEは$_GETと同様にスーパーグローバル変数と呼ばれている）
$c = isset($_COOKIE["count_cookie"]) ? $_COOKIE["count_cookie"] : 1;//$_COOKIEは、クライアントが送信したクッキー情報を格納している連想配列。setcookie()によって指定された名前が値として送信される
//$_COOKIE配列内にキーが "count_cookie" という名前の要素が存在するかどうかを確認
//三項演算子を用いてcookieの値（count）があれば1を返す。キーが存在しない場合は、デフォルトとして1が代入。

//cookieの保存処理
$limit = time() + (60*60*24) * 365;//保存期間を一年後に設定(現在のUnixタイムスタンプに一年後の計算処理を足すだけ)
setcookie("count_cookie", $c + 1, $limit);//setcookie()関数を使用してクッキーを設定。
//第一引数にはクッキーの名前を指定し、$_COOKIE配列のキーもここに合わせる。第二引数には値を指定。第三引数には、クッキーの有効期限を指定。
echo "{$c}回目の訪問です";
?>


<?php
$self = $_SERVER['SCRIPT_NAME'];//現在のスクリプト(PHPファイル)のURLを取得→後のリダイレクト用

// サイズの指定が行われたか？
if (isset($_GET["size"])) {//値の入ったsize属性を受け取ったら
    $size = intval($_GET["size"]);//その値を整数にして変数に格納
    if ($size < 12 || $size > 72) {//さらにもし値が12より小さく、72より大きければ
        echo "サイズ指定が不正です";
        exit;
    }
    //上記if文に該当しない場合
    $expire = time() + (60 * 60 * 24) * 365;//1年を計算
    setcookie ("size", $size, $expire);//クッキー設定（getの値と同じ名前, 値, 期限）
    header("location: $self");//header()は指定したURL ($self) に対して新しいリクエスト（リダイレクト）を行う。
    exit;//リダイレクトが行われた後、それ以降のスクリプトの実行は終了
}

// cookieから値を読みだす（再訪問時の表示処理）
$size = 26;//再訪問時のデフォルメの値
if (isset($_COOKIE["size"])) {//もしスーパーグローバル変数のCOOKIEの中に既にsizeがあれば
    $size = intval ($_COOKIE["size"]);//その値を整数にして変数に代入（グローバル）
}

// 文字指定のフォーム
echo <<<_FORM_
<html> <body style="font-size:$size"> <div style="background-color: yellow; text-align:right;">
文字サイズ:
[<a href="$self?size=46">大</a>]
[<a href="$self?size=26">中</a>]
[<a href="$self?size=14">小</a>]
[<a href="$self?size=11">超小</a>]
</div>
_FORM_;
?>
<!-- 文章 -->
<p>「ジョバンニさん。あなたはわかっているのでしょう。」 </p>
<p>「大きな望遠鏡で銀河をよっく調べると銀河は大体何でしょう。」</p>
<p>やっぱり星だとジョバンニは思いましたがこんどもすぐに答えることができませんでした。</p>