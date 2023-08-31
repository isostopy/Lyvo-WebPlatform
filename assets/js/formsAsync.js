// ****************************************************************
//   SISTEMA DE FORM DE FORMA ASYNCRONA CON AJAX
//   Este script permite enviar peticiones de forma
//   asíncrona con AJAX.
// ****************************************************************

function handleFormSubmission(formId, eventType) 
{
    document.getElementById(formId).addEventListener(eventType, function(event) 
    {
        event.preventDefault();

        let formData = new FormData(event.target);

        fetch(event.target.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            
            if (data.status === 'success') 
            {
                console.log(data.message);
            } 
            else 
            {
                alert(data.error);
            }
        })
        .catch(error => 
        {
            console.error('Error:', error);
        });
    });
}