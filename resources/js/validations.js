const required = ["nome", "cognome"];

/*
curriculum
photo
*/

function setErrorText(element, errorText, arrayText){
    arrayText.forEach((elementArray) => {
        if(elementArray.id === `errore-${element.id}`){
            elementArray.innerText = errorText;
            elementArray.classList.remove('d-none');
        }
    });
}

const elementsText = [];
const elementsEmail = [];
const elementsNumber = [];
const elementsBigText = [];

const form = document.getElementById('form');
const submit = document.getElementById('submit');

const arrayErrorText = [];
arrayErrorText.push(document.getElementById('errore-nome'));
arrayErrorText.push(document.getElementById('errore-cognome'));
arrayErrorText.push(document.getElementById('errore-telefono'));
arrayErrorText.push(document.getElementById('errore-indirizzo'));
arrayErrorText.push(document.getElementById('errore-descrizione'));

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
            setErrorText(element, element.id + ' deve contenere almeno 3 e massimo 20 caratteri', arrayErrorText);
        }else if(/[^a-zA-Z]/.test(element.value)){
            element.classList.add('border', 'border-danger');
            authorize = false;
            setErrorText(element, element.id + ' deve contenere solo caratteri alfabetici', arrayErrorText);
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
            setErrorText(element, element.id + ' non è un email valida', arrayErrorText);
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
            setErrorText(element, element.id + ' non è un valore numerico', arrayErrorText);
        }else if((element.id === 'telefono' && element.value.length > 20) || (element.id === 'telefono' && element.value.length < 10)){
            element.classList.add('border', 'border-danger');
            authorize = false;
            setErrorText(element, element.id + ' deve contenere almeno 10 e massimo 20 numeri', arrayErrorText);
        }else if(element.value.length > 255 || element.value.length < 1){
            element.classList.add('border', 'border-danger');
            authorize = false;
            setErrorText(element, element.id + ' deve contenere almeno 1 e massimo 255 numeri', arrayErrorText);
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
            setErrorText(element, element.id + ' deve contenere almeno 5 e massimo 255 caratteri', arrayErrorText);
        }else{
            element.classList.remove('border', 'border-danger');
        }
    });

    if (authorize !== true) {
        event.preventDefault();
    }
});
