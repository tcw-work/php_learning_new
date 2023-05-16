<h1>session</h1>

<?php
session_start();//sessionを開始するにはこの関数で呼び出し
$c = isset($_SESSION["count"]) ? $_SESSION["count"] : 1;//$_SESSIONにcountがセットされていた場合の条件分岐で表示を決定
$_SESSION["count"] = $c + 1;//$_SESSION["count"]には$cに+1を入れる。括弧内のキー（変数）は、作成者が任意の名前を決めることができる。
echo "{$c}回目の訪問です";
?>
<br><br><br>