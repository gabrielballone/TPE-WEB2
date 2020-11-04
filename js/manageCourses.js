document.addEventListener("DOMContentLoaded", initPage);

function initPage() {
    const image = document.querySelector("#imagenPreview");
    const inputFile = document.querySelector("#imagen");

    //al cambiar el estado del input, si se cargo una imagen
    //la carga en el src de la imagen oculta
    inputFile.addEventListener("change", () => {
        const archivos = inputFile.files;
        if (!archivos || !archivos.length) {
            return;
        }
        const primerArchivo = archivos[0];
        const objectURL = URL.createObjectURL(primerArchivo);
        image.src = objectURL;
    });
}