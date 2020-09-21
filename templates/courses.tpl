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

<!-- Footer -->
<footer class="py-5 bg-dark">
<div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; 2020 Cursando-online</p>
</div>
<!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>