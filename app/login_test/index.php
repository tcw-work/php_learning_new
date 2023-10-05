<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;500;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/side.css">
    <link rel="stylesheet" href="src/css/function.css">
    <script src="https://corporate.t-creative-works.com/js/jquery-3.5.0.min.js"></script>
    <link rel="manifest" href="manifest.json">
    <!-- <script src="https://www.gstatic.com/firebasejs/5.5.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.2/firebase-messaging.js"></script> -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
</head>

<body>
    <div class="wrap">
        <?php include 'includes/side.php'; ?>
        <main class="index">
           <section>
            <form action="function/save.php" method="GET" class="myForm">
                <h2 class="common_ttl">作者が一人の場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete1()">
                <input type="hidden" name="auther02" class="auther02" placeholder="作者名02">
                <input type="hidden" name="auther03" class="auther03" placeholder="作者名03">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete1()">
                <input type="text" name="name" class="name" placeholder="本の名前" oninput="updateComplete1()">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete1()">
                
				<div class="cmp_box">
					<div class="cmp_in">
						<p>入力したらこの下の内容が自動で切り替わるよ！</p>
						<div class="cmp_func">
							<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存" class="submit" disabled></p>
							<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
						</div>
					</div>
					<input type="text" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
				</div>
                
                
            </form>
			</section>

			<section>
            <form action="function/save.php" method="GET" class="myForm">
				<h2 class="common_ttl">作者が複数の場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名01" oninput="updateComplete2()">
                <input type="text" name="auther02" class="auther02" placeholder="作者名02" oninput="updateComplete2()">
                <input type="text" name="auther03" class="auther03" placeholder="作者名03" oninput="updateComplete2()">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete2()">
                <input type="text" name="name" class="name" placeholder="本の名前" oninput="updateComplete2()">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete2()">
				<div class="cmp_box">
					<div class="cmp_in">
						<p>入力したらこの下の内容が自動で切り替わるよ！</p>
						<div class="cmp_func">
							<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存" class="submit" disabled></p>
							<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
						</div>
					</div>
					<input type="text" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
				</div>
            </form>
			</section>
			
				<section>
            <form action="function/save.php" method="GET" class="myForm">
				<h2 class="common_ttl">外国人作者・翻訳の場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete3()">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete3()">
                <input type="text" name="name" class="name" placeholder="本の名前" oninput="updateComplete3()">
                <input type="text" name="translator" class="translator" placeholder="翻訳者の名前"
                    oninput="updateComplete3()">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete3()">
				<div class="cmp_box">
					<div class="cmp_in">
						<p>入力したらこの下の内容が自動で切り替わるよ！</p>
						<div class="cmp_func">
							<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存" class="submit" disabled></p>
							<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
						</div>
					</div>
					<input type="text" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
				</div>
            </form>
			</section>
				
					<section>
            <form action="function/save.php" method="GET" class="myForm">
				<h2 class="common_ttl">論文から出典する場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete4()">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete4()">
                <input type="text" name="name" class="name" placeholder="論文の名前" oninput="updateComplete4()">
                <input type="text" name="thesis" class="thesis" placeholder="論文がかかれた書籍名" oninput="updateComplete4()">
                <input type="text" name="page" class="page" placeholder="ページ番号(数字のみ)" oninput="updateComplete4()">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete4()">
				<div class="cmp_box">
					<div class="cmp_in">
						<p>入力したらこの下の内容が自動で切り替わるよ！</p>
						<div class="cmp_func">
							<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存" class="submit" disabled></p>
							<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
						</div>
					</div>
					<input type="text" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
				</div>
            </form>
			</section>
					
						<section>
            <form action="function/save.php" method="GET" class="myForm">
				<h2 class="common_ttl">本に掲載された論文から出典する場合</h2>
                <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete5()">
                <input type="text" name="editor" class="editor" placeholder="編者名" oninput="updateComplete5()">
                <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete5()">
                <input type="text" name="thesis" class="thesis" placeholder="論文がかかれた書籍名" oninput="updateComplete5()">
                <input type="text" name="name" class="name" placeholder="論文の名前" oninput="updateComplete5()">
                <input type="text" name="page" class="page" placeholder="ページ番号①(数字のみ)" oninput="updateComplete5()">
                <input type="text" name="page02" class="page02" placeholder="ページ番号②(数字のみ)" oninput="updateComplete5()">
                <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete5()">
				<div class="cmp_box">
					<div class="cmp_in">
						<p>入力したらこの下の内容が自動で切り替わるよ！</p>
						<div class="cmp_func">
							<p><span><img src="src/image/cmp01.png" alt=""></span><input type="submit" value="保存" class="submit" disabled></p>
							<p><span><img src="src/image/cmp02.png" alt=""></span>コピー</p>
						</div>
					</div>
					<input type="text" name="complete" class="complete" placeholder="例：作者名 (発行日) ｢本の名前｣ 出版社" readonly>
				</div>
            </form>
			</section>
        </main>
    </div>

    <!-- firebaseトークン確認用 -->
    <p id="token-display">Loading...</p>

    <script src="src/js/disp01.js"></script>
    <script src="src/js/ajax.js"></script>
    <script src="push.js"></script>

    <script>
    ajaxSubmit('.myForm', "function/save.php");
    </script>


    <script>
    // Firebase初期化設定 start
    const firebaseConfig = { //firebaseのプロジェクトの設定→マイアプリ→SDK の設定と構成→configに表示されている内容をペースト
        apiKey: "AIzaSyAtgi3Zgm3hI3LLK1i7HwQZijgUdFxui1A",
        authDomain: "source-pack.firebaseapp.com",
        projectId: "source-pack",
        storageBucket: "source-pack.appspot.com",
        messagingSenderId: "610617270696",
        appId: "1:610617270696:web:830036e658b04f5c5b7d9d"
    };
    firebase.initializeApp(firebaseConfig); //Firebaseを初期化するための関数呼び出し
    // Firebase初期化設定 end

    // ServiceWorker登録
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('sw.js').then(function(registration) {
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }).catch(function(err) {
            console.log('ServiceWorker registration failed: ', err);
        });
    }
    </script>






</body>


</html>