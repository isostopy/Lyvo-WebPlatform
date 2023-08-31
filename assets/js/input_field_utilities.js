// ****************************************************************
//   SISTEMA DE UTILIDADES PARA LOS INPUT FIELDS
//   Este script dispone de funcionalidades para los campos
//   input para mostrar iconos, etc.
// ****************************************************************

// Field checker
function fieldChecker_Load(idInput, idIcon, condCharacters = null, condLength) 
{
    const input = document.getElementById(idInput);
    const icon = document.getElementById(idIcon);
    const characters = condCharacters 
        ? (Array.isArray(condCharacters) ? condCharacters : [condCharacters]) 
        : null;

    input.addEventListener('input', () => setVisibility(input, icon, characters, condLength));
    setVisibility(input, icon, characters, condLength);
}

function setVisibility(input, icon, characters, length) 
{
    const containsAllCharacters = characters 
        ? characters.every(char => input.value.includes(char)) 
        : true;

    if ((length && input.value.length < length) || !containsAllCharacters) 
    {
        icon.style.visibility = "hidden";
    } 
    else 
    {
        icon.style.visibility = "visible";
    }
}

// Pass display
function passDisplay_Load (idInput, idIconShow, idIconHide) {

    const input = document.getElementById(idInput);
    const iconShow = document.getElementById(idIconShow);
    const iconHide = document.getElementById(idIconHide);

    iconShow.addEventListener('click', () => togglePass(input, iconShow, iconHide));
    iconHide.addEventListener('click', () => togglePass(input, iconShow, iconHide));

}

function togglePass(input, iconShow, iconHide) {
    
    if(input.type === "password") 
    {
        input.type = "text";
        iconHide.style.visibility = "visible";
        iconShow.style.visibility = "hidden";
    } 
    else 
    {
        input.type = "password";
        iconHide.style.visibility = "hidden";
        iconShow.style.visibility = "visible";
    }
}