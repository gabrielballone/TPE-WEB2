{include file="templates/navbar.tpl" BASE_URL=BASE_URL}
<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="position-fixed">
                <h1 class="my-4">Categorías</h1>
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
        </div>

        <div class="col-md-6 col-lg-9">
            <div class="card mt-4">
                <img class="card-img-top img-fluid" src="https://placehold.it/900x350" alt="{$course->nombre}">
                <div class="card-body">
                    <h3 class="card-title">{$course->nombre}</h3>
                    <h4>Precio: ${$course->precio}</h4>
                    <h4>Duración en meses: {$course->duracion} </h4>
                    <p class="card-text">{$course->descripcion}</p>
                    <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span> 4.0 stars
                </div>
                {* Comentarios del curso
                *}
                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Product Reviews
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint
                            natus.
                        </p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint
                            natus.
                        </p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint
                            natus.
                        </p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <a href="#" class="btn btn-success">Leave a Review</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>

    {include file="templates/footer.tpl"}