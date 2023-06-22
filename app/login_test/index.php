<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <script src="https://corporate.t-creative-works.com/js/jquery-3.5.0.min.js"></script>
</head>

<body>
    <div class="wrap">
        <div class="login">
            <?php
                include 'function/session.php';//ログイン前後の出し分けを要素を管理
                session_part_01($script);
            ?>
        </div>
        <a href="profile.php">プロフィールページ</a><br>
        <a href="record.php">履歴検索ページ</a><br>
        <a href="mail/contact.php">お問い合わせページ</a><br>
        <a href="mail/notice_mail.php">メール一斉送信実行（管理者用になる予定）</a><br>
        <a href="calil.php">カーリルapi（開発中）</a><br>

        <form action="save.php" method="GET" class="myForm">
            <h2>作者が一人の場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete1()">
            <input type="hidden" name="auther02" class="auther02" placeholder="作者名02">
            <input type="hidden" name="auther03" class="auther03" placeholder="作者名03">
            <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete1()">
            <input type="text" name="name" class="name" placeholder="本の名前" oninput="updateComplete1()">
            <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete1()">
            <br>
            <input type="text" name="complete" class="complete">
            <input type="submit" value="保存" class="submit" disabled>
        </form>

        <form action="save.php" method="GET" class="myForm">
            <h2>作者が複数の場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="作者名01" oninput="updateComplete2()">
            <input type="text" name="auther02" class="auther02" placeholder="作者名02" oninput="updateComplete2()">
            <input type="text" name="auther03" class="auther03" placeholder="作者名03" oninput="updateComplete2()">
            <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete2()">
            <input type="text" name="name" class="name" placeholder="本の名前" oninput="updateComplete2()">
            <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete2()">
            <br>
            <input type="text" name="complete" class="complete">
            <input type="submit" value="保存" class="submit" disabled>
        </form>

        <form action="save.php" method="GET" class="myForm">
            <h2>外国人作者・翻訳の場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete3()">
            <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete3()">
            <input type="text" name="name" class="name" placeholder="本の名前" oninput="updateComplete3()">
            <input type="text" name="translator" class="translator" placeholder="翻訳者の名前" oninput="updateComplete3()">
            <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete3()">
            <br>
            <input type="text" name="complete" class="complete">
            <input type="submit" value="保存" class="submit" disabled>
        </form>

        <form action="save.php" method="GET" class="myForm">
            <h2>論文から出典する場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete4()">
            <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete4()">
            <input type="text" name="name" class="name" placeholder="論文の名前" oninput="updateComplete4()">
            <input type="text" name="thesis" class="thesis" placeholder="論文がかかれた書籍名" oninput="updateComplete4()">
            <input type="text" name="page" class="page" placeholder="ページ番号(数字のみ)" oninput="updateComplete4()">
            <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete4()">
            <br>
            <input type="text" name="complete" class="complete">
            <input type="submit" value="保存" class="submit" disabled>
        </form>

        <form action="save.php" method="GET" class="myForm">
            <h2>本に掲載された論文から出典する場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="作者名" oninput="updateComplete5()">
            <input type="text" name="editor" class="editor" placeholder="編者名" oninput="updateComplete5()">
            <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete5()">
            <input type="text" name="thesis" class="thesis" placeholder="論文がかかれた書籍名" oninput="updateComplete5()">
            <input type="text" name="name" class="name" placeholder="論文の名前" oninput="updateComplete5()">
            <input type="text" name="page" class="page" placeholder="ページ番号①(数字のみ)" oninput="updateComplete5()">
            <input type="text" name="page02" class="page02" placeholder="ページ番号②(数字のみ)" oninput="updateComplete5()">
            <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete5()">
            <br>
            <input type="text" name="complete" class="complete">
            <input type="submit" value="保存" class="submit" disabled>
        </form>
    </div>
</body>



<script>

</script>
<script src="js/disp01.js"></script>

</html>