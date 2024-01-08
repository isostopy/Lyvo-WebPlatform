// ****************************************************************
//   SISTEMA DE CONTROL DE LA SELECCIÓN DE AVATARES.
//   Este script sirve para controlar la selección de Avatares
//   Mediante cajas en HTML
// ****************************************************************

//control
var avatarButtons = [];
var avatarsId = ["avatar-1","avatar-2","avatar-3","avatar-4","avatar-5","avatar-6"];

const avatarsRPM = ["https://models.readyplayer.me/657c7762b6555802a3770db8.glb",
                    "https://models.readyplayer.me/6593caa39e1b858d3d3bdb95.glb",
                    "https://models.readyplayer.me/6593cdc39e1b858d3d3be232.glb",
                    "https://models.readyplayer.me/6593d7f144c97659297ccc66.glb",
                    "https://models.readyplayer.me/6593c9a59e1b858d3d3bd9b4.glb",
                    "https://models.readyplayer.me/6593cee544c97659297cb4f9.glb"];

var selectedAvatar;

var colorBase = "#e9f2ef";
var colorSelected = "#92c4b2";

window.onload = function () {

    // Mostrar paneles una vez haya cargado la página.
    var panelLoading = document.getElementById("Panel_AvatarLoading");
    panelLoading.style.display = "none";

    var panelAvatars = document.getElementById("Panel_AvatarSelection");
    panelAvatars.style.display = "flex";

    //inicialización de variables guardando el elemento que corresponda.
    
    //pages
    avatarButtons[0] = document.getElementById(avatarsId[0]);
    avatarButtons[1] = document.getElementById(avatarsId[1]);
    avatarButtons[2] = document.getElementById(avatarsId[2]);
    avatarButtons[3] = document.getElementById(avatarsId[3]);
    avatarButtons[4] = document.getElementById(avatarsId[4]);
    avatarButtons[5] = document.getElementById(avatarsId[5]);

    //input
    submitValue = document.getElementById("avatar-selected");

    //event listeners
    avatarButtons[0].addEventListener('click', function() { selectAvatar(avatarsRPM[0]); });
    avatarButtons[1].addEventListener('click', function() { selectAvatar(avatarsRPM[1]); });
    avatarButtons[2].addEventListener('click', function() { selectAvatar(avatarsRPM[2]); });
    avatarButtons[3].addEventListener('click', function() { selectAvatar(avatarsRPM[3]); });
    avatarButtons[4].addEventListener('click', function() { selectAvatar(avatarsRPM[4]); });
    avatarButtons[5].addEventListener('click', function() { selectAvatar(avatarsRPM[5]); });
    
    storedAvatar = localStorage.getItem('avatar');
    
    if(storedAvatar)
    {   
        selectAvatar(storedAvatar);
    }
    else
    {
        selectAvatar(avatarsRPM[0]);
    }
};

function selectAvatar(id) {

    submitValue.value = id;
    selectedAvatar = id;

    highlightSelected(id);
}

function highlightSelected(value)
{
    index = avatarsRPM.indexOf(value);

    for(let i = 0; i < avatarButtons.length; i++)
    {
        if(i===index)
        {
            avatarButtons[i].classList.add('button-avatar-selected');
            avatarButtons[i].classList.remove('avatar');
        }
        else
        {
            avatarButtons[i].classList.remove('button-avatar-selected');
            avatarButtons[i].classList.add('avatar');
        }
    }
}