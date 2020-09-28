{include file="templates/navbar.tpl"}
<div class="container">
    <h1 class="text-center">Administrar cursos</h1>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin mb-5">
                <div class="card-body">
                    {* Si el $course es falso muestra modo carga nuevo curso  *}
                    {if !$course}
                        <h5 class="card-title text-center">Nuevo</h5>
                        <form class="form-signin" action="cursos/nuevo" method="POST">
                            <label for="nombre">Nombre</label>
                            <input name="nombre" type="text" class="form-control mb-2" required>

                            <label for="descripcion">Descripción</label>
                            <input name="descripcion" type="text" class="form-control mb-2" required>

                            <label for="duracion">Duración en meses</label>
                            <input name="duracion" type="number" class="form-control mb-2" required>

                            <label for="precio">Precio</label>
                            <input name="precio" type="number" class="form-control mb-2" required>

                            <label for="categoria">Categoría</label>
                            <select class="form-control mb-2" name="categoria">
                                {foreach from=$categories item=$category}
                                    <option value="{$category->id}">{$category->nombre}</option> 
                                {/foreach}
                            </select>
                            <button class="btn btn-lg btn-success btn-block mb-2" type="submit">Agregar</button>
                        </form>
                    {* Si $course tiene un curso muestra modo modificar y carga los inputs  *}
                    {else}  
                        <h5 class="card-title text-center">Editar</h5>                      
                        <form class="form-signin" action="cursos/modificar/{$course->id}" method="POST">
                            <label for="nombre">Nombre</label>
                            <input name="nombre" type="text" class="form-control mb-2" value="{$course->nombre}" required>

                            <label for="descripcion">Descripción</label>
                            <input name="descripcion" type="text" class="form-control mb-2" value="{$course->descripcion}" required>

                            <label for="duracion">Duración en meses</label>
                            <input name="duracion" type="number" class="form-control mb-2" value="{$course->duracion}" required>

                            <label for="precio">Precio</label>
                            <input name="precio" type="number" class="form-control mb-2" value="{$course->precio}" required>

                            <label for="categoria">Categoría</label>
                            <select class="form-control mb-2" name="categoria">
                                {foreach from=$categories item=$category}
                                    {if $course->id_categoria == $category->id}
                                        <option value="{$category->id}" selected>{$category->nombre}</option> 
                                    {else}
                                        <option value="{$category->id}">{$category->nombre}</option> 
                                    {/if}
                                {/foreach}
                            </select>
                            <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Modificar</button>
                            <a href="cursos/administrar" class="btn btn-lg btn-danger btn-block mb-2">Cancelar</a>
                        </form>
                    {/if}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$courses item=$itemCourse}
                        <tr>
                            <td>{$itemCourse->nombre}</td>
                            <td>{$itemCourse->descripcion}</td>
                            <td>{$itemCourse->duracion}</td>
                            <td>{$itemCourse->precio}</td>
                            <td>{$itemCourse->id_categoria}-{$itemCourse->nombre_categoria}</td>
                            <td><a href="cursos/modificar/{$itemCourse->id}"><img src="images/editar.png" alt="editar"/></a></td>
                            <td><a href="cursos/eliminar/confirmar/{$itemCourse->id}"><img src="images/eliminar.png" alt="eliminar"/></a></td>    
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file="templates/footer.tpl"}