<?php
session_start();
if(empty($_SESSION["id"])){
    header("location: login.php");
}

$id_cliente = $_SESSION["id"];
$nombre_cliente = $_SESSION["nombre"];
// Conectar a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$nombreBD ="id19606534_proyectscarlett";

$conexion = new mysqli($servidor,$usuario,$password,$nombreBD);
if($conexion ->connect_error){
    die("la conexion ha fallado: ".$conexion->connect_errno);
}

if(!isset($_POST['buscar'])){$_POST['buscar']= '';}
if(!isset($_POST['busquedaMunicipio'])){$_POST['busquedaMunicipio']= '';}
if(!isset($_POST['busquedaOficio'])){$_POST['busquedaOficio']= '';}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Proyect Scarlet</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/stylesTable.css">
    <link rel="stylesheet" href="../css/stylesHome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/f82b1427cf.js" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript">
        /* -------------------------- UPDATE PROFILE SCRIPT -------------------------- */
        $(document).ready(function() {
            $('#btn_confirm_send_request').on("click", function(event) {
                event.preventDefault();
                var parametros = new FormData();

                var id_col = $('#id_col').text();
                var client_id = $('#client_id').val();
                var client_name = $('#client_name').val();
                var title = $('#request_title').val();
                var description = $('#request_descript').val();

                parametros.append("client_id", client_id);
                parametros.append("client_name", client_name);
                parametros.append("id_col", id_col);
                parametros.append("request_title", title);
                parametros.append("request_descript", description);
                
                if (title != '' && description != '') {
                    $.ajax({
                        url: 'send_request.php',
                        type: 'post',
                        data: parametros,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            console.log(res);
                            if (res != 0) {
                                $('#generate_request').modal('hide');
                                $('#confirm_send_request').modal('hide');
                                $('#conf_window').modal('show');
                                $('#btn_confirm').on("click", function(event){
                                    event.preventDefault();
                                    $('#conf_window').modal('hide');
                                    window.location.reload();
                                    return false;
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
    <div class="modal fade modal-xl" id="generate_request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Solicitud</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid card-body">
                        <form name="Form_Request" id="form_request" method="POST" action="./php/status_solicitud.php">
                            <input class="form-control" id="client_id" type="text" value="<?php echo $id_cliente ?>" hidden>
                            <input class="form-control" id="client_name" type="text" value="<?php echo $nombre_cliente ?>" hidden>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (request title)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="request_title">Título de la solicitud</label>
                                    <input class="form-control" id="request_title" type="text">
                                </div>
                            </div>
                            <!-- Form Group (request description)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="request_descript">Descripción de la solicitud</label>
                                <textarea class="form-control" id="request_descript" rows="8"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btn_send"
                        data-bs-toggle="modal" data-bs-target="#confirm_send_request">Enviar solicitud</button>
                </div>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn_confirm">Confirmar</button>
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
    <div class="modal fade" id="confirm_send_request" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Envío de solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Se enviará la solicitud a este trabajador, ¿deseas continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_confirm_send_request">Confirmar</button>
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

    <div class="main-contairner d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-1 me-2"><i
                            class="bi bi-droplet-half text-danger"></i>
                    </span><span class="text-white">Proyect Scarlet</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"> <i
                        class="fa-solid fa-bars-staggered"></i></button>
            </div>
            <ul class="list-unstyled px-2">
                <li class=" ">
                    <a href="../home_users.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-house"></i> Inicio</a>
                </li>
                <li class="active">
                    <a href="#" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-magnifying-glass"></i>
                        Busqueda</a>
                </li>
                <li>
                    <a href="../profile_users.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-user"></i> Perfil</a>
                </li>
            </ul><hr class="h-color mx-2">

            <ul class="list-unstyled px-2">
                <li>
                    <a href="cerrar_sesion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-right-from-bracket"></i></i>
                        Cerrar Sesion</a>
                </li>
            </ul>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <a class="navbar-brand fs-4" href="#">Proyect Scarlet</a>
                        <button class="btn px-1 open-btn py-0"><i class="fa-solid fa-bars-staggered"></i></button>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">busqueda </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content px-3 pt-3 bg-dark" id="inicio">
            <form action="search.php" method="Post">
                <div class="row">
                    <div class="mb-3 col-6 text-white mt-2">
                        <label class="form-label">Ingrese Nombre</label>
                        <input type="text" class="form-control" id="buscar" name="buscar" value="<?php echo $_POST["buscar"]?>">
                    </div> 
                    <div class="col-3 text-white">
                        <label class="form-label">Municipio</label>
                        <select name="busquedaMunicipio" id="busquedaMunicipio" class="form-control mt-2">
                            <?php if($_POST["busquedaMunicipio"] != '') {?>
                                <option value ="<?php echo $_POST["busquedaMunicipio"];?>"><?php echo $_POST["busquedaMunicipio"]?></option>
                                <?php }?>
                                <option value="">Todos</option>
                                <option value="Tlaquepaque">Tlaquepaque</option>
                                <option value="Tonala">Tonala</option>
                                <option value="Zapopan">Zapopan</option>    
                                <option value="El salto">El salto</option>               
                        </select>
                    </div>
                    <div class="col-3 text-white">
                        <label class="form-label">Oficio</label>
                        <select name="busquedaOficio" id="busquedaOficio" class="form-control mt-2">
                            <?php if($_POST["busquedaOficio"] != '') {?>
                                <option value ="<?php echo $_POST["busquedaOficio"];?>"><?php echo $_POST["busquedaOficio"]?></option>
                                <?php }?>
                                <option value="">Todos</option>
                                <option value="Plomero">Plomero</option>
                                <option value="Electricista">Electricista</option>
                                <option value="Carpintero">Carpintero</option>             
                        </select>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" class="btn btn-danger" value="Buscar">
                        </div>
                    </div>
                    <?php 
                        if($_POST['buscar'] == ''){ $_POST['buscar'] = ' ';}
                    $akeyword = explode(" ", $_POST['buscar']);

                    if($_POST['buscar'] == '' && $_POST["busquedaMunicipio"] == ''){
                        $query = "SELECT * FROM trabajadores t1
                        INNER JOIN usuarios t2 ON t2.IdUsuario = t1.IdUsuario";
                    }
                    else{
                        $query = "SELECT * FROM trabajadores t1
                        INNER JOIN usuarios t2 ON t2.IdUsuario = t1.IdUsuario";

                        if($_POST['buscar'] != ''){
                            $query = "SELECT * FROM trabajadores t1
                            INNER JOIN usuarios t2 ON t2.IdUsuario = t1.IdUsuario WHERE Nombre LiKE LOWER('%".$akeyword[0]."%')";
                        }

                        if($_POST["busquedaMunicipio"] !=''){
                            $query = $query."AND Municipio = '".$_POST["busquedaMunicipio"]."' ";
                        }
                        if($_POST["busquedaOficio"] !=''){
                            $query = $query."AND Oficio = '".$_POST["busquedaOficio"]."' ";
                        }
                    }


                    $sql = $conexion->query($query);
                    $numrosql = mysqli_num_rows($sql);
                ?>
                </form>

            <div class="table-reposive">
                <div class="container pt-3" id="Contenido">
                        <table id="table_workers">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Oficio</th>
                                    <th>Dirrecion</th>
                                    <th>Municipio</th>
                                    <th>Tel-Local</th>
                                    <th>Acción</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while($rowSql = $sql->fetch_assoc()){?>
                                    <tr>
                                        <td id="id_col"><?php echo $rowSql['IdUsuario']; ?></td>
                                        <td id="name_col"><?php echo $rowSql['Nombre']; ?></td>
                                        <td id="lastname_col"><?php echo $rowSql["Apellido"]; ?></td>
                                        <td id="job_col"><?php echo $rowSql['Oficio']; ?></td>
                                        <td id="address_col"><?php echo $rowSql['Domicilio']; ?></td>
                                        <td id="location_col"><?php echo $rowSql['Municipio']; ?></td>
                                        <td id="phone_col"><?php echo $rowSql['Tel_Loc']; ?></td>
                                        <td><button type="button" class="btn btn-primary" id="btn_generate"
                                            data-bs-toggle="modal" data-bs-target="#generate_request">Generar solicitud</button>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
            </div>
                <div class="burbujas">
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                    <div class="burbuja"></div>
                </div>
            </div>

            
        </div>
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
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
</body>
</html>