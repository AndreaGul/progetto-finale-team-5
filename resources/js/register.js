const password = document.getElementById("password");
const passwordConfirm = document.getElementById("password-confirm");

const errorText = document.getElementById("error-text");

const submit = document.getElementById('submit');

submit.addEventListener("click", (event) => {
    if(password.value !== passwordConfirm.value){
        errorText.classList.remove('d-none');
        password.classList.add('border', 'border-danger');
        passwordConfirm.classList.add('border', 'border-danger');
        errorText.innerText = 'Le password sono diverse';
        event.preventDefault();
    }
});