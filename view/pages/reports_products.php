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

        <div class="card-body">
          <h4 class="">Reportes Inventarios</h4>
          <h6 class="heading-small text-muted mb-4">Reportes Pre-Configurados | PRODUCTOS</h6>
          <div class="pl-lg-4">
            <div class="row">

              <div class="col-lg-3">
                <div class="form-group">
                  <button class="btn btn-outline-dark btn-lg " style="justify-content: flex-end;"
                          onclick="imprimirReporteInventarios_v1();">Detalle General + Rubro + Grupo + Sub-Grupo
                  </button>  
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                <button class="btn btn-outline-dark btn-lg " style="justify-content: flex-end;"
                          onclick="imprimirReporteInventarios_v2();">Detalle + Rubro + Grupo + Sub-Grupo
                  </button>  
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                <button class="btn btn-outline-dark btn-lg " style="justify-content: flex-end;"
                          onclick="imprimirReporteInventarios_v3();">Detalle + Presentaciones + Rubro + Grupo + Sub-Grupo
                  </button>  
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                <button class="btn btn-outline-dark btn-lg " style="justify-content: flex-end;"
                          onclick="imprimirReporteInventarios_v4_Ubica();">Detalle + Presentaciones * Ubicaciones
                  </button>  
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                <button class="btn btn-outline-dark btn-lg " style="justify-content: flex-end;"
                          onclick="imprimirReporteInventarios_v5_Ubica();">Detalle  * Ubicaciones  + Sub-Ubicacion
                  </button>  
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                <button class="btn btn-outline-primary btn-lg " style="justify-content: flex-end;"
                          onclick="imprimirReporteDNMFASF();">Reporte General Productos para  DNM
                  </button>  
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                <button class="btn btn-outline-success btn-lg " style="justify-content: flex-end;"
                          onclick="imprimirReporteExistencias();">Detalle + Presentaciones + Existencias
                  </button>  
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                <button class="btn btn-outline-danger btn-lg " style="justify-content: flex-end;"
                          onclick="report_products_existences_lot();">Detalle + Presentaciones + Existencias + Lotes
                  </button>  
                </div>
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


