<?php
if ($_SERVER['HTTP_HOST'] == 'localhost:8081' || $_SERVER['HTTP_HOST'] == '127.0.0.1:8081') {
    define('BASE_URL', 'http://localhost:8081'); // ローカル環境の場合
} else {
    define('BASE_URL', 'https://sourcepack.t-creative-works.com'); // 本番環境の場合
}
?>