function toggleElement(idElemento) 
{

    console.log(idElemento);

    var elemento = document.getElementById(idElemento);

    // Alternar la visibilidad del elemento
    if (elemento.style.display === 'none' || elemento.style.display === '') 
    {
        elemento.style.display = 'flex';
    } 
    else 
    {
        elemento.style.display = 'none';
    }
}