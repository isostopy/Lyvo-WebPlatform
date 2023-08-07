//inputs
var emailInput;
var passInput;

//iconos check
var emailCheckIcon;

//iconos contraseña
var passShowIcon;
var passHideIcon;

window.onload = function () 
{
    //inicialización de variables guardando el elemento que corresponda.

    //inputs
    emailInput = document.getElementById("email-input");
    passInput = document.getElementById("pass-input");

    //iconos check
    emailCheckIcon = document.getElementById("email-check-icon");

    //iconos contraseña
    passShowIcon = document.getElementById("show-pass-icon");
    passHideIcon = document.getElementById("hide-pass-icon");

    //event listeners
    emailInput.addEventListener('input', setEmailIconVisibility);

    setEmailIconVisibility();
};

function setEmailIconVisibility()
{
    if(emailInput.value.length == 0)
    {
        emailCheckIcon.style.visibility = "hidden";
    }
    else
    {
        emailCheckIcon.style.visibility = "visible";
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