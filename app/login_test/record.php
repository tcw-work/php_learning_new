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
        <p class="red">こちらは開発中のベータ版となります。バグが発生する場合がありますので、予めご了承ください。</p>
        <p>このページでは、これまで他のユーザーが作成・保存したデータをキーワードから検索することができます。</p>
        <p>本の名前、作者名、出版社名からも検索可能です（なるべく著書名をそのまま入れるとより正確な結果をご提案できます）。</p>
        <p>検索結果はご自身の出典としてもコピー（保存）することができます。</p>
    </div>


    <form action="function/repository.php" method="GET" class="myForm_repository" id="keywordApp">
        <input type="text" name="keyword" placeholder="キーワードを入力" v-model="keyword">
        <input type="submit" class="search_submit" v-bind:disabled="isSubmitDisabled" v-bind:class="buttonClass">
    </form>

    <!-- 出力結果表示エリア -->
    <div id="response-message"></div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
<?//php include 'includes/footer.php'; ?>