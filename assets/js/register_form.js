//inputs
var nameInput;
var surnameInput;
var emailInput;
var passInput;

//iconos check
var nameCheckIcon;
var surnameCheckIcon;
var emailCheckIcon;
var passCheckIcon;

//iconos contraseña
var passShowIcon;
var passHideIcon;

window.onload = function () {

    //inicialización de variables guardando el elemento que corresponda.

    //inputs
    nameInput = document.getElementById("name-input");
    surnameInput = document.getElementById("surname-input");
    emailInput = document.getElementById("email-input");
    passInput = document.getElementById("pass-input");
    
    //iconos check
    nameCheckIcon = document.getElementById("name-check-icon");
    surnameCheckIcon = document.getElementById("surname-check-icon");
    emailCheckIcon = document.getElementById("email-check-icon");
    passCheckIcon = document.getElementById("pass-check-icon");

    //iconos contraseña
    passShowIcon = document.getElementById("show-pass-icon");
    passHideIcon = document.getElementById("hide-pass-icon");

    //event listeners
    nameInput.addEventListener('input', setNameIconVisibility)
    surnameInput.addEventListener('input', setSurnameIconVisibility)
    emailInput.addEventListener('input', setEmailIconVisibility);
    passInput.addEventListener('input', setPassIconVisibility)

    setNameIconVisibility();
    setSurnameIconVisibility();
    setEmailIconVisibility();
    setPassIconVisibility();

};

function setNameIconVisibility(){
    if(nameInput.value.length < 3){
        nameCheckIcon.style.visibility = "hidden";
    }else{
        nameCheckIcon.style.visibility = "visible";
    }
}

function setSurnameIconVisibility(){
    if(surnameInput.value.length < 3){
        surnameCheckIcon.style.visibility = "hidden";
    }else{
        surnameCheckIcon.style.visibility = "visible";
    }
}

function setEmailIconVisibility(){

    if(emailInput.value.length < 3 || !emailInput.value.includes('@'))
    {
        emailCheckIcon.style.visibility = "hidden";
    }
    else
    {
        emailCheckIcon.style.visibility = "visible";
    }
}

function setPassIconVisibility()
{
    if(passInput.value.length < 6){
        passCheckIcon.style.visibility = "hidden";
    }else{
        passCheckIcon.style.visibility = "visible";
    }
}

function showPass()
{
    if(passInput.type == "password")
    {
        passInput.type = "text";
        passHideIcon.style.visibility = "visible";
        passShowIcon.style.visibility = "hidden";
    }
    else
    {
        passInput.type = "password";
        passHideIcon.style.visibility = "hidden";
        passShowIcon.style.visibility = "visible";
    }
}
