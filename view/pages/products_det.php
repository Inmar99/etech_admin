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
require ('../components/menu_top.php');
?>


<style>
 table {
  table-layout:fixed;
}
table td {
  word-wrap: break-word;
  max-width: 400px;
}
#datos td {
  white-space:inherit;
} 


/* #datos th {
margin: 0 auto;
clear: both;
width: 100%;
table-layout: fixed;
} */


/* th,td{
max-width:120px !important;
word-wrap: break-word
} */
</style>


<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <div class="row">
            <div class="col-3">
                <h2 class="mb-0">Listado de Productos</h2>
                <input type="hidden" name="table_name" id="table_name" value="products">
                <input type="hidden" name="page" id="page" value="Detalle">
            </div>
                <div class="col-sm-6  my-1">
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInputGroup">Buscar</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Filtro Avanzado</div>
                            </div>
                            <input type="text" class="form-control form-control " name="search_database" id="search_database"
                                onkeypress="return valid_enter_search(event)" placeholder="Descripcion - Componente">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="search_data();">Buscar</button>
                            </div>
                        </div>
                    </div>

                </div>
            <div class="col-3 text-right">
                <button class="btn btn-dark btn float-right" style="justify-content: flex-end;"
                    onclick="readProductsDet();">Limpiar y Actualizar </button>
                <button class="btn btn-danger btn float-right" style="justify-content: flex-end;"
                    onclick="back();">Atras</button> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
            </div>
        </div>
    </div>
    <div class="card-body border-0">
        <div class="row">
            <div class="col-12">
                <table class="table table-sm" id="datos">
                    <thead class="thead-light">
                        <tr>
                            <th >Cod Barra</th>
                            <th >Grupo</th>
                            <th>Nombre</th>
                            <th>Precio S</th>
                            <th>Precio V</th>
                            <th>Ubicacion</th>
                            <th>Laboratorio</th>
                            <th>Existencias</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Cod Barra</th>
                            <th>Grupo</th>
                            <th style='white-space:nowrap'>Nombre</th>
                            <th>Precio S</th>
                            <th>Precio V</th>
                            <th>Ubicacion</th>
                            <th>Laboratorio</th>
                            <th>Existencias</th>
                            <th></th>

                        </tr>
                    </tfoot>
                    <tbody id="data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
  require_once ('../components/footer.php');
  require_once ('../../windows/add_product.php');
  require_once ('../../windows/add_lot.php');
  require_once ('../../windows/add_presentations.php');
  
?>

<script src="../../scripts/products.js"></script>
<script>
readProductsDet();
</script>