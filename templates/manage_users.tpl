{include file="templates/navbar.tpl"}
<div class="container">
    <h1 class="text-center">Administrar usuarios</h1>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin mb-5">
                <div class="card-body">
                    {* {if !$category}
                        <h5 class="card-title text-center">Nueva</h5>
                        <form class="form-signin" action="categorias/nuevo" method="POST">
                            <label for="nombre">Nombre</label>
                            <input name="nombre" type="text" class="form-control mb-2" required>

                            <label for="descripcion">Descripción</label>
                            <input name="descripcion" type="text" class="form-control mb-2" required>
                           
                            <button class="btn btn-lg btn-success btn-block mb-2" type="submit">Agregar</button>
                        </form>                    
                    {else}     
                        <h5 class="card-title text-center">Editar</h5>                      
                        <form class="form-signin" action="categorias/modificar/{$category->id}" method="POST">
                            <label for="nombre">Nombre</label>
                            <input name="nombre" type="text" class="form-control mb-2" value="{$category->nombre}" required>

                            <label for="descripcion">Descripción</label>
                            <input name="descripcion" type="text" class="form-control mb-2" value="{$category->descripcion}" required>

                            <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Modificar</button>
                            <a href="categorias/administrar" class="btn btn-lg btn-danger btn-block mb-2">Cancelar</a>
                        </form>                       
                    {/if} *}
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
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$categories item=$itemCategory}
                        <tr>
                            <td>{$itemCategory->nombre}</td>
                            <td>{$itemCategory->descripcion}</td>
                            <td><a href="categorias/modificar/{$itemCategory->id}"><img src="images/editar.png" alt="editar"/></a></td>
                            <td><a href="categorias/eliminar/{$itemCategory->id}"><img src="images/eliminar.png" alt="eliminar"/></a></td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file="templates/footer.tpl"}