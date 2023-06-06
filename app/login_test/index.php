<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <script src="https://corporate.t-creative-works.com/js/jquery-3.5.0.min.js"></script>
</head>

<body>
    <div class="wrap">
        <div class=""></div>
        <div class="login">
            <?php
                include 'session.php';//ログイン前後の出し分けを要素を管理
                session_part_01($script);
            ?>
        </div>
        <a href="profile.php">プロフィールページ</a>

        <form action="save.php" method="GET" class="myForm">
            <h2>作者が一人の場合</h2>
            <input type="text" name="auther01" class="auther01" placeholder="作者名01" oninput="updateComplete1()">
            <input type="hidden" name="auther02" class="auther02" placeholder="作者名02">
            <input type="hidden" name="auther03" class="auther03" placeholder="作者名03">
            <input type="text" name="date" class="date" placeholder="発行日" oninput="updateComplete1()">
            <input type="text" name="name" class="name" placeholder="本の名前" oninput="updateComplete1()">
            <input type="text" name="publisher" class="publisher" placeholder="出版社" oninput="updateComplete1()">
            <br>
            <input type="text" name="complete" class="complete">
            <input type="submit" value="保存">
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
            <input type="submit" value="保存">
        </form>
    </div>
</body>



<script>

</script>
<script src="js/disp01.js"></script>

</html>