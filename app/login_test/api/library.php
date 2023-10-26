<?php include __DIR__ . '/../includes/header.php';?>
<?php include __DIR__ . '/../includes/side.php';?>


<main class="liburary">
    <h2 class="common_ttl">書籍情報をタイトルから検索する</h2>

    <div class="form_des">
        <p>本の名前以外の情報が分からない場合、著書名を入力するだけで、作者名、出版社、発行日を検索することができます。</p>
        <p>日本最大の蔵書数を誇る「国立国会図書館」とのデータ連携機能により、お探しの作品情報を提供しできます。</p>
        <p>本の名前を一部だけ入力するよりも、なるべくフルネームで入力した方が、より詳細な情報をサーチすることできます<br>（著書によっては項目が空欄の場合もございます）。</p>
    </div>

    <form action="library_data.php" method="GET" class="myForm_liburary btn_two">
        <input type="text" name="bookTitle" placeholder="キーワードを入力">
        <input type="submit">
    </form>

    <!-- 出力結果表示エリア -->
    <div id="response-message">
        <div class='lib_parent'>
            <div class='lib_cont'>
                <p class='lib_child1'>Title : </p>
                <p class='lib_child2'>Webサイトの作り方図鑑</p>
            </div>
            <div class='lib_cont'>
                <p class='lib_child1'>Author :</p>
                <p class='lib_child2'>山田かずや</p>
            </div>
            <div class='lib_cont'>
                <p class='lib_child1'>publisher :</p>
                <p class='lib_child2'>テスト出版社</p>
            </div>
            <div class='lib_cont'>
                <p class='lib_child1'>issued :</p>
                <p class='lib_child2'>2023</p>
            </div>
        </div>
        <div class='lib_parent'>
            <div class='lib_cont'>
                <p class='lib_child1'>Title : </p>
                <p class='lib_child2'>Webサイトの作り方図鑑</p>
            </div>
            <div class='lib_cont'>
                <p class='lib_child1'>Author :</p>
                <p class='lib_child2'>山田かずや</p>
            </div>
            <div class='lib_cont'>
                <p class='lib_child1'>publisher :</p>
                <p class='lib_child2'>テスト出版社</p>
            </div>
            <div class='lib_cont'>
                <p class='lib_child1'>issued :</p>
                <p class='lib_child2'>2023</p>
            </div>
        </div>
    </div>

</main>

<?php include __DIR__ . '/../includes/footer.php';?>