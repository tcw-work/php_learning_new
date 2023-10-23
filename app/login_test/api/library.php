<?php include __DIR__ . '/../includes/header.php';?>
<?php include __DIR__ . '/../includes/side.php';?>


<main class="liburary">
    <div class="decoration">
        <p>Source Pack</p>
    </div>
    <h2 class="common_ttl">書籍情報をタイトルから検索する</h2>
    <p class="form_des">国立国会図書館の....テキストテキストテキストテキストテキスト</p>
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

<!-- <script src="../src/js/ajax.js"></script>
    <script>
    ajaxSubmit('.myForm', "library_data.php");
    </script> -->
<?php include __DIR__ . '/../includes/footer.php';?>