<?php 

/**
*
* Inmar Cortez | Programer & CEO (iPOS-Systems)
* Copyright  iPOS-Systems
* Coded by inmarcortez | inmarcortez@outlook.com
* Creado el: 11-05-2020
*
**/

require ('../../config/config_global.php');

/* Validamos que el usuario tenga una sasion activa */
if (isset($_SESSION['id_usuario']) && isset($_SESSION['id_perfil'])) {
  if(empty($_SESSION['id_usuario']) && empty($_SESSION['id_perfil'])){
    header("Location: login.php");
  }else{
  }
}else{
  header("Location: login.php");
}

require ('../components/header.php');
?>


<body class="bg-default bg-gradient-secondary">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-success py-4 py-lg-5 pt-lg-6">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Marcador de asistencia RESTAURANTE TOROLA</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-danger" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5 shadow">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4 text-black">
                                <small>Ingresa tus credenciales o usa tu carnet de identificacion..</small>
                            </div>
                            <div class="text-center text-muted mb-4">
                                <img src="../../src/img/brand/Principal_1.png" alt="" width="140" height="110">
                            </div>

                            <form action="" role="form" id="form_login">

                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Codigo de barra" name="lc_code" id="lc_code"
                                            type="password" onkeypress="return valid_enter_lector(event)">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Codigo de Empleado" name="code" id="code"
                                            type="text" onkeypress="return valid_enter_lector(event)">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-success my-4"
                                        onclick="post_data();">Procesar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
  require_once ('../components/footer.php');

?>

    <script src="../../scripts/rrhh.js"></script>
    <script>
    init_marker();
    </script>