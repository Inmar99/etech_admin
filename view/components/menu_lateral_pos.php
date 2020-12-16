<?php 

?>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-right  navbar-expand-sm navbar-light bg-white" >
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">


                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <h2 class="mb-0">&nbsp;&nbsp;&nbsp;FACTURACION</h2>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <h2 class="mb-0">TOTAL: $ <label for="" id="tdocumentFinish"></label></h2>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <h2 class="mb-0">DESC: $ <label for="" id="tdocumentDescFinish"></label></h2>

                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <button class="btn btn-outline-success" onclick="nuevaTransaccion();"><i
                                        class="fas fa-plus-square text-outline-dark"></i>
                                    &nbsp;Nuevo Trans.</button>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <button class="btn btn-outline-dark" onclick="contarFilas('1')"> <i class="fas fa-save text-outline-dark"></i>
                                    &nbsp;Finalizar Trans.</button>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <button class="btn btn-outline-danger" onclick="cancelarTransaccion();"><i
                                        class="fas fa-ban text-outline-dark"></i>
                                    </i>&nbsp;Cancelar Trans.</button>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <button class="btn btn-outline-warning" onclick="salirPantalla();"><i
                                        class="fas fa-sign-out-alt text-outline-dark"></i>
                                    </i>&nbsp;Salir Ventana</button>
                            </a>
                        </li>

                     


                        <li class="nav-item">
                           
                           <label for="" class="mb-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vendedor</label>
                            <a class="nav-link active" href="#">
                                <select name='id_vendedor' id='id_vendedor' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" required>
                                    <option value="1">Varios</option>

                                </select>
                                
                            </a>
                        </li>

                        <li class="nav-item d-none">
                        <label for="" class="mb-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Caja</label>
                            <a class="nav-link active" href="#">
                                <select name='id_caja' id='id_caja' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" required>
                                </select>

                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                </div>
            </div>
        </div>
    </nav>