{include file="templates/navbar.tpl" BASE_URL=BASE_URL}
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <h1 class="my-4">Categorias</h1>
            <div class="list-group">
                <a href="cursos" class="list-group-item font-weight-bold">Todos los cursos</a>
                {foreach from=$categories item=$category}
                    <a href="categorias/{$category->id}" class="list-group-item 
                    {if $category->id eq $course->id_categoria}
                        active
                    {/if}
                    ">{$category->nombre}</a>
                {/foreach}
            </div>
        </div>

        <div class="col-md-6 col-lg-9">
            {foreach from=$courses item=$course}
            <h1>{$course->nombre}</h1>
                <div class="card mt-4">
                    <img class="card-img-top img-fluid" src="https://placehold.it/900x350" alt="{$course->nombre}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-info p-2" href="cursos/{$course->id}">Más info</a>
                        </div>
                        <h4>Precio: ${$course->precio}</h4>
                        <h4>Duración en meses: {$course->duracion} </h4>
                        <p class="card-text">{$course->descripcion}</p>
                        <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span> 4.0 stars
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
</div>

{include file="templates/footer.tpl"}