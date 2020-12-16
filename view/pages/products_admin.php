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
$title = "Administrar Existencias";

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

require ('../components/menu_top.php');
?>


<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <div class="row">
        <input type="hidden" name="table_name" id="table_name" value="products">
        <input type="hidden" name="page" id="page" value="Normal">
            <div class="col-sm-6 my-1">
                    

                </div>
            <div class="col-6 text-right">
                <button class="btn btn-dark btn float-right" style="justify-content: flex-end;"
                    onclick="readProducts_existences();">Actualizar Todo </button>
                <button class="btn btn-danger float-right" style="justify-content: flex-end;"
                    onclick="back();">Atras</button> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
            </div>


        </div>
    </div>
    <div class="table-responsive py-4">
    <table class="table table-flush" id="datos">
            <thead class="thead-light">
                <tr>
                    <th>Cod</th>
                    <th>Barcode</th>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th>Laboratorio</th>
                    <th>Ubicacion</th>
                    <th>Vendedor</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Cod</th>
                    <th>Barcode</th>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th>Laboratorio</th>
                    <th>Ubicacion</th>
                    <th>Vendedor</th>
                    <th></th>
                </tr>
            </tfoot>
                <tbody id="data">
                </tbody>
        </table>
    </div>
</div>


<?php
  require_once ('../components/footer.php');
  require_once ('../../windows/add_lot.php');
  require_once ('../../windows/add_existences.php');

  
?>

<script src="../../scripts/products.js"></script>
<script>
initProducts_existences();
</script>