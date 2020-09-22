{include file="templates/navbar.tpl" BASE_URL=BASE_URL}
<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3 d-none d-md-block">
            <div class="position-fixed">
                <h1 class="my-4">Categorias</h1>
                <div class="list-group">
                    <a href="cursos" class="list-group-item active">Todos los cursos</a>
                    {foreach from=$categories item=$category}
                        <a href="categorias/{$category->id}" class="list-group-item">{$category->nombre}</a>
                    {/foreach}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-9">
            <div class="d-flex flex-wrap">
                {foreach from=$categories item=$category}
                    {foreach from=$courses item=$course}
                        {if $course->id_categoria == $category->id}
                            <div class="card m-2 anchoTarjetas">
                                <img src="https://placehold.it/900x350" class="card-img-top img-fluid" alt="">
                                <div class="card-body">
                                    <a href="categorias/{$category->id}">
                                        <h4><span class="badge badge-primary">{$category->nombre}</span></h4>
                                    </a>
                                    <h3 class="card-title">{$course->nombre}</h3>
                                    <h4>${$course->precio}</h4>
                                    <h4>Duración en meses: {$course->duracion} </h4>
                                    <p class="card-text">{$course->descripcion}</p>
                                    <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span> 4.0 stars
                                    <div class="text-center mt-2">
                                        <a class="btn btn-info p-2" href="cursos/{$course->id}">Más info</a>
                                    </div>
                                </div>
                            </div>
                        {/if}
                    {/foreach}
                {/foreach}
            </div>
        </div>
    </div>
</div>

{include file="templates/footer.tpl"}