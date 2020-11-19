<div class="card card-outline-secondary my-4">
    <div class="card-header">
        <p class="h2">Comentarios</p>
    </div> 
    <div class="card-body pb-0">
        <div id="containerComments">
            <p>Cargando comentarios...</p>
        </div>
    </div>
    {if $smarty.session}
        <div class="card-header">
            <p class="h3">Dejar un comentario</p>
        </div>
        <div class="card-body">
            <form method="POST" id="formAddComment">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="contenido">Contenido</label>
                    <input type="text" name="contenido" id="contenido" class="form-control" required minlength="5" maxlength="255">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="puntuacion">Puntuacion</label>
                    <select class="custom-select" name="puntuacion" id="puntuacion">
                        <option value="1" selected>1 estrella &#9733;</option>
                        <option value="2">2 estrellas &#9733; &#9733;</option>
                        <option value="3">3 estrellas &#9733; &#9733; &#9733;</option>
                        <option value="4">4 estrellas &#9733; &#9733; &#9733; &#9733;</option>
                        <option value="5">5 estrellas &#9733; &#9733; &#9733; &#9733; &#9733;</option>
                    </select>
                    <button type="submit" class="btn btn-success w-25">Comentar</button>
                </div>
                <p class="text-warning" id="alertMessage"></p>
            </form>
        </div>
    {else}
    <form id="formAddComment"></form>
    {/if}
</div>