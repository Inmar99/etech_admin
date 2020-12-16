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
require ('../components/menu_lateral.php');
require ('../components/menu_top.php');
?>



<div class="card">
    <!-- Card header -->
    <div class="card-header">
        <div class="col-md-12">
            <h2 class="mb-0">CAJA 01</h2>
            <button class="btn btn-dark  float-right" style="justify-content: flex-end;"
                onclick="OpenMovemetsAdd();">Nuevo</button>
        </div>

    </div>
    <div class="table-responsive py-4">
        <table class="table table-flush" id="datos">
            <thead class="thead-light">
                <tr>
                    <th>Cod</th>
                    <th>Afecta</th>
                    <th>Tipo</th>
                    <th>Monto</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Cod</th>
                    <th>Afecta</th>
                    <th>Tipo</th>
                    <th>Monto</th>
                    <th>Descripcion</th>
                </tr>
            </tfoot>
            <tbody id="data">

            </tbody>
        </table>
    </div>
</div>


<!-- id_usuario -->

<?php
  require_once ('../components/footer.php');
  require_once ('../../windows/add_cachers_movements.php');
  
?>

<script src="../../scripts/admin.js"></script>
<script>
init_cachiers_movements();
</script>