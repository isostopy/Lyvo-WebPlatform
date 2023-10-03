// ****************************************************************
//   SISTEMA DE FILTRADO PARA PANELES DE ADMINISTRACIÓN
//   Este script sirve para controlar el filtrado.
// ****************************************************************

document.getElementById('filterDivSelect').addEventListener('change', function(e) 
{
    const selectedValue = e.target.value;

    ['empresas', 'profesionales', 'clientes'].forEach(id => {

        const div = document.getElementById(id);

        if (selectedValue === "" || id === selectedValue) 
        {
            div.style.display = '';
        } 
        else 
        {
            div.style.display = 'none';
        }
    });
});

document.getElementById('inputFilterUser').addEventListener('input', function(e) 
{
    const value = e.target.value.toLowerCase();

    document.querySelectorAll('.userListElement').forEach(container => {
        
        // Aquí, buscamos el enlace dentro de cada contenedor
        const link = container.querySelector('a');
        
        if (link.textContent.toLowerCase().includes(value)) {
            container.style.display = '';
        } else {
            container.style.display = 'none';
        }
    });
});