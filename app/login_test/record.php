<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/side.php'; ?>


<main class="record_form">

    <h2 class="common_ttl">他のユーザーが作った出典を検索・コピーする</h2>

    <?php //ログインで検索からお気に入り保存に成功して飛ばされてきたユーザーに表示
    if (isset($_GET["correct_message"])) {
        // URLデコードを行い、メッセージを取得
        $correct_message = urldecode($_GET["correct_message"]);// URLエンコードでは、スペースは %20 と表現されるので、rawurldecode() 関数を使用してデコードする
        echo '<div class="red mb_32">' . $correct_message . '</div>';
    }
?>

    <div class="form_des">
        <p>このページでは、これまで他のユーザーが作成したデータをキーワード入力で検索することができます。</p>
        <p>本の名前、作者名、出版社名からも検索可能ですが、キーワードを一部だけ入力するよりも、なるべく完成形に近い形で入力した方が、より詳細な情報をサーチすることできます。</p>
        <p>検索結果はご自身の出典としてもコピーすることができます。</p>
    </div>


    <form action="function/repository.php" method="GET" class="myForm_repository">
        <input type="text" name="keyword" placeholder="キーワードを入力">
        <input type="submit">
    </form>

    <!-- 出力結果表示エリア -->
    <div id="response-message"></div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
<?//php include 'includes/footer.php'; ?>