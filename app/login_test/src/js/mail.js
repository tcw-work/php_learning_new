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