async function uploadFiles(formId) 
{
    const formData = new FormData(document.getElementById(formId));

    try {
        const response = await fetch('../utils/uploaderFiles.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.text();
        document.getElementById('messages').innerHTML = result;

    } catch (error) {
        document.getElementById('messages').innerHTML = 'Error al subir el archivo.';
    }
}