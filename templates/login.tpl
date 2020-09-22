{include file="templates/navbar.tpl" BASE_URL=BASE_URL}
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Inicia sesion</h5>
                    <form class="form-signin">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                            <label for="inputEmail">Email</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                            <label for="inputPassword">Contraseña</label>
                        </div>

                        <a href="#" class="text-info">Has olvidado la contraseña?</a>

                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Ingresa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>