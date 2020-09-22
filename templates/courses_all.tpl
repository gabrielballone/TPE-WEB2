{include file="templates/navbar.tpl"}
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <h1 class="my-4">Cursos</h1>
            <div class="list-group">
                <a href="courses.php" class="list-group-item active">Todos los cursos</a>
                {foreach from=$categories item=$category}
                    <a href="courses_category.php" class="list-group-item">{$category->nombre}</a>
                {/foreach}
            </div>
        </div>

        <div class="col-md-6 col-lg-9">
            <h1>Todos los cursos</h1>
            {foreach from=$categories item=$category}
                <h2>{$category->nombre}</h2>
                <hr>  
                {foreach from=$courses item=$course}
                    {if $course->id_categoria == $category->id}
                    <div class="card mt-4">
                        <img class="card-img-top img-fluid" src="images/java.jpg" alt="java">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{$course->nombre}</h3>
                                <a class="btn btn-info p-2" href="cursos/{$course->id}">Más info</a>
                            </div>
                            <h4>${$course->precio}</h4>
                            <h4>Duración en meses: {$course->duracion} </h4>
                            <p class="card-text">{$course->descripcion}</p>
                            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span> 4.0 stars
                        </div>
                    </div>
                    {/if}
                {/foreach}
            {/foreach}
        </div>

    </div>
</div>

{include file="templates/footer.tpl"}