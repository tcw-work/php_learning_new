<?php
//-----データベースへの接続-----------------------------------------------------------------------------------------------------------------------------------------------------------
include '../common/db.php';
require_once '../common/session.php';//ログイン前後の出し分けを要素を管理
session_part_01($script);
?>

<head>
    <meta charset="utf-8">
    <script src="https://corporate.t-creative-works.com/js/jquery-3.5.0.min.js"></script>
</head>

<form id="contact" method="post" action="contact_send.php">
    <input type="text" id="c_name" name="c_name" placeholder="名前（必須）">
    <input type="text" id="c_mail" name="c_mail" placeholder="メールアドレス（必須）">
    <span id="mail_error" style="color: red; display: none;">メールアドレスが不正です</span>
    <textarea class="input" id="c_content" name="c_content" rows="7" placeholder="お問い合わせ内容（必須）"></textarea>
    <input type="submit" value="送信する" id="submit_button" disabled>
</form>

<script>
var nameInput = document.getElementById('c_name');
var mailInput = document.getElementById('c_mail');
var contentInput = document.getElementById('c_content');
var submitButton = document.getElementById('submit_button');
var mailError = document.getElementById('mail_error');

function validateInputs() {
    if (nameInput.value === "" || mailInput.value === "" || contentInput.value === "") {
        submitButton.disabled = true;
    } else if (!mailInput.value.includes('@')) {
        submitButton.disabled = true;
        mailError.style.display = "block";
    } else {
        submitButton.disabled = false;
        mailError.style.display = "none";
    }
}

nameInput.addEventListener('input', validateInputs);
mailInput.addEventListener('input', validateInputs);
contentInput.addEventListener('input', validateInputs);
</script>