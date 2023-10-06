// Rellenar automáticamente el campo del email si tenemos un valor en local storage.
window.onload = function() {
    var storedEmail = localStorage.getItem('storedEmail');
    if (storedEmail) {
        document.getElementById("input-email").value = storedEmail;

        // Si hay elementos almacenados, seleccionamos automáticamente el checkbox.
        document.getElementById("remember").checked = true;
    }
}

// Función para guardar el usuario.
function RememberUser()
{
    var email = document.getElementById("input-email").value;
    var rememberCheckbox = document.getElementById("remember");

    // Verificar si el checkbox está seleccionado.
    if (rememberCheckbox.checked) {
        // Guardar el valor de email en el localStorage.
        localStorage.setItem('storedEmail', email);
    } else {
        // Si el checkbox no está seleccionado y quieres eliminar el email guardado previamente.
        localStorage.removeItem('storedEmail');
    }
}

// Accedemos al evento una vez se ha cargado la página. Si no se ha cargado completamente la página podemos tener un error.
document.addEventListener("DOMContentLoaded", function() 
{
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        RememberUser();
    });
});