<?php
session_start();
if(empty($_SESSION["id"])){
    header("location: login.php");
}

require "./php/conexion_bd.php";
$usuario = $_SESSION["id"];
$conectar = conexion_bd();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Perfil de Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stylesHome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/f82b1427cf.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btn_confirm_profile_edit').on("click", function(event) {
                event.preventDefault();
                var parametros = new FormData();

                var id = $('#id').val();
                var username = $('#username').val();
                var name = $('#name').val();
                var lastname = $('#lastname').val();
                var email = $('#email').val();
                var phone = $('#phone').val();

                parametros.append("id", id);
                parametros.append("username", username);
                parametros.append("name", name);
                parametros.append("lastname", lastname);
                parametros.append("email", email);
                parametros.append("phone", phone);
            
                if (name != '' && lastname != '' && username != '' && email != '' && phone != '') {
                    $.ajax({
                        url: './php/edit_profile_users.php',
                        type: 'post',
                        data: parametros,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            if (res != 0) {
                                $('#confirm_profile_edit').modal('hide');
                                $('#conf_window').modal('show');
                                $('#btn_confirm').on("click", function(event){
                                    event.preventDefault();
                                    $('#conf_window').modal('hide');
                                });

                                window.location.reload();
                                return false;
                            } else {
                                $('#data_error').modal('show');
                                $('#btn_confirm_data_error').on("click", function(event){
                                    event.preventDefault();
                                    $('#data_error').modal('hide');
                                });
                            }
                        }
                    });
                } else {
                    $('#empty_error').modal('show');
                    $('#btn_confirm_empty_error').on("click", function(event){
                        event.preventDefault();
                        $('#empty_error').modal('hide');
                    });
                }
            });

            $('#btn_cancel').on("click", function(event) {
                event.preventDefault();
                var parametros = new FormData();

                var status = 5;
                var id = $('#id').val();

                parametros.append("request_status", status);
                parametros.append("id", id);
            
                $.ajax({
                    url: './php/request_status_cancel.php',
                    type: 'post',
                    data: parametros,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res != 0) {
                            $('#cancel_request').modal('show');
                            $('#btn_confirm_request_cancellation').on("click", function(event){
                                event.preventDefault();
                            });

                            window.location.reload();
                            return false;
                        } else {
                            $('#data_error').modal('show');
                            $('#btn_confirm_data_error').on("click", function(event){
                                event.preventDefault();
                                $('#data_error').modal('hide');
                            });
                        }
                    }
                });
            });

            $('#confirm_passw_change').on("click", function(event) {
                event.preventDefault();
                var parametros = new FormData();

                var new_passw = $('#new_passw').val();
                var new_passw_confirm = $('#new_passw_confirm').val();
                var id = $('#id').val();
            
                if(new_passw != new_passw_confirm){
                    $('#error_passw').modal('show');
                    $('#btn_confirm_passw_error').on("click", function(event){
                        event.preventDefault();
                        $('#error_passw').modal('hide');
                    });
                } else{
                    parametros.append("new_passw_confirm", new_passw_confirm);
                    parametros.append("id", id);

                    $.ajax({
                        url: './php/change_password.php',
                        type: 'post',
                        data: parametros,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            if (res != 0) {
                                $('#confirm_passw_change').modal('show');
                                $('#btn_confirm_passw_change').on("click", function(event){
                                    event.preventDefault();
                                    $('#conf_window').modal('show');
                                });

                                window.location.reload();
                                return false;
                            } else {
                                $('#data_error').modal('show');
                                $('#btn_confirm_data_error').on("click", function(event){
                                    event.preventDefault();
                                    $('#data_error').modal('hide');
                                });
                            }
                        }
                    });
                }
            });

            $('#btn_delete_profile').on("click", function(event) {
                event.preventDefault();
                var parametros = new FormData();

                var id = $('#id').val();

                parametros.append("id", id);
            
                $.ajax({
                    url: './php/delete_profile.php',
                    type: 'post',
                    data: parametros,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res != 0) {
                            $('#btn_delete_profile').on("click", function(event){
                                event.preventDefault();
                                $('#delete_profile').modal('hide');
                                window.location.replace("./php/cerrar_sesion.php");
                            });
                        } else {
                            $('#data_error').modal('show');
                            $('#btn_confirm_data_error').on("click", function(event){
                                event.preventDefault();
                                $('#data_error').modal('hide');
                            });
                        }
                    }
                });
            });
        });

        $(".sidebar ul li").on('click', function () {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active')
        });

        $('.open-btn').on('click', function () {
            $('.sidebar').addClass('active');
        });


        $('.close-btn').on('click', function () {
            $('.sidebar').removeClass('active');
        });
    </script>
    <style type="text/css">
        body{
            margin-top: 0px;
            background-color:#DADADA;
        }
        .img-account-profile {
            height: 10rem;
        }
        .rounded-circle {
            border-radius: 50% !important;
        }
        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }
        .card .card-header {
            font-weight: 500;
        }
        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }
        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }
        .form-control, .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        #delete-tab{
            color: #fc0505;
        }

        #delete-tab:hover{
            color: #ba0202;
        }
    </style>
</head>
<body>


    <!-------------------------- MODAL GROUP -------------------------->

    <?php
        $sql = "SELECT * FROM usuarios
        WHERE IdUsuario = '$usuario'";
        $resultado = mysqli_query($conectar, $sql);

        while ($row_users = mysqli_fetch_array($resultado)) {
    ?>
    
    <!-- Profile editing modal -->
    <div class="modal fade modal-xl" id="edit_window" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edición de perfil</h5>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form name="Form_Registration" id="form_registration" method="POST" action="./php/edit_profile.php">
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <input class="form-control" type="text" id="id" value="<?php echo $usuario ?>" style="display: none"/>
                                <label class="small mb-1" for="username">Nombre de usuario</label>
                                <input class="form-control" id="username" type="text" placeholder="Ingresa tu nombre de usuario"
                                value="<?php echo $row_users['UserName'] ?>"
                                maxlength="40" title="Máximo 40 caracteres, solo los que se encuentran en este grupo (A-Za-z0-9._*+\-)."
                                pattern="^([A-Za-z0-9._*+\-]){0,40}$">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="name">Nombre(s)</label>
                                    <input class="form-control" id="name" type="text" placeholder="Ingresa tu(s) nombre(s)"
                                    value="<?php echo $row_users['Nombre'] ?>"
                                    maxlength="40" title="Máximo 40 caracteres."
                                    pattern="^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))$">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="lastname">Apellido(s)</label>
                                    <input class="form-control" id="lastname" type="text" placeholder="Ingresa tu(s) apellido(s)"
                                    value="<?php echo $row_users['Apellido'] ?>"
                                    maxlength="40" title="Máximo 40 caracteres."
                                    pattern="^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))$">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email address)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="email">Dirección de correo electrónico</label>
                                    <input class="form-control" id="email" type="email" placeholder="Ingresa tu correo electrónico"
                                    value="<?php echo $row_users['Email'] ?>"
                                    maxlength="40" pattern="[A-Za-z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*">
                                </div>
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="phone">Número de teléfono</label>
                                    <input class="form-control" id="phone" type="tel" placeholder="Ingresa tu número telefónico"
                                    value="<?php echo $row_users['Telefono'] ?>"
                                    pattern="^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_confirm_profile_edit"
                    data-bs-toggle="modal" data-bs-target="#confirm_profile_edit">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        $sql = "SELECT * FROM solicitudes t1
        LEFT JOIN usuarios t2 ON t1.id_usuario_solicitante = t2.IdUsuario
        WHERE t1.id_usuario_solicitante = '$usuario'";
        $resultado = mysqli_query($conectar, $sql);

        while ($row_requests = mysqli_fetch_array($resultado)) {
    ?>
    <!-- Request view modal -->
    <div class="modal fade modal-xl" id="request_window" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vista de solicitud</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid card-body">
                        <form name="Form_Request" id="form_request" method="POST" action="./php/status_solicitud.php">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (request ID)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="request_id">ID de solicitud</label>
                                    <input class="form-control" id="request_id" type="text"
                                    value="<?php echo $row_requests['id_solicitud'] ?>" disabled>
                                </div>
                                <!-- Form Group (request date)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="request_date">Fecha de solicitud</label>
                                    <input class="form-control" id="request_date" type="text"
                                    value="<?php echo $row_requests['fecha_solicitud'] ?>" disabled>
                                </div>
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (request title)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="request_title">Título de la solicitud</label>
                                    <input class="form-control" id="request_title" type="text"
                                    value="<?php echo $row_requests['titulo_solicitud'] ?>" disabled>
                                </div>
                            </div>
                            <!-- Form Group (request description)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="request_descript">Descripción de la solicitud</label>
                                <textarea class="form-control" id="request_descript" rows="8" disabled>
                                    <?php echo $row_requests['descripcion_solicitud'] ?>
                                </textarea>
                            </div>
                            <!-- Form Group (location)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="request_status">Status de la solicitud</label>
                                <input class="form-control" id="request_status" type="text"
                                value="<?php echo $row_requests['status_solicitud'] ?>" disabled>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change password modal -->
    <div class="modal fade" id="confirm_passw_change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambio de contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de cambiar tu contraseña? Guarda tu nueva contraseña en un lugar seguro para no perder acceso al sitio.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_confirm_passw_change">Confirmar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Cancel request modal -->
    <div class="modal fade" id="cancel_request" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancelar solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de cancelar la solicitud? Esta acción no puede deshacerse.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_confirm_request_cancellation">Confirmar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Delete profile modal -->
    <div class="modal fade" id="delete_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tu perfil se borrará y no podrás tener acceso, ¿deseas continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_delete_profile">Confirmar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Update profile modal -->
    <div class="modal fade" id="confirm_profile_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edición del perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Se actualizarán los datos actuales del perfil, ¿deseas continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_confirm_profile_edit">Confirmar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Alert modal -->
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
                    <p>¡Éxito al realizar la operación!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_confirm">Confirmar</button>
                </div>
            </div>
        </div>
    </div>


    <!-------------------------- SECTION CONTENT GROUP -------------------------->

    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-1 me-2"><i
                            class="bi bi-droplet-half text-danger"></i>
                    </span><span class="text-white">Proyect Scarlet</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"> <i
                        class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
                <li class="active ">
                    <a href="home_users.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-house"></i> Inicio</a>
                </li>
                <li>
                    <a href="./php/search.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-magnifying-glass"></i>
                        Busqueda</a>
                </li>
                <li>
                    <a href="profile_users.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-user"></i> Perfil</a>
                </li>
            </ul><hr class="h-color mx-2">

            <ul class="list-unstyled px-2">
                <li>
                    <a href="./php/cerrar_sesion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-right-from-bracket"></i></i>
                        Cerrar Sesion</a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="container-xl px-4 mt-4">
                <!-- Account page navigation-->
                <ul class="nav nav-tabs" id="nav_tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile_section"
                        type="button" role="tab" aria-controls="profile_section" aria-selected="true">Perfil</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="request-tab" data-bs-toggle="tab" data-bs-target="#request_section"
                        type="button" role="tab" aria-controls="request_section" aria-selected="false">Solicitudes</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="passw-tab" data-bs-toggle="tab" data-bs-target="#change_passw_section"
                        type="button" role="tab" aria-controls="change_passw_section" aria-selected="false">Cambia tu contraseña</button>
                    </li>
                </ul>
                <hr class="mt-0 mb-4">
                <div class="tab-content">
                    <!-- Profile view section -->
                    <div class="tab-pane fade show active" id="profile_section" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container-xl px-4 mt-4">
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0">
                                        <div class="card-header">Foto de perfil</div>
                                        <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                            <img class="img-account-profile rounded-circle mb-2" src="../img/default_user_profile.png" alt="">
                                            <!-- Profile picture help block-->
                                            <div class="small font-italic text-muted mb-4">Sube una imagen para tu perfil</div>
                                            <!-- Profile picture upload button-->
                                            <!-- <button class="btn btn-secondary" type="button">Subir nueva imagen</button> -->
                                            <input class="btn btn-secondary" type="file" id="img" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Detalles de la cuenta</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Group (username)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="username_view">Nombre de usuario</label>
                                                    <input class="form-control" id="username_view" type="text"
                                                    value="<?php echo $row_users['UserName'] ?>" disabled>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (first name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="name_view">Nombre(s)</label>
                                                        <input class="form-control" id="name_view" type="text"
                                                        value="<?php echo $row_users['Nombre'] ?>" disabled>
                                                    </div>
                                                    <!-- Form Group (last name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="lastname_view">Apellido(s)</label>
                                                        <input class="form-control" id="lastname_view" type="text"
                                                        value="<?php echo $row_users['Apellido'] ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (email address)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="email_view">Dirección de correo electrónico</label>
                                                        <input class="form-control" id="email_view" type="email"
                                                        value="<?php echo $row_users['Email'] ?>" disabled>
                                                    </div>
                                                    <!-- Form Group (phone number)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="phone_view">Número de teléfono</label>
                                                        <input class="form-control" id="phone_view" type="tel" 
                                                        value="<?php echo $row_users['Telefono'] ?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- Save changes button-->
                                                <button class="btn btn-primary" type="button" id="btn_edit" data-bs-toggle="modal" data-bs-target="#edit_window">Editar perfil</button>
                                                <button class="btn btn-danger" type="button" id="btn_delete" data-bs-toggle="modal" data-bs-target="#delete_profile">Eliminar perfil</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Requests section -->
                    <div class="tab-pane fade" id="request_section" role="tabpanel" aria-labelledby="request-tab">
                        <div class="container-xl px-4 mt-4">
                            <div class="row justify-content-center">
                                <div class="col-xl-8">
                                    <table class="table table-striped table-hover table-light rounded rounded-3 overflow-hidden">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID de la solicitud</th>
                                                <th scope="col">Título de la solicitud</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $row_requests['id_solicitud'] ?></th>
                                                <td><?php echo $row_requests['titulo_solicitud'] ?></td>
                                                <td>
                                                    <button class="btn btn-primary" type="button" id="btn_detail"
                                                    data-bs-toggle="modal" data-bs-target="#request_window">Ver detalle</button>
                                                    <button type="button" class="btn btn-primary" id="btn_cancel"
                                                    data-bs-toggle="modal" data-bs-target="#cancel_request">Cancelar solicitud</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change password section -->
                    <div class="tab-pane fade" id="change_passw_section" role="tabpanel" aria-labelledby="passw-tab">
                        <div class="container-xl px-4 mt-4">
                            <div class="row justify-content-center">
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Cambio de contraseña</div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="actual_passw">Contraseña actual</label>
                                                    <input class="form-control" id="actual_passw" type="password"
                                                    value="<?php echo $row_users['Contraseña'] ?>">
                                                </div>
                                                <hr class="mt-0 mb-4">
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="new_passw">Nueva contraseña</label>
                                                    <input class="form-control" id="new_passw" type="password" placeholder="" value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="new_passw_confirm">Confirma tu nueva contraseña</label>
                                                    <input class="form-control" id="new_passw_confirm" type="password" placeholder="" value="">
                                                </div>
                                                <!-- Save changes button-->
                                                <button class="btn btn-primary" type="button" id="btn_change_passw"
                                                    data-bs-toggle="modal" data-bs-target="#confirm_passw_change">Cambiar contraseña</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }}?>
</body>
</html>