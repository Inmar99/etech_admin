<?php 

/**
*
* Inmar Cortez | Programer & CEO (iPOS-Systems)
* Copyright  iPOS-Systems
* Coded by inmarcortez | inmarcortez@outlook.com
* Creado el: 11-05-2020
*
**/

$title = "POS-COMPRA";

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
require ('../components/menu_lateral_compra.php');
?>

<title>VENTA</title>
<style>
.modal-dialog-full-width {
    width: 100% !important;
    height: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    max-width: none !important;

}

.modal-content-full-width {
    height: auto !important;
    min-height: 100% !important;
    border-radius: 0 !important;
    background-color: #ececec !important
}

.modal-header-full-width {
    border-bottom: 1px solid #9ea2a2 !important;
}

.modal-footer-full-width {
    border-top: 1px solid #9ea2a2 !important;
}
</style>


<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <div class="row">
            <div class="col-10">
                <input type='text' class='d-none' id='corr_id' name='corr_id' value="0">
                <input type='text' class='d-none' id='its_table' name='its_table' value="0">
                <input type='text' class='d-none' id='state_trans' name='state_trans' value="N">
                <input type='text' class='d-none' id='isAs' name='isAs' value="COMPRA">


                <input type='text' class='d-none' id='tdocumentFinishINPUT' name='tdocumentFinishINPUT' value="0">
                <input type='text' class='d-none' id='tdocumentDescFinishINPUT' name='tdocumentDescFinishINPUT'
                    value="0">



                <table class="table align-items-center table-dark table-flush" id="datos_1">
                    <thead class="thead-gradient-dark">

                        <tr>
                            <td>
                                <label for='docNIT'>TIPO DOCUMENTO</label>
                                <select name='id_documento' id='id_documento' onchange="obtenerDataDocument();"
                                    class='form-control form-control-sm' onkeypress="return valid_enter(event)"
                                    required>
                                    <option value="4">DEFAULT</option>
                                </select>
                            </td>
                            <td class="d-none">
                                <label for='docNIT'>SERIE</label>
                                
                                <input type='text' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" id='impuesto' name='impuesto' placeholder='' >
                                <input type='text' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" id='serie' name='serie' placeholder='' >
                            </td>
                            <td>
                                <label for='docNIT'>N° DOCUMENTO</label>
                                <input type='text' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" id='correlativo' name='correlativo' placeholder='' >
                            </td>
                            <td>
                                <label for='docNIT'>CORRELATIVO</label>
                                <input type='text' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" id='numero' name='numero' readonly
                                    placeholder='000000'>
                            </td>
                            <td>

                            
                                <label for='docNIT'>PROVEEDOR</label>
                                <select name='id_proveedor' id='id_proveedor' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" required>
                                    <option value="1">Varios</option>
                                </select>
                            </td>
                            <td>
                                <label for='docNIT'>FORMA PAGO</label>
                                <select name='id_tpago' id='id_tpago' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" required>
                                </select>
                            </td>
                            <td>
                                <label for='docNIT'>FECHA</label>
                                <input type='date' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" id='fecha_trans' name='fecha_trans'
                                    placeholder='000000'>
                            </td>

                            <td>
                                <label for='docNIT'>FECHA PAGO</label>
                                <input type='date' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" id='fecha_trans_pag' name='fecha_trans_pag'
                                    placeholder='000000'>
                            </td>
                        </tr>

                    </thead>
                </table>
                <br>
            </div>
            <div class="col-10"></div>


            <div class='form-group col-sm-3'>
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-barcode text-dark"></i></span>

                    </div>
                    <input type='text' class='form-control form-control' onkeypress="return valid_enter_busqueda_compra(event)"
                        id='codigo_barra' name='codigo_barra' placeholder='CODIGO DE BARRA' required>
                </div>
            </div>

            <div class='form-group col-sm-5'>
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-font text-dark"></i>
                    </div>
                    <input type='text' class='form-control form-control'
                        onkeypress="return valid_enter_busqueda_text_compra(event)" id='name_search' name='name_search'
                        placeholder='Nombre + Descripcion + Tags' required>
                </div>
            </div>

    
            <div class='form-group col-sm-1'>
               
            </div>
        </div>

        <div class='col-sm-9'>
        <form id='invoice_data'>
        <div class="table-responsive">

            <table class="display tabla_invoice " id="datos">
                <thead class="thead-light">
                    <tr>
                        <th>Codigo</th>
                        <th scope="col">Nombre o Descripcion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Presentacion</th>
                        <th scope="col">Costo</th>
                        <th scope="col">P. Sugerido</th>
                        <th scope="col">P. Venta</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
               
                    <tbody class="list" id="data">

                    </tbody>
              
            </table>
        </div>
        </form>
        <!--  <div class="col-12">
        <table id="datos" class="display" cellspacing="0" width="100%">
                <thead >
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Pres.</th>
                        <th>P. Sugerido</th>
                        <th>P. Venta</th>
                        <th>Total</th>
                     
                    </tr>
                </thead>
                <tbody id="data">

                </tbody>
            </table> 
        </div> -->
    </div>




    <?php
  require_once ('../components/footer.php');

  require_once ('../../windows/add_product_invoice.php');
  require_once ('../../windows/list_products_presentations.php');
  require_once ('../../windows/list_products_results.php');
  require_once ('../../windows/finish_transacction.php');
  require_once ('../../windows/add_product_editable.php');
  require_once ('../../windows/add_presentations.php');

?>

    <script src="../../scripts/products.js"></script>
    <script>
    initQuotes();
    </script>