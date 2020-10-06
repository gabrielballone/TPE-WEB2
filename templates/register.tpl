{include file="templates/navbar.tpl"}
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Registrate</h5>
                    <form class="form-signin" action="usuarios/verificarRegistro" method="POST">
                        <label for="email">Email</label>
                        <input name="email" id="email" type="email" class="form-control mb-2" required autofocus>
                        
                        <label for="password">Contraseña</label>
                        <input name="password" id="password" type="password" class="form-control mb-2" required>
                        
                        <label for="nombre">Nombre</label>
                        <input name="nombre" id="nombre" type="text" class="form-control mb-2" required>                        
                        
                        <label for="telefono">Teléfono</label>
                        <input name="telefono" id="telefono" type="text" class="form-control mb-2" required>
                        
                        <button class="btn btn-lg btn-primary btn-block text-uppercase mb-2" type="submit">Registro</button>
                    </form>
                    {if !$messageError eq ""} 
                        <div class="alert alert-danger">{$messageError}</div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

{include file="templates/footer.tpl"}