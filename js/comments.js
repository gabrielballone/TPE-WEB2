document.addEventListener("DOMContentLoaded", initPage);


function initPage() {

    //obtener el role del ususario para saber si mustra boton Borrar
    let userIsAdmin = document.querySelector("body").dataset.role;
    //obtener el id del curso actual desde el dataset en el HTML
    let idCourse = document.querySelector("div.container-fluid").dataset.idcourse;

    //declaracion constantes rutas URL de la API
    const urlApiComments = "api/comentarios/";

    //declaracion de variables
    let containerComments = document.querySelector("#containerComments");
    // let containerFilters = document.querySelector("#containerFilters");
    let formAddComment = document.querySelector("#formAddComment");
    let content = document.querySelector("#contenido");
    let score = document.querySelector("#puntuacion");

    formAddComment.addEventListener('submit', checkAddComment);

    //pedir comentarios a la API y cargarlos en el div contenedor de comentarios
    getComments();

    function getComments() {
        fetch(urlApiComments + idCourse)
            .then(function(response) {
                if (response.status == 200) {
                    response.json().then(function(comments) {
                        containerComments.innerHTML = "";
                        comments.forEach(comment => {
                            addCommentToContainer(comment);
                        });
                        document.querySelectorAll(".deleteComment").forEach(btn => {
                            btn.addEventListener("click", deleteComment);
                        });
                    });
                } else {
                    // containerFilters.innerHTML = "";
                    containerComments.innerHTML = "<p>Aun no hay comentarios para este curso<p><hr/>";
                }
            })
            .catch(function(response) {
                console.log(response);
            });
    }

    function addCommentToContainer(comment) {
        containerComments.innerHTML += `
        <div>
            <span class="text-warning">${calculateTextStars(comment.puntuacion)}</span><small> (${comment.puntuacion} estrella${comment.puntuacion > 1 ? 's': ''})</small>
        <p>${comment.contenido}</p>
            <small class="text-muted mr-2">Autor: ${comment.email} - Fecha: ${comment.fecha}</small>`;
        if (userIsAdmin == 1) {
            containerComments.innerHTML += `<button id="${comment.id}" class="btn btn-danger inline deleteComment">Borrar comentario</button>`;
        }

        containerComments.innerHTML += ` <hr></div>`;
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

    /*
    / Agregar nuevo comentario via API desde los datos del form.
    / Primero se comprueban los datos sean validos y luego se realiza el fetch.
    */
    function checkAddComment(event) {
        event.preventDefault();

        let alertMessage = document.querySelector("#alertMessage");

        //Se comprueba que contenido y puntuacion sean validos si no cancela y muestra mensaje
        if (content.value == "") {
            alertMessage.innerHTML = 'Atención: No puede enviar un comentario vacío';
            return;
        }
        let data = {
            contenido: content.value,
            puntuacion: score.value,
            id_curso: idCourse,
        }
        newComment(data);
    }

    function newComment(data) {
        fetch(urlApiComments, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            })
            .then(function(response) {
                if (response.ok) {
                    getComments();
                    content.value = "";
                    score.value = 1;
                } else {
                    console.log(response);
                }
            })
            .catch(function(response) {
                console.log(response);
            });
    }

    function deleteComment(event) {
        let idComment = event.srcElement.id;
        fetch(urlApiComments + idComment, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' }
            })
            .then(function(response) {
                if (response.ok) {
                    response.text().then(function(text) {
                        console.log(text);
                        getComments();
                    });
                } else {
                    console.log(response);
                }
            })
            .catch(function(response) {
                console.log(response);
            });
    }
}