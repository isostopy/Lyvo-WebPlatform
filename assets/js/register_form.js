
//inputs
var emailInput;
var contraseñaInput;
var nombreInput;
var apellidoInput;

//iconos check
var emailCheckIcon;
var contraseñaCheckIcon;
var nombreCheckIcon;
var inputCheckIcon;

//iconos contraseña
var verContraseñaIcon;
var ocultarContraseñaInput;

window.onload = function () {

    //inicialización de variables guardando el elemento que corresponda.

    //inputs
    emailInput = document.getElementById("email-input");
    contraseñaInput = document.getElementById("contraseña-input");
    nombreInput = document.getElementById("nombre-input");
    apellidoInput = document.getElementById("apellido-input");

    //iconos check
    emailCheckIcon = document.getElementById("email-check-icon");
    contraseñaCheckIcon = document.getElementById("contraseña-check-icon");
    nombreCheckIcon = document.getElementById("nombre-check-icon");
    apellidoCheckIcon = document.getElementById("apellido-check-icon");

    //iconos contraseña
    verContraseñaIcon = document.getElementById("eye-icon");
    ocultarContraseñaInput = document.getElementById("eye-icon-slash");

    //event listeners
    emailInput.addEventListener('input' , setEmailIconVisibility);
    contraseñaInput.addEventListener('input', setContraseñaIconVisibility)
    nombreInput.addEventListener('input', setnombreIconVisibility)
    apellidoInput.addEventListener('input', setApellidoIconVisibility)
};


function setEmailIconVisibility(){
    if(emailInput.value.length < 3){
        emailCheckIcon.style.visibility = "hidden";
    }else{
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

function setnombreIconVisibility(){
    if(nombreInput.value.length < 3){
        nombreCheckIcon.style.visibility = "hidden";
    }else{
        nombreCheckIcon.style.visibility = "visible";
    }
}

function setApellidoIconVisibility(){
    if(apellidoInput.value.length < 3){
        apellidoCheckIcon.style.visibility = "hidden";
    }else{
        apellidoCheckIcon.style.visibility = "visible";
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
