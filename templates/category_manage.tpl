{include file="templates/navbar.tpl" BASE_URL=BASE_URL}
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Categorias</h5>
                    <form class="form-signin" action="usuarios/nuevo" method="POST">
                        <input name="nombre" type="text" id="inputNombre" class" class="form-control mb-2" placeholder="Nombre" required>
                        <input name="descripcion" type="text" id="inputDescripcion" class="form-control mb-2" placeholder="Descripcion" required>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase mb-2" type="submit">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$categories item=$category}
                        <tr>
                            <th>{$category->nombre}</th>
                            <td>{$category->descripcion}</td>
                            <td><a href="categorias/editar/{$category->id}"><img src="images/editar.png" alt="editar"/></a></td>
                            <td><a href="categorias/eliminar/{$category->id}"><img src="images/eliminar.png" alt="eliminar"/></a></td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file="templates/footer.tpl"}