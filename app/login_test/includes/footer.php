<!-- firebaseトークン確認用 -->
<p id="token-display">Loading...</p>

<script src="<?php echo BASE_URL . '/push.js'; ?>"></script>
<script src="<?php echo BASE_URL . '/src/js/script.js'; ?>"></script>
<script src="<?php echo BASE_URL . '/src/js/mail.js'; ?>"></script>
<script src="<?php echo BASE_URL . '/src/js/ajax.js'; ?>"></script><!-- ajax処理はvueよりも下に書くこと -->

<script>
ajaxSubmit('.myForm', "function/save.php");
ajaxSubmit('.myForm_repository', "function/repository.php");
// ajaxSubmit('.myForm_item_list', "function/delete.php");
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


</div><!-- wrap終了 -->

</body>

</html>