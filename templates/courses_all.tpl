{include file="templates/navbar.tpl"}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            {include file="templates/asideListCategories.tpl" showFilter=true datos=$datos categories=$categories idSelected="Todos" urlFilter="cursos"}
        </div>

        <div class="col-md-6 col-lg-9">
            <div class="d-flex flex-wrap">
                {foreach from=$courses item=$course}
                <div class="card m-2 anchoTarjetas">
                    {if $course->imagen}
                    <img src="{$course->imagen}" class="imageCourseAll card-img-top img-fluid mx-auto" alt="">
                    {else}
                    <img src="images/system/sin_imagen.jpg" class="imageCourseAll card-img-top img-fluid mx-auto" alt="">
                    {/if}
                    <div class="card-body">
                        <a href="categorias/{$course->id_categoria}">
                            <h4><span class="badge badge-primary">{$course->nombre_categoria}</span></h4>
                        </a>
                        <h3 class="card-title">{$course->nombre}</h3>
                        <h4>${$course->precio}</h4>
                        <h4>Duración: {$course->duracion} meses</h4>
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
                    <a href="cursos">Volver a ver todo</a>
                {/if}
                {/foreach}
            </div>
            {include file="templates/page.tpl" url="cursos" filter={$filter} numPage={$numPage} cantCursos={$courses|@count} amountPages={$amountPages} amountCourses={$amountCourses}}
        </div>
    </div>
</div>
<script src="js/filterCourses.js"></script>
{include file="templates/footer.tpl"}