<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inicio de Sesión</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript">
        function validar() {
            var parametros = new FormData();
            var email = $('#email_user').val();
            var pass = $('#passw_user').val();
            var type = $('#type_user').val();

            parametros.append("email_user", email);
            parametros.append("passw_user", pass);
            parametros.append("type_user", type);

            if (email != '' && pass != '' && type != '') {
                $.ajax({
                    type: "POST",
                    url: "./php/validacion.php",
                    data: parametros,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res != 0) {
                            switch(res){
                                case '1':
                                    $('#conf_window').modal('show');
                                    $('#btn_confirm').on("click", function(event){
                                        event.preventDefault();
                                        $('#conf_window').modal('hide');
                                        window.location.replace("home_users.php");
                                    });
                                break;
                                case '2':
                                    $('#conf_window').modal('show');
                                    $('#btn_confirm').on("click", function(event){
                                        event.preventDefault();
                                        $('#conf_window').modal('hide');
                                        window.location.replace("home_workers.php");
                                    });
                                break;
                            }
                        } else {
                            $('#data_error').modal('show');
                            $('#btn_confirm_data_error').on("click", function(event){
                                event.preventDefault();
                                $('#data_error').modal('hide');
                            });
                        }
                    },
                    error: function() {
                        alert('Error al conectar al servidor...');
                    }
                }); //Termina ajax()
            } else {
                $('#msj_error_login').show();
                $('#msj_error_login').fadeOut(5000);
            }
        }
    </script>
</head>
<body>
    <!-- Registeration Form -->
    <div class="modal fade" id="conf_window" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inicio de sesión exitoso</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¡Bienvenido a Proyecto Scarlet!</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-block py-2" id="btn_confirm">
                        <span class="font-weight-bold">Confirmar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="data_error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atención</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ocurrió un error al usar esas credenciales, intente nuevamente.</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-block py-2" id="btn_confirm_data_error">
                        <span class="font-weight-bold">Confirmar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="row justify-content-md-center">
                <div class="col-md-auto justify-content-center"><label style="font-size: 45px;">Proyecto Scarlet</label></div>
            </div>
        <div class="col-md-7 col-lg-3 col-xl-3">
            <img src="../img/vector_login_image.jpg" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form name="Forma01" id="form_login" method="POST" action="./php/validacion.php">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="email_user" name="email_user" class="form-control form-control-sm"
                    placeholder="Ingresa una dirección de correo válida"
                    maxlength="40" pattern="[A-Za-z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*">
                <label class="form-label" for="email_user" style="font-weight: 500;">Correo electrónico</label>
                <div type="text" id="msj_error_correo_login" style="display: none">El correo ingresado no existe</div>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
                <input type="password" id="passw_user" name="passw_user" class="form-control form-control-sm"
                placeholder="Ingresa tu contraseña"
                minlength="8" maxlength="50">
                <label class="form-label" for="passw_user" style="font-weight: 500;">Contraseña</label>
            </div>

            <div class="form-outline mb-3">
                <select id="type_user" name="jobtitle" class="form-control form-control-sm selectpicker bg-white border-left-0 border-md">
                    <option value="" selected disabled>¿Eres trabajador?</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                <label class="form-label" for="type" style="font-weight: 500;">Selección de rol</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="#!" class="text-body">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
                <input type="submit" onclick="validar(); return false;" class="btn btn-danger btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;"
                    id="button-login" value="Ingresa"/>
                <p class="small fw-bold mt-2 pt-1 mb-md-1">¿No tienes una cuenta?
                    <a href="./register.php" class="link-danger">Regístrate</a>
                </p>
            </div>
            <div type="text" id="msj_error_login" style="display: none">
                <p>Error, faltan campos por llenar.</p>
            </div>
        </form>
        </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center
            text-md-start justify-content-between py-4 px-4 px-xl-5 bg-danger" id="bottom-bar">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
        Copyright © 2023. Todos los derechos reservados.
        </div>
        <!-- Copyright -->

        <!-- Right -->
        <div>
        <a href="#!" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#!" class="text-white me-4">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="#!" class="text-white me-4">
            <i class="fab fa-google"></i>
        </a>
        <a href="#!" class="text-white">
            <i class="fab fa-linkedin-in"></i>
        </a>
        </div>
        <!-- Right -->
    </div>
</section>
</body>
</html>