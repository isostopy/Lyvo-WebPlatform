// Field checker
function fieldChecker_Load(idInput, idIcon, condCharacters, condLength) 
{
    const input = document.getElementById(idInput);
    const icon = document.getElementById(idIcon);
    const characters = condCharacters;
    const length = condLength;

    input.addEventListener('input', () => setVisibility(input, icon, characters, length));
    setVisibility(input, icon, characters, length);
}

function setVisibility(input, icon, characters, length) 
{
    if ((length && input.value.length < length) || (characters && !input.value.includes(characters))) 
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