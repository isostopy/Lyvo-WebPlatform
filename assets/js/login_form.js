var emailInput;
var contraseñaInput;

var emailCheckIcon;
var contraseñaCheckIcon;

var verContraseñaIcon;
var ocultarContraseñaInput;

window.onload = function () 
{
    emailInput = document.getElementById("email-input");
    contraseñaInput = document.getElementById("contraseña-input");

    emailCheckIcon = document.getElementById("email-check-icon");
    contraseñaCheckIcon = document.getElementById("contraseña-check-icon");
    verContraseñaIcon = document.getElementById("eye-icon");
    ocultarContraseñaInput = document.getElementById("eye-icon-slash");

    emailInput.addEventListener('input' , setEmailIconVisibility);
    contraseñaInput.addEventListener('input', setContraseñaIconVisibility)
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

function setContraseñaIconVisibility(){
    if(contraseñaInput.value.length < 6){
        contraseñaCheckIcon.style.visibility = "hidden";
    }else{
        contraseñaCheckIcon.style.visibility = "visible";
    }
}

function mostrarContrasena(){

    if(contraseñaInput.type == "password"){
        contraseñaInput.type = "text";
        verContraseñaIcon.style.visibility = "visible";
        ocultarContraseñaInput.style.visibility = "hidden";
    }else{
        contraseñaInput.type = "password";
        verContraseñaIcon.style.visibility = "hidden";
        ocultarContraseñaInput.style.visibility = "visible";
    }
}
