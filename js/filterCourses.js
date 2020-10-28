document.addEventListener("DOMContentLoaded", initPage);

function initPage() {
    //declaracion de variables
    let formFilterCourses = document.querySelector("#formFilterCourses");
    let selectFiltro = document.querySelector("#filtro");
    // let selectOrden = document.querySelector("#orden");

    formFilterCourses.addEventListener("submit", checkValues);

    function checkValues(event) {
        if (selectFiltro.value === "sinfiltro") {
            event.preventDefault();
        }
    }
}