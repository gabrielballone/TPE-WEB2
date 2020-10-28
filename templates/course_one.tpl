{include file="templates/navbar.tpl"}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            {include file="templates/asideListCategories.tpl" showFilter=false categories=$categories idSelected=$course->id_categoria urlFilter="cursos/{$course->id}"}
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

            {include file="templates/comments.tpl"}
        </div>
    </div>
</div>
</div>
</div>
<script src="js/comments.js"></script>
{include file="templates/footer.tpl"}