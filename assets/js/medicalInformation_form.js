//buttons
var buttonNext;
var buttonBack;
var buttonEnd;

//pages
const pagesId = ["page_1","page_2","page_3"];
var pages = [];

var pageMarkerSuffix = "_marker";
var pagesMarkers = [];

//control
var currentPage = 0;


window.onload = function () {

    //inicialización de variables guardando el elemento que corresponda.

    //pages
    pages[0] = document.getElementById(pagesId[0]);
    pages[1] = document.getElementById(pagesId[1]);
    pages[2] = document.getElementById(pagesId[2]);

    pagesMarkers[0] = document.getElementById(pagesId[0] + pageMarkerSuffix);
    pagesMarkers[1] = document.getElementById(pagesId[1] + pageMarkerSuffix);
    pagesMarkers[2] = document.getElementById(pagesId[2] + pageMarkerSuffix);

    //buttons
    buttonNext = document.getElementById("button-next");
    buttonBack = document.getElementById("button-back");
    buttonEnd = document.getElementById("button-end");

    buttonNext.addEventListener('click', function(){showPageNext()})
    buttonBack.addEventListener('click', function(){showPagePrevious()})

    //inputs
    nombreInput = document.getElementById("nombre-input");
    apellidoInput = document.getElementById("apellido-input");

    //iconos check
    nombreCheckIcon = document.getElementById("nombre-check-icon");
    apellidoCheckIcon = document.getElementById("apellido-check-icon");

    showCurrentPage();
};

function showCurrentPage() 
{
    // Mostrar botones
    showButtons();

    for(let i = 0; i < pages.length; i++)
    {
        if(i === currentPage)
        {
            // Page
            pages[i].style.display = "flex";

            // Marker
            pagesMarkers[i].style.backgroundColor  = "#87b4a4";
            pagesMarkers[i].getElementsByTagName("p")[0].style.color = "white";
            pagesMarkers[i].getElementsByTagName("p")[0].style.fontWeight = "bold";
        }
        else
        {
            // Page
            pages[i].style.display = "none";

            // Marker
            pagesMarkers[i].style.backgroundColor  = "";
            pagesMarkers[i].getElementsByTagName("p")[0].style.color = "black";
            pagesMarkers[i].getElementsByTagName("p")[0].style.fontWeight = "100";
        }
    }
}

function showButtons()
{
    if (currentPage == 0) 
    {
        buttonNext.style.display = "block";
        buttonBack.style.display = "none";
        buttonEnd.style.display = "none";
    }
    else if(currentPage == pages.length - 1)
    {
        buttonNext.style.display = "none";
        buttonBack.style.display = "block";
        buttonEnd.style.display = "block";
    }
    else
    {
        buttonNext.style.display = "block";
        buttonBack.style.display = "block";
        buttonEnd.style.display = "none";
    }
}

function showPageNext() 
{
    if (currentPage < pages.length - 1) 
    {
        currentPage += 1;
        showCurrentPage();
    }
    else
    {  
        showEndButton();
    }
}

function showPagePrevious() 
{
    if (currentPage != 0) 
    {
        currentPage -= 1;
        showCurrentPage();
    } 
}