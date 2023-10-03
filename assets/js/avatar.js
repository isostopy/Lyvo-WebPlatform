// ****************************************************************
//   SISTEMA DE CONTROL DE LA SELECCIÓN DE AVATARES.
//   Este script sirve para controlar la selección de Avatares
//   Mediante cajas en HTML
// ****************************************************************

//control
var avatars = [];
const avatarsId = ["avatar-1","avatar-2","avatar-3","avatar-4","avatar-5","avatar-6"];
var selectedAvatar;

var colorBase = "#e9f2ef";
var colorSelected = "#92c4b2";

window.onload = function () {

    //inicialización de variables guardando el elemento que corresponda.
    
    //pages
    avatars[0] = document.getElementById(avatarsId[0]);
    avatars[1] = document.getElementById(avatarsId[1]);
    avatars[2] = document.getElementById(avatarsId[2]);
    avatars[3] = document.getElementById(avatarsId[3]);
    avatars[4] = document.getElementById(avatarsId[4]);
    avatars[5] = document.getElementById(avatarsId[5]);

    //input
    submitValue = document.getElementById("avatar-selected");

    //event listeners
    avatars[0].addEventListener('click', function() { selectAvatar(avatarsId[0]); });
    avatars[1].addEventListener('click', function() { selectAvatar(avatarsId[1]); });
    avatars[2].addEventListener('click', function() { selectAvatar(avatarsId[2]); });
    avatars[3].addEventListener('click', function() { selectAvatar(avatarsId[3]); });
    avatars[4].addEventListener('click', function() { selectAvatar(avatarsId[4]); });
    avatars[5].addEventListener('click', function() { selectAvatar(avatarsId[5]); });

    
    storedAvatar = localStorage.getItem('avatar');
    if(storedAvatar){selectAvatar(storedAvatar)}
};

function selectAvatar(id) {

    submitValue.value = id;
    selectedAvatar = id;

    highlightSelected(id);
}

function highlightSelected(value)
{
    index = avatarsId.indexOf(value);

    for(let i = 0; i < avatars.length; i++)
    {
        if(i===index)
        {
            avatars[i].classList.add('button-avatar-selected');
            avatars[i].classList.remove('avatar');
        }
        else
        {
            avatars[i].classList.remove('button-avatar-selected');
            avatars[i].classList.add('avatar');
        }
    }
}