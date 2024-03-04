const required = ['name', 'surname'];
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
const form = document.getElementById('form');
const submit = document.getElementById('submit');

elementsText.push(document.getElementById('name'));
elementsText.push(document.getElementById('surname'));
elementsNumber.push(document.getElementById('phone'));
elementsBigText.push(document.getElementById('address'));
elementsBigText.push(document.getElementById('performance'));

submit.addEventListener('click', (event) => {
    let authorize = true;
    let skip = false;
    // Small Text
    elementsText.forEach((element) => {
        if(!required.includes(element.id) && element.value.length === 0){
            element.classList.remove('border', 'border-danger');
        }else if(element.value.length < 3 || element.value.length > 20){
            element.classList.add('border', 'border-danger');
            authorize = false;
        }else if(/[^a-zA-Z]/.test(element.value)){
            element.classList.add('border', 'border-danger');
            authorize = false;
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
        }else if((element.id === 'phone' && element.value.length > 20) || (element.id === 'phone' && element.value.length < 10)){
            element.classList.add('border', 'border-danger');
            authorize = false;
        }else if(element.value.length > 255 || element.value.length < 1){
            element.classList.add('border', 'border-danger');
            authorize = false;
        }else{
            element.classList.remove('border', 'border-danger');
        }
    });

    // Text
    elementsBigText.forEach((element) => {
        if(!required.includes(element.id) && element.value.length === 0){
            element.classList.remove('border', 'border-danger');
        }else if(element.id === 'address' && element.value.length > 255  || element.value.length < 5){
            element.classList.add('border', 'border-danger');
            authorize = false;
        }else{
            element.classList.remove('border', 'border-danger');
        }
    });
    
    if(authorize !== true){
        event.preventDefault();
        alert.classList.remove('d-none');
        errorText.innerText = 'Campi non validi';
    }
});