<?php include __DIR__ . '/../includes/header.php';?>
<?php include __DIR__ . '/../includes/side.php';?>


<main class="contact">
    <h2 class="common_ttl">お問い合わせ</h2>

    <div class="form_des">
        <p>不具合等が発生した場合や、お困りごとがあります場合はこちらのフォームからご連絡ください。</p>
        <p>メッセージのご返答には数日掛かる場合がございます。ご了承ください。</p>
    </div>
    <form method="post" action="contact_send.php" id="keywordApp">
        <input type="text" id="c_name" name="c_name" placeholder="名前（必須）" v-model="keyword">
        <input type="text" id="c_mail" name="c_mail" placeholder="メールアドレス（必須）" v-model="keyword2">
        <span id="mail_error" style="color: red; display: none;">メールアドレスが不正です</span>
        <textarea class="input" id="c_content" name="c_content" rows="7" placeholder="お問い合わせ内容（必須）"
            v-model="keyword3"></textarea>
        <input type="submit" value="送信する" id="submit_button" disabled class="search_submit"
            v-bind:disabled="isSubmitDisabled" v-bind:class="buttonClass2">
    </form>
</main>

<!-- <script src="../src/js/ajax.js"></script>
    <script>
    ajaxSubmit('.myForm', "library_data.php");
    </script> -->

<!-- <script>
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
</script> -->

<?php include __DIR__ . '/../includes/footer.php';?>