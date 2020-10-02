{include file="templates/navbar.tpl"}
<div class="container">
    <h1 class="text-center">Administrar usuarios</h1>

    <div class="row">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Administrador</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$users item=$user}
                        <tr>
                            <td class="align-middle">{$user->email}</td>
                            <td class="align-middle">{$user->nombre}</td>
                            <td>
                                {if $user->administrador}
                                    <a type="button" class="btn btn-success" href="usuarios/set_administrador/{$user->id}/0">SI</a>
                                {else}
                                    <a type="button" class="btn btn-danger" href="usuarios/set_administrador/{$user->id}/1">NO</a>
                                {/if}
                            </td>
                            <td><a href="usuarios/eliminar/confirmar/{$user->id}"><img src="images/eliminar.png" alt="eliminar" /></a></td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file="templates/footer.tpl"}