<?php
session_start();
if(empty($_SESSION["id"])){
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Proyect Scarlet</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesHome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/f82b1427cf.js" crossorigin="anonymous"></script>
</head>
<body>
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
                                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content px-3 pt-3 bg-dark" id="inicio">
                <div class=" row">
                    <div class="col">
                    <h1 class="text-white fs-3">
                        <?php echo "Bienvenido".' '.$_SESSION["nombre"]; ?>  
                        <i class="bi bi-stars"id="Star"></i>
                    </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-5">
                        <h3 class="text-danger fs-4">
                            --- Informacion breve ---
                        </h3>
                        <p class="text-white">
                        Para buscar un trabajador ve al apartado de "Búsqueda" donde encontraras al trabajador que tu este buscando.
                        </p>
                        <img src="../img/contact.png"id="img1" alt="">
                        <p class="text-white">
                        Puedes indagar más al momento de buscar puedes ver las calificaciones que los demás usuarios le han dado
                        </p>
                    </div>
                    <div class="col-6">
                        <img id="A-img" src="../img/tra2.png" class="img-fluid rounded-top" alt="">
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