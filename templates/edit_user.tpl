{include file="templates/navbar.tpl"}
<div class="container">
    <div class="row">
        {* <div class="col-sm-9 col-md-7 col-lg-5 mx-auto"> *}
            <div class="col-sm-12 col-md-6 mx-auto">
                <h1 class="text-center my-3">Mi perfil</h1>
                {if $user}
                    <div class="card card-signin mb-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Modificar datos</h5>
                            <form class="form-signin" action="usuarios/modificar" method="POST">
                                <label for="email">Email</label>
                                <input name="email" id="email" type="email" class="form-control mb-2" value="{$user->email}" required>

                            <label for="pass">Password</label>
                            <input name="pass" id="pass" type="password" class="form-control mb-2" required>

                            <label for="nombre">Nombre</label>
                            <input name="nombre" id="nombre" type="text" class" class="form-control mb-2" value="{$user->nombre}" required>

                            <label for="telefono">Telefono</label>
                            <input name="telefono" id="telefono" type="text" class="form-control mb-2" value="{$user->telefono}" required>

                            <button class="btn btn-lg btn-success btn-block mb-2" type="submit">Modificar</button>
                            <a href="inicio" class="btn btn-lg btn-danger btn-block mb-2">Cancelar</a>
                        </form>
                    </div>
                </div>
                {else}
                {if $success}
                <div class="alert alert-success text-center" role="alert">
                    ¡Su perfil fue actualizado con éxito!
                    <p>Su sesión se cerró por seguridad. Debe volver a iniciar sesión.</p>
                </div>
                <a href="usuarios/ingreso" class="btn btn-lg btn-primary btn-block mb-2">Iniciar sesión</a>
                {else}
                <div class="alert alert-danger text-center" role="alert">
                    ¡El email ingresado ya está en uso!
                </div>
                <a href="usuarios/modificar" class="btn btn-lg btn-primary btn-block mb-2">Volver</a>
                {/if}
                {/if}
            </div>
            {if $user}
            <div class="col-md-6 text-center my-3">
                <h1 class="text-center">Mis comentarios</h1>
                <div id="containerComments">
                    <p>Aun no has comentado ningun curso!</p>
                </div>
            </div>
            {/if}
        </div>
    </div>
    <script src="js/profileUser.js"></script>

    {include file="templates/footer.tpl"}