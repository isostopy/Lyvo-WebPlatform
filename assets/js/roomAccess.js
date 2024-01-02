//*******************************************************************************************************
// IMPORTANTE IMPORTANTE IMPORTANTE
//
// En este script pasamos todo a "FormData" aunque sea un objeto de JS para hacer las solicitudes a PHP.
// Así damos consistencia al uso de formularios.
//
//*******************************************************************************************************


async function postPHP_form(formId) 
{
    const formData = new FormData(document.getElementById(formId));

    try {
        const response = await fetch('../utils/room_access.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.text();
        //document.getElementById('messages_Pass').innerHTML = result;

        console.log(result);

    } catch (error) {
        //document.getElementById('messages_Pass').innerHTML = 'Se ha producido un error al cambiar la contraseña.';

        console.log(error);
    }
}

async function postPHP(content, element) 
{
    var formData = new FormData();

    // Recorrer el objeto y agregar cada propiedad al FormData
    for (var key in content) {
        if (content.hasOwnProperty(key)) {
            formData.append(key, content[key]);
        }
    }

    try {
        const response = await fetch('../utils/room_access.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.text();

        console.log("La respuesta es: " + result);

        document.getElementById(element).innerHTML = result;

    } catch (error) {
        //document.getElementById('messages_Pass').innerHTML = 'Se ha producido un error al cambiar la contraseña.';

        console.log(error);
    }
}