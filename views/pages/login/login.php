
<link rel="stylesheet" href="views/assets/css/login.css">

 <form method="post">
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image"></div>

                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>Bienvenido de nuevo</header>
                        <div class="input-field">
                            <input type="text" class="input" name="ingUsuario" id="ingUsuario" required autocomplete="off">
                            <label for="email">Usuario</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" name="ingContra" id="ingContra" required>
                            <label for="pass">Contraseña</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="Iniciar Sesión">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
 $login = new LoginController;
 $login -> ctrLoginUser();
?>
</form>


