<?php 
    /**
    *
    * Inmar Cortez | Programer & CEO (iPOS-Systems)
    * Copyright  iPOS-Systems
    * Coded by inmarcortez | inmarcortez@outlook.com
    * Creado el: 11-05-2020
    *
    **/

?>


 <!-- Main content -->
 <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-dark border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav align-items-center  ml-md-auto ">


          <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>

            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
  
          
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder"  src="<?php echo $src."/".$_SESSION['imagen_perfil'];?>">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"> <?php echo $_SESSION['alias_perfil'];  ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">
                    <?php echo $_SESSION['email_usuario'];  ?>
                  </h6>
                </div>
                <a href="perfil.php" class="dropdown-item">
                  <i class="ni ni-single-02 text-primary"></i>
                  <span>Mi perfil</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-settings text-success"></i>
                  <span>Configuraciones</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-check-bold "></i>
                  <span>Notificaciones</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="../../config/close_session.php" class="dropdown-item">
                  <i class="ni ni-fat-remove text-danger"></i>
                  <span>Cerrar sesion</span>
                </a>
                <div class="dropdown-divider"></div>
                
                <label class="dropdown-item">iPOS-Systems v1.0</label>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
