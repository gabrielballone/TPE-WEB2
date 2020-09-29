{include file="templates/navbar.tpl"}
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Iniciar sesión</h5>
                    <form class="form-signin" action="usuarios/ingreso" method="POST">
                        <div class="form-label-group mb-2">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" required autofocus>
                        </div>

                        <div class="form-label-group mb-2">
                            <label for="pass">Contraseña</label>
                            <input name="pass" type="password" class="form-control" required>
                        </div>

                        {* <a href="usuarios/recuperar_contraseña" class="text-info">Has olvidado la contraseña?</a> *}

                        <button class="btn btn-lg btn-primary btn-block text-uppercase mb-2" type="submit">Ingresar</button>
                    </form>
                    {if !$messageError eq ""} 
                        <div class="alert alert-danger">{$messageError}</div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>