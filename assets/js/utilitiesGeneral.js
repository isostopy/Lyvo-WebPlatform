
// Muestra o elimina un elemento según su id.
function RemoveElementById(id, status) 
{
    // Buscamos el elemento con el id proporcionado
    var element = document.getElementById(id);

    // Verificamos si el elemento existe
    if (element) 
    {
        if(status)
        {
            element.style.display = '';
        }
        else
        {
            element.remove();
        }
    }
}