<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registro de usuario</title>

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script>
        $(function () {
            $('input, select').on('focus', function () {
                $(this).parent().find('.input-group').css('border-color', '#A41616');
            });
            $('input, select').on('blur', function () {
                $(this).parent().find('.input-group').css('border-color', '#A41616');
            });
        });

        $(document).ready(function() {
            $('#btn_save').on("click", function(event) {
                event.preventDefault();
                var parametros = new FormData();

                var name = $('#name').val();
                var lastname = $('#lastname').val();
                var username = $('#username').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var type = $('#type').val();
                var passw = $('#passw').val();
                var passwconf = $('#passwconf').val();

                parametros.append("name", name);
                parametros.append("lastname", lastname);
                parametros.append("username", username);
                parametros.append("email", email);
                parametros.append("phone", phone);
                parametros.append("type", type);
                parametros.append("passwconf", passwconf);

                if (name != '' && lastname != '' && username != '' && email != '' && phone != '' && type != '' && passw != '' && passwconf != '') {
                    if(passw != passwconf){
                        $('#error_passw').modal('show');
                        $('#btn_confirm_passw_error').on("click", function(event){
                            event.preventDefault();
                            $('#error_passw').modal('hide');
                        });
                    } else {
                        $.ajax({
                            url: './php/registro_usuarios.php',
                            type: 'post',
                            data: parametros,
                            contentType: false,
                            processData: false,
                            success: function(res) {
                                switch(res){
                                    case '0':
                                        $('#conf_window').modal('show');
                                        $('#btn_confirm').on("click", function(event){
                                            event.preventDefault();
                                            $('#conf_window').modal('hide');
                                            window.location.replace("home_users.php");
                                        });
                                    break;
                                    case '1':
                                        $('#conf_window').modal('show');
                                        $('#btn_confirm').on("click", function(event){
                                            event.preventDefault();
                                            $('#conf_window').modal('hide');
                                            window.location.replace("home_workers.php");
                                        });
                                    break;
                                    case '2':
                                        $('#msj_error_correo').show().append(email).append(" ya existe en la base de datos.");
                                        $('#msj_error_correo').fadeOut(5000);
                                    break;
                                }
                            }
                        });
                    }
                } else {
                    $('#empty_error').modal('show');
                    $('#btn_confirm_empty_error').on("click", function(event){
                        event.preventDefault();
                        $('#empty_error').modal('hide');
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="row py-5 mt-4 align-items-center">
            <!-- For Demo Purpose -->
            <div class="col-md-5 pr-lg-5 mb-5 mb-md-0"> 
                <img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" alt="" class="img-fluid d-none d-md-block">
            </div>

            <!-- Registeration Form -->
            <div class="col-md-6 col-lg-5 ml-auto">
            <div class="modal fade" id="conf_window" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¡Registro exitoso!</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger btn-block py-2" id="btn_confirm">
                                <span class="font-weight-bold">Confirmar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="error_passw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Atención</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Las contraseñas no coinciden</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger btn-block py-2" id="btn_confirm_passw_error">
                                <span class="font-weight-bold">Confirmar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="empty_error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Atención</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Ningún campo debe estar vacío.</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger btn-block py-2" id="btn_confirm_empty_error">
                                <span class="font-weight-bold">Confirmar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Data error modal -->
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
                            <p>Ocurrió un error inesperado, inténtelo nuevamente.</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger btn-block py-2" id="btn_confirm_data_error">
                                <span class="font-weight-bold">Confirmar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <h1>Crea una cuenta</h1>
                <form name="Form_Registration" id="form_registration" method="POST" action="./php/registro_usuarios.php">
                    <div class="row input-group-sm">
                        <!-- First Name -->
                        <div class="input-group col-lg-4 mb-2">
                            <input id="name" type="text" name="name" placeholder="Nombre(s)" class="form-control bg-white border-left-0 border-md"
                            maxlength="40" title="Máximo 40 caracteres."
                            pattern="^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))$">
                        </div>

                        <!-- Last Name -->
                        <div class="input-group col-lg-4 mb-2">
                            <input id="lastname" type="text" name="lastname" placeholder="Apellido(s)" class="form-control bg-white border-left-0 border-md"
                            maxlength="40" title="Máximo 40 caracteres."
                            pattern="^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))$">
                        </div>

                        <!-- User Name -->
                        <div class="input-group col-lg-4 mb-2">
                            <input id="username" type="text" name="username" placeholder="Nombre de usuario" class="form-control bg-white border-left-0 border-md"
                            maxlength="40" title="Máximo 40 caracteres, solo los que se encuentran en este grupo (A-Za-z0-9._*+\-)."
                            pattern="^([A-Za-z0-9._*+\-]){0,40}$">
                        </div>

                        <!-- Email Address -->
                        <div class="input-group col-lg-4 mb-2">
                            <input id="email" type="email" name="email" placeholder="Correo Electrónico" class="form-control bg-white border-left-0 border-md"
                            maxlength="40" pattern="[A-Za-z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*">
                        </div>
                        <div type="text" id="msj_error_correo" style="display: none">El correo </div>

                        <!-- Phone Number -->
                        <div class="input-group col-lg-4 mb-2">
                            <input id="phone" type="tel" name="phone" placeholder="Número de Teléfono" class="form-control bg-white border-md border-left-0 pl-3"
                            pattern="^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$">
                        </div>

                        <!-- Job -->
                        <div class="input-group col-lg-4 mb-2">
                            <select id="type" name="jobtitle" class="form-control selectpicker bg-white border-left-0 border-md" title="¿Eres">
                                <option value="" selected disabled>¿Eres trabajador?</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="input-group col-lg-4 mb-2">
                            <input id="passw" type="password" name="passw" placeholder="Contraseña" class="form-control bg-white border-left-0 border-md"
                            minlength="8" maxlength="50">
                        </div>

                        <!-- Password Confirmation -->
                        <div class="input-group col-lg-4 mb-2">
                            <input id="passwconf" type="password" name="passwconf" placeholder="Confirma tu contraseña" class="form-control bg-white border-left-0 border-md"
                            minlength="8" maxlength="50">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto mb-0">
                            <a class="btn btn-danger btn-block py-2" id="btn_save">
                                <span class="font-weight-bold">Crea tu cuenta</span>
                            </a>
                        </div>

                        <!-- Already Registered -->
                        <div class="text-center w-100 mt-2">
                            <p class="text-muted font-weight-bold">¿Ya estás registrado? <a href="login.php" class="text-primary ml-2">Inicia Sesión</a></p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<style>
    .border-md {
    border-width: 2px;
}

.btn-facebook {
    background: #405D9D;
    border: none;
}

.btn-facebook:hover, .btn-facebook:focus {
    background: #314879;
}

.btn-twitter {
    background: #42AEEC;
    border: none;
}

.btn-twitter:hover, .btn-twitter:focus {
    background: #1799e4;
}

body {
    min-height: 100vh;
}

.form-control:not(select) {
    height: 55px;
    padding: 1.5rem 0.5rem;
}

select.form-control {
    height: 55px;
    padding-left: 0.5rem;
}

select.form-control::placeholder {
    color: #ccc;
    font-weight: bold;
    font-size: 0.9rem;
}

.form-control::placeholder {
    color: #ccc;
    font-weight: bold;
    font-size: 0.9rem;
}
.form-control:focus {
    box-shadow: none;
    border-color: #DB1C1C;
}
</style>
</html>