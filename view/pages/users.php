<?php

/**
 *
 * Inmar Cortez | Programer & CEO (iPOS-Systems)
 * Copyright  iPOS-Systems
 * Coded by inmarcortez | inmarcortez@outlook.com
 * Creado el: 11-05-2020
 *
 **/

require('../../config/config_global.php');

/* Validamos que el usuario tenga una sasion activa */
if (isset($_SESSION['id_usuario']) && isset($_SESSION['id_perfil'])) {
    if (empty($_SESSION['id_usuario']) && empty($_SESSION['id_perfil'])) {
        header("Location: login.php");
    } else {
    }
} else {
    header("Location: login.php");
}

require('../components/header.php');
require('../components/menu_lateral.php');
require('../components/menu_top.php');
?>


<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-0">Listado de Usuarios</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive py-4">
        <table class="table table-flush" id="datos">
            <thead class="thead-light">
                <tr>
                    <th>Codigo</th>
                    <th>Correo Electr&oacute;nico</th>
                    <th>Nombre de Usuario</th>
                    <th>Cargo</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Codigo</th>
                    <th>Correo Electr&oacute;nico</th>
                    <th>Nombre de Usuario</th>
                    <th>Cargo</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody id="data">

            </tbody>
        </table>
    </div>
</div>




<?php
require_once('../components/footer.php');
require_once('../../windows/add_users.php');


?>

<script src="../../scripts/users.js"></script>
<script>
    get_users();
</script>