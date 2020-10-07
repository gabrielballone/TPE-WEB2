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
                                            {if $category->id eq $course->id_categoria}
                                                font-weight-bold
                                            {/if}">{$category->nombre}</a>
                                </button>
                            </h2>
                        </div>
                        <div id="collapse{$category->id}" class="collapse
                                                                            {if $category->id eq $course->id_categoria}
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
            <div class="card mt-4">
                <img class="imageCourseOne card-img-top img-fluid mx-auto" src="images/new.png" alt="{$course->nombre}">
                <div class="card-body">
                    <a href="categorias/{$course->id_categoria}">
                        <h4><span class="badge badge-primary">{$course->categoria_nombre}</span></h4>
                    </a>
                    <h3 class="card-title">{$course->nombre}</h3>
                    <h4>Precio: ${$course->precio}</h4>
                    <h4>Duración en meses: {$course->duracion} </h4>
                    <p class="card-text">{$course->descripcion}</p>
                </div>                
            </div>
        </div>
    </div>

    {include file="templates/footer.tpl"}