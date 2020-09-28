{include file="templates/navbar.tpl"}
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Registrate</h5>
                    <form class="form-signin" action="usuarios/nuevo" method="POST">
                        <input name="email" type="email" id="inputEmail" class="form-control mb-2" placeholder="Correo electrónico" required autofocus>
                        <input name="password" type="password" id="inputPassword" class="form-control mb-2" placeholder="Contraseña" required>
                        <input name="nombre" type="text" id="inputNombre" class" class="form-control mb-2" placeholder="Nombre" required>                        
                        <input name="telefono" type="text" id="inputTelefono" class="form-control mb-2" placeholder="Teléfono" required>
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