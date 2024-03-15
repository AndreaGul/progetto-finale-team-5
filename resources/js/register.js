const password = document.getElementById("password");
const passwordConfirm = document.getElementById("password-confirm");

const errorText = document.getElementById("error-text");

const submit = document.getElementById("submit");

const checkboxes = document.getElementsByName("specializations[]");
const errorSpecializations = document.getElementById("error-specializations");

let isChecked = false;

submit.addEventListener("click", (event) => {
    //password diverse
    if (password.value !== passwordConfirm.value) {
        errorText.classList.remove("d-none");
        password.classList.add("border", "border-danger");
        passwordConfirm.classList.add("border", "border-danger");
        errorText.innerText = "Le password sono diverse";
        event.preventDefault();
    }
    //controllo se almeno una specializzazione inserita
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            isChecked = true;
            break;
        }
    }
    if (!isChecked) {
        errorSpecializations.classList.remove("d-none");
        errorSpecializations.innerText =
            "Inserisci almeno una specializzazione";
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].classList.add("border", "border-danger");
        }
        event.preventDefault();
    }
});
