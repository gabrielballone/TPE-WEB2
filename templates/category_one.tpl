{include file="templates/navbar.tpl"}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            {include file="templates/asideListCategories.tpl" showFilter=false categories=$categories idSelected=$categoryToShow->id urlFilter="categorias/{$categoryToShow->id}"}
        </div>

        <div class="col-md-6 col-lg-9">
            <h1>{$categoryToShow->descripcion}</h1>
            <div class="d-flex flex-wrap">
                {foreach from=$courses item=$course}
                <div class="card m-2 anchoTarjetas">
                    {if $course->imagen}
                        <img src="{$course->imagen}" class="imageCourseAll card-img-top img-fluid mx-auto" alt="">
                    {else}
                        <img src="images/system/sin_imagen.jpg" class="imageCourseAll card-img-top img-fluid mx-auto" alt="">
                    {/if}                    
                    <div class="card-body">
                        <h4><span class="badge badge-primary">{$categoryToShow->nombre}</span></h4>
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
                    <a href="categorias/{$categoryToShow->id}">Volver a la primera página</a>
                {/if}
                {/foreach}
            </div>
            {include file="templates/page.tpl" url="categorias/{$categoryToShow->id}" filter={$filter} numPage={$numPage} cantCursos={$courses|@count} amountCourses={$amountCourses} amountPages={$amountPages}}
        </div>
    </div>
</div>
<script src="js/filterCourses.js"></script>
{include file="templates/footer.tpl"}