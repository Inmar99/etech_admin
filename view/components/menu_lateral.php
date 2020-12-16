<?php 

$nivel_usuario = $_SESSION['nivel_usuario'];


?>

<body >
    <!-- Sidenav -->
    <nav id="panel_lateral" class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="<?php echo $src; ?>img/brand/blue1_text.png" class="navbar-brand-img" alt="...">
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="home.php">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Home</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link transacciones" href="#navbar-examples" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-examples">
                                <i class="ni ni-bag-17 text-orange"></i>
                                <span class="nav-link-text">Transacciones</span>
                            </a>
                            <div class="collapse" id="navbar-examples">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="ni ni-archive-2 text-cian"></i>
                                            <span class="nav-link-text">Cotizacion</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" onclick="validar_dia()">
                                            <i class="ni ni-basket text-default"></i>
                                            <span class="nav-box-2">Venta</span>
                                        </a>
                                    </li>
                                    <?php if ($nivel_usuario >= 40) {
                                    ?> 
                                    <li class="nav-item">
                                        <a class="nav-link" href="quotes.php">
                                            <i class="ni ni-cart text-success"></i>
                                            <span class="nav-link-text">Compra</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="products_admin.php">
                                            <i class="ni ni-settings-gear-65 text-danger"></i>
                                            <span class="nav-link-text">Mantenimiento</span>
                                        </a>
                                    </li>
                                    <?php
                                    } else{

                                    }?>
                                   
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link transacciones" href="#navbar-list" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-list">
                                <i class="ni ni-bullet-list-67 text-success"></i>
                                <span class="nav-link-text">Listados</span>
                            </a>
                            <div class="collapse" id="navbar-list">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="list_data_invoices.php">
                                            <i class="ni ni-bullet-list-67 text-dark"></i>
                                            <span class="nav-link-text">Listado Ventas</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link inventarios"  href="#navbar-products" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-products">
                                <i class="ni ni-shop text-gray-dark"></i>
                                <span class="nav-link-text">Inventarios</span>
                            </a>
                            <div class="collapse" id="navbar-products">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="products.php">
                                            <i class="ni ni-app text-primary"></i>
                                            <span class="nav-link-text">Productos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="products_det.php">
                                            <i class="ni ni-app text-primary"></i>
                                            <span class="nav-link-text">Productos Det</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="rub_products.php">
                                            <i class="ni ni-single-copy-04 text-success"></i>
                                            <span class="nav-box-2">Rubros</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="group_products.php">
                                            <i class="ni ni-ungroup text-danger"></i>
                                            <span class="nav-link-text">Grupos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="subgroup_products.php">
                                            <i class="ni ni-bullet-list-67 text-orange"></i>
                                            <span class="nav-link-text">Sub-Grupos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="vendors.php">
                                            <i class="ni ni-delivery-fast text-gray"></i>
                                            <span class="nav-link-text">Proveedores</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="laboratories.php">
                                            <i class="ni ni-support-16 text-blue"></i>
                                            <span class="nav-link-text">Laboratorios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="locations.php">
                                            <i class="ni ni-align-left-2 text-orange"></i>
                                            <span class="nav-link-text">Ubicaciones</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="ni ni-book-bookmark text-warning"></i>
                                            <span class="nav-box-2">Kardex</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="reports_products.php">
                                            <i class="ni ni-collection text-success"></i>
                                            <span class="nav-box-2">Reportes</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <?php if ($nivel_usuario >= 40) {?> 
                            <li class="nav-item">
                            <a class="nav-link cajas" href="#navbar-cachers" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-cachers">
                                <i class="ni ni-archive-2 text-pink"></i>
                                <span class="nav-link-text">Cajas</span>
                            </a>
                            <div class="collapse" id="navbar-cachers">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="cachers_movements.php">
                                            <i class="ni ni-settings-gear-65 text-black"></i>
                                            <span class="nav-link-text">Mantenimiento</span>
                                        </a>
                                    </li>
                                
                                </ul>
                            </div>
                        </li>
                        <?php
                        } else{

                        }?>



     
                       


                        <li class="nav-item">
                            <a class="nav-link personas" href="#navbar-persons" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-persons">
                                <i class="ni ni-badge text-success"></i>
                                <span class="nav-link-text">Personas</span>
                            </a>
                            <div class="collapse" id="navbar-persons">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="peoples.php">
                                            <i class="ni ni-circle-08 text-yellow"></i>
                                            <span class="nav-link-text">Personas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="clients.php">
                                            <i class="ni ni-single-02 text-black"></i>
                                            <span class="nav-link-text">Clientes</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <?php if ($nivel_usuario >= 40) {?> 
                          
                          

                        <li class="nav-item rrhh">
                            <a class="nav-link" href="#navbar-rrhh" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-rrhh">
                                <i class="ni ni-building text-primary"></i>
                                <span class="nav-link-text">Recurso Humano</span>
                            </a>
                            <div class="collapse" id="navbar-rrhh">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="employees.php">
                                            <i class="ni ni-circle-08 text-yellow"></i>
                                            <span class="nav-link-text">Empleados</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="departaments.php">
                                            <i class="ni ni-archive-2 text-black"></i>
                                            <span class="nav-link-text">Departamentos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="employees_marker.php">
                                            <i class="ni ni-archive-2 text-black"></i>
                                            <span class="nav-link-text">Marcador</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item config">
                            <a class="nav-link" href="#navbar-config" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-config">
                                <i class="ni ni-settings-gear-65 text-dark"></i>
                                <span class="nav-link-text">Configuraciones</span>
                            </a>
                            <div class="collapse" id="navbar-config">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="users.php">
                                            <i class="ni ni-single-02 text-blue"></i>
                                            <span class="nav-link-text">Usuarios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="perfil.php">
                                            <i class="ni ni-badge text-success"></i>
                                            <span class="nav-link-text">Perfil Usuario</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="ni ni-settings-gear-65 text-cian"></i>
                                            <span class="nav-link-text">Config. Generales</span>
                                        </a>
                                        <div class="collapse" id="navbar-config">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="company.php">
                                                        <i class="ni ni-shop text-cian"></i>
                                                        <span class="nav-link-text">Perfil de la Empresa</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">
                                                        <i class="ni ni-folder-17 text-cian"></i>
                                                        <span class="nav-link-text">Documentos</span>
                                                    </a>
                                                </li>
                                               <!--  <li class="nav-item">
                                                    <a class="nav-link" href="#">
                                                        <i class="ni ni-settings-gear-65 text-cian"></i>
                                                        <span class="nav-link-text">Config. Generales</span>
                                                    </a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item admin">
                            <a class="nav-link" href="#navbar-administration" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-administration">
                                <i class="ni ni-ui-04 text-cian"></i>
                                <span class="nav-link-text">Administracion</span>
                            </a>
                            <div class="collapse" id="navbar-administration">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="ni ni-archive-2 text-black"></i>
                                            <span class="nav-link-text">Niveles de usuario</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="ni ni-archive-2 text-black"></i>
                                            <span class="nav-link-text">Licencia</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <?php
                          } else{
  
                          }?>
                                



                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="ni ni-single-02 text-dark"></i>
                                <?php echo $_SESSION['nombre_perfil']; ?>
                                <span class="nav-link-text"> &nbsp; - NIVEL: <?php echo $_SESSION['nivel_usuario']; ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>