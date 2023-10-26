<?php include __DIR__ . '/../config.php'; ?>
<!-- 検証と本番でパスの出し分け -->


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;500;700&amp;display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="src/css/style.css"> -->


    <link rel="stylesheet" href="<?php echo BASE_URL . '/src/css/style.css'; ?>">

    <link rel="stylesheet" href="<?php echo BASE_URL . '/src/css/side.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/src/css/function.css'; ?>">
    <script src="https://corporate.t-creative-works.com/js/jquery-3.5.0.min.js"></script>
    <link rel="manifest" href="manifest.json">
    <!-- <script src="https://www.gstatic.com/firebasejs/5.5.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.2/firebase-messaging.js"></script> -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.33/dist/vue.global.prod.js"></script>
    <script>
    //js版にも変換
    var baseUrl = '<?php echo BASE_URL; ?>';
    console.log(baseUrl);
    </script>
</head>


<body class="overflow_none" :class="{ 'overflow_active': hasMessage }">
    <div id="modal_mount">
        <!-- modal用Vueインスタンスstart -->
        <!-- プロパティ名:値　で定義 -->
        <div class="modal" :class="{ 'modal_active': hasMessage }"></div>
        <div class="wrap">
            <div class="decoration">
                <p>Source Pack</p>
            </div>