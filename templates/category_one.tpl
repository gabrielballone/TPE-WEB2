{include file="templates/navbar.tpl"}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <h1 class="my-4">Categorías</h1>
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <a href="cursos" class="btn btn-link btn-block text-left" role="button" type="button">
                                Todos los cursos
                            </a>
                        </h2>
                    </div>
                </div>
                {foreach from=$categories item=$category}
                    <div class="card">
                        <div class="card-header" id="heading{$category->id}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{$category->id}" aria-expanded="false" aria-controls="collapse{$category->id}">
                                    <a href="categorias/{$category->id}" class="
                                    {if $category->id eq $categoryToShow->id}
                                        font-weight-bold
                                    {/if}">{$category->nombre}</a>
                                </button>
                            </h2>
                        </div>
                        <div id="collapse{$category->id}" class="collapse
                                                                        {if $category->id eq $categoryToShow->id}
                                                                                                            show
                                                                        {/if}" aria-labelledby="heading{$category->id}" data-parent="#accordionExample">
                            <div class="card-body">
                                {$category->descripcion}
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>

        <div class="col-md-6 col-lg-9">
            <h1>{$categoryToShow->descripcion}</h1>
            <div class="d-flex flex-wrap">
                {foreach from=$courses item=$course}
                    <div class="card m-2 anchoTarjetas">
                        <img src="images/new.png" class="imageCourseAll card-img-top img-fluid mx-auto" alt="">
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
                {/foreach}
            </div>
        </div>
    </div>
</div>

{include file="templates/footer.tpl"}