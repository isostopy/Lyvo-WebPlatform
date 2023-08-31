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

document.getElementById('filterButton').addEventListener('input', function(e) 
{
    const value = e.target.value.toLowerCase();

    document.querySelectorAll('button.button-general').forEach(button => {

        if (button.textContent.toLowerCase().includes(value)) 
        {
            button.style.display = '';
        }
        else 
        {
            button.style.display = 'none';
        }
    });
});