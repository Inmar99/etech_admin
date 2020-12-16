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



    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(<?php echo $src; ?>img/theme/back.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello <?php echo $_SESSION['alias_perfil']; ?></h1>
            <p class="text-white mt-0 mb-5">Esta es tu página de perfil. Puede ver el progreso que ha logrado con su trabajo y administrar sus proyectos o tareas asignadas</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="<?php echo $src; ?>img/theme/back_profile.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?php echo $src."/".$_SESSION['imagen_perfil'];?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn  btn-info  mr-4 ">Connect</a>
                <a href="#" class="btn  btn-default float-right">Message</a>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                      <span class="heading">0</span>
                      <span class="description">Ventas</span>
                    </div>
                    <div>
                      <span class="heading">0</span>
                      <span class="description">Cotizaciones</span>
                    </div>
                    <div>
                      <span class="heading">0</span>
                      <span class="description">Comments</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                 <?php echo $_SESSION['alias_perfil']; ?><span class="font-weight-light"></span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $_SESSION['nombre_perfil'] . " ". $_SESSION['apellido_perfil'] ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?php echo $_SESSION['cargo_perfil'] ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>iPOS-Systems
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
              <div class="col-8">
                  <button class="btn  btn-danger" onclick="mostrarModal_Sec();">Modificar Password</button> 
                </div>
        
                <div class="col-4 text-right">
                  <button class="btn  btn-primary" onclick="mostrarModal();">Editar perfil</button> 
                 
                </div>
              </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <label class="form-control-label form-control" for="input-username"><?php echo $_SESSION['alias_perfil'] ?></label>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <label class="form-control-label form-control" for="input-username"><?php echo $_SESSION['email_usuario'] ?></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <label class="form-control-label form-control" for="input-first-name"><?php echo $_SESSION['nombre_perfil'] ?></label>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <label class="form-control-label form-control" for="input-first-name"><?php echo $_SESSION['apellido_perfil'] ?></label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <label class="form-control-label form-control" for="input-first-name"><?php echo $_SESSION['direcion_perfil'] ?></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <label class="form-control-label form-control" for="input-first-name"><?php echo $_SESSION['ciudad_perfil'] ?></label>
                      </div>
                    </div>
                  
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Contact</label>
                        <label class="form-control-label form-control" for="input-first-name"><?php echo $_SESSION['contacto_perfil'] ?></label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Acerca de Mi</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label rows="4" class="form-control-label form-control" ><?php echo $_SESSION['acerca_perfil'] ?></label>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>


<?php
  require_once ('../components/footer.php');
  require_once ('../out/perfil_modal.php');
?>

<script src="<?php echo $src; ?>js/controller/perfil_usuarios.js"></script>