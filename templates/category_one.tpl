{include file="templates/navbar.tpl"}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            {include file="templates/asideListCategories.tpl" showFilter=true categories=$categories idSelected=$categoryToShow->id urlFilter="categorias/{$categoryToShow->id}"}
        </div>

        <div class="col-md-6 col-lg-9">
            <h1>{$categoryToShow->descripcion}</h1>
            <div class="d-flex flex-wrap">
                {foreach from=$courses item=$course}
                <div class="card m-2 anchoTarjetas">
                    <img src="images/system/new.png" class="imageCourseAll card-img-top img-fluid mx-auto" alt="">
                    <div class="card-body">
                        <h4><span class="badge badge-primary">{$categoryToShow->nombre}</span></h4>
                        <h3 class="card-title">{$course->nombre}</h3>
                        <h4>${$course->precio}</h4>
                        <h4>Duración en meses: {$course->duracion} </h4>
                        <p class="card-text">{$course->descripcion}</p>
                        <div class="text-center mt-2">
                            <a class="btn btn-info p-2" href="cursos/{$course->id}">Más info</a>
                        </div>
                    </div>
                </div>
                {foreachelse}
                {if $numPage == 1}
                    <h2>Aún no hay cursos disponibles para esta categoría</h2>
                {else}
                    <h2>En la página solicitada no hay cursos disponibles. Prueba con otra página.</h2>
                {/if}
                {/foreach}
            </div>
            {include file="templates/page.tpl" url="categorias/{$categoryToShow->id}" numPage={$numPage} cantCursos={$courses|@count} amountPages={$amountPages}}
        </div>
    </div>
</div>
<script src="js/filterCourses.js"></script>
{include file="templates/footer.tpl"}