<?php
//	if(isset($_GET["age"])) {
//		$age = $_GET["age"];
//		echo $age;
//		// $ageを使った処理を記述する
//	} else {
//		// "age"キーが未定義の場合の処理を記述する
//	}
$age = $_GET["age"];//index.phpの「name="age"」から値を取得
$welcom = htmlspecialchars($age);//エスケープ処理
echo "<div>ようこそ！{$welcom}さん( ﾟДﾟ)<<div>";
?>

<!--
※入力データは基本サニタイジングする
※フォームに「<script>alert("aaa");</script>」などを入れるとjsを操作される恐れがある-->
