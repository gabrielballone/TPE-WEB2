document.addEventListener("DOMContentLoaded", initPage);

function initPage() {
    const urlApiComments = "api/comentarios/usuario/";
    const containerComments = document.querySelector("#containerComments");
    let idUser = document.querySelector("body").dataset.iduser;

    //pedir comentarios del usuario a la API y cargarlos en el div contenedor
    getComments();

    function getComments() {
        fetch(urlApiComments + idUser)
            .then(function(response) {
                if (response.ok) {
                    response.json().then(function(comments) {
                        containerComments.innerHTML = "";
                        comments.forEach((comment) => {
                            addCommentToContainer(comment);
                        });
                        document.querySelectorAll(".deleteComment").forEach((btn) => {
                            btn.addEventListener("click", deleteComment);
                        });
                    });
                } else {
                    // containerFilters.innerHTML = "";
                    containerComments.innerHTML =
                        "<p>Aun no hay comentarios para este curso<p><hr/>";
                    console.log(response);
                }
            })
            .catch(function(response) {
                console.log(response);
            });
    }

    function addCommentToContainer(comment) {
        containerComments.innerHTML += `
        <div>
        <hr>
        <p class="h2">Curso: ${comment.nombre_curso}</p>
        <span class="text-warning">${calculateTextStars(
          comment.puntuacion
        )}</span> ${comment.puntuacion} estrellas
        <p>${comment.contenido}</p>
        <small class="text-muted mr-2">Fecha: ${comment.fecha}</small>
        </div>`;
    }

    function calculateTextStars(quantityStars) {
        let textStars = "";
        for (let i = 1; i <= quantityStars; i++) {
            textStars += " &#9733;";
        }
        for (let i = 1; i <= 5 - quantityStars; i++) {
            textStars += " &#9734;";
        }
        return textStars;
    }
}