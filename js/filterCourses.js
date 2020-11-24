document.addEventListener("DOMContentLoaded", initPage);

function initPage() {
    //declaracion de variables
    let formFilterCourses = document.querySelector("#formFilterCourses");
    let selectFiltro = document.querySelector("#filtro");
    let searchText = document.querySelector("#searchText");
    let searchNumber = document.querySelector("#searchNumber");
    let inputTexto = document.querySelector("#texto");
    let inputMin = document.querySelector("#min");
    let inputMax = document.querySelector("#max");

    //asignacion de eventos
    formFilterCourses.addEventListener("submit", checkValues);
    selectFiltro.addEventListener("change", changeSearch);

    function checkValues(event) {
        //previene envio normal del form porque sino manda ambos parametros get texto y numero
        event.preventDefault();

        let urlFormFilter = formFilterCourses.action;
        urlFormFilter += `?filtro=${selectFiltro.value}`;
        switch (selectFiltro.value) {
            case "sinfiltro":
                return;
                break;
            case "nombre":
                urlFormFilter += `&texto=${inputTexto.value}`;
                break;
            case "duracion": //duracion y precio hacen lo mismo
            case "precio":
                if (!isNaN(parseInt(inputMin.value))) {
                    urlFormFilter += `&min=${inputMin.value}`;
                }
                if (!isNaN(parseInt(inputMax.value))) {
                    urlFormFilter += `&max=${inputMax.value}`;
                }
                break;
        }
        location = urlFormFilter;
    }

    function changeSearch() {
        switch (selectFiltro.value) {
            case "sinfiltro":
                searchText.classList.add("d-none");
                searchNumber.classList.add("d-none");
                break;
            case "nombre":
                searchText.classList.remove("d-none");                
                searchNumber.classList.add("d-none");
                inputTexto.focus();
                break;
            case "duracion":
                searchText.classList.add("d-none");
                searchNumber.classList.remove("d-none");
                inputMin.focus();
                break;
            case "precio":
                searchText.classList.add("d-none");
                searchNumber.classList.remove("d-none");
                inputMin.focus();
                break;
        }
    }
}