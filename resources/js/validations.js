const required = ["nome", "cognome"];

/*
curriculum
photo
*/

const elementsText = [];
const elementsEmail = [];
const elementsNumber = [];
const elementsBigText = [];

const alert = document.getElementById('error-fe');
const errorText = document.getElementById('error-text');
const errorList = [''];
const form = document.getElementById('form');
const submit = document.getElementById('submit');

elementsText.push(document.getElementById("nome"));
elementsText.push(document.getElementById("cognome"));
elementsNumber.push(document.getElementById("telefono"));
elementsBigText.push(document.getElementById("indirizzo"));
elementsBigText.push(document.getElementById("descrizione"));

submit.addEventListener("click", (event) => {
    let authorize = true;
    // Small Text
    elementsText.forEach((element) => {
        if(!required.includes(element.id) && element.value.length === 0){
            element.classList.remove('border', 'border-danger');
        }else if(element.value.length < 3 || element.value.length > 20){
            element.classList.add('border', 'border-danger');
            authorize = false;
            errorList.push(element.id + ' deve contenere almeno 3 e massimo 20 caratteri');
        }else if(/[^a-zA-Z]/.test(element.value)){
            element.classList.add('border', 'border-danger');
            authorize = false;
            errorList.push(element.id + ' deve contenere solo caratteri alfabetici');
        }else{
            element.classList.remove('border', 'border-danger');
        }
    });

    // Email
    elementsEmail.forEach((element) => {
        if(!required.includes(element.id) && element.value.length === 0){
            element.classList.remove('border', 'border-danger');
        }else if(!element.value.includes('@') && !element.value.includes('.')){
            element.classList.add('border', 'border-danger');
            authorize = false;
            errorList.push(element.id + ' non è un email valida');
        }else{
            element.classList.remove('border', 'border-danger');
        }
    });

    // Number
    elementsNumber.forEach((element) => {
        if(!required.includes(element.id) && element.value.length === 0){
            element.classList.remove('border', 'border-danger');
        }else if(isNaN(element.value)){
            element.classList.add('border', 'border-danger');
            authorize = false;
            errorList.push(element.id + ' non è un valore numerico');
        }else if((element.id === 'telefono' && element.value.length > 20) || (element.id === 'telefono' && element.value.length < 10)){
            element.classList.add('border', 'border-danger');
            authorize = false;
            errorList.push(element.id + ' deve contenere almeno 10 e massimo 20 numeri');
        }else if(element.value.length > 255 || element.value.length < 1){
            element.classList.add('border', 'border-danger');
            authorize = false;
            errorList.push(element.id + ' deve contenere almeno 1 e massimo 255 numeri');
        }else{
            element.classList.remove('border', 'border-danger');
        }
    });

    // Text
    elementsBigText.forEach((element) => {
        if(!required.includes(element.id) && element.value.length === 0){
            element.classList.remove('border', 'border-danger');
        }else if(element.id === 'indirizzo' && element.value.length > 255  || element.value.length < 5){
            element.classList.add('border', 'border-danger');
            authorize = false;
            errorList.push(element.id + ' deve contenere almeno 5 e massimo 255 caratteri');
        }else{
            element.classList.remove('border', 'border-danger');
        }
    });

    if (authorize !== true) {
        event.preventDefault();
        alert.classList.remove('d-none');
        errorText.innerHTML = errorList.join('<br /> - ');
        errorList.length = 1;
    }
});
