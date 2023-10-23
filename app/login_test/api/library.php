<?php include '../includes/header.php'; ?>
<?php include '../includes/side.php'; ?>

<main class="login_form">
    <div class="decoration">
        <p>Source Pack</p>
    </div>
    <form action="library_data.php" method="GET" class="myForm">
        <input type="text" name="bookTitle" placeholder="キーワードを入力">
        <input type="submit">
    </form>

    <!-- 出力結果表示エリア -->
    <div id="response-message"></div>

    <!-- <script src="../src/js/ajax.js"></script>
    <script>
    ajaxSubmit('.myForm', "library_data.php");
    </script> -->
</main>
<?php include '../includes/footer.php'; ?>