<?php 


?>

<style type="text/css">
#registro fieldset:not(:first-of-type) {
    display: none;
}
</style>



<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <label for="" >Avance:</label><label for="" id="porcentaje"></label>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="registro" novalidate action="action.php" method="post">
                    <fieldset>
                        <h2>Step 1: Crea el nuevo empleado</h2>
                        <div class="row">
                            <hr>
                            <br>
                            <input type='text' id='prefix' name='prefix' class='d-none' value='<?php echo $_SESSION['prefix']?>-'>
                            <input type='text' id='id_people' name='id_people' class='d-none'>
                            <input type='text' id='id' name='id' class='d-none'>
                            <div class='form-group col-md-4'>
                                <label for='docNIT'>Doc. Identidad <span class="badge badge-danger">*</span></label>
                                <div class="input-group mb-3 ">
                                    <input type="text" class="form-control form-control-sm" onkeypress="return valid_enter(event);" onkeyup="buscando_datos();" name="documento_persona" id="documento_persona" placeholder="0000000-0"
                                        aria-label="0000000-0" aria-describedby="basic-addon2" >
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-dark " id="search_peoples" type="button" onclick="search_people();">Buscar</button>
                                    </div>
                                </div>
                            </div>

                            <div class='form-group col-md-4'>
                                <label for='docNIT'>Codigo <span class="badge badge-danger">*</span></label>
                                <input type='text' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" id='codigo' name='codigo'
                                    placeholder='ABD-0002' required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nombre">NIT <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="nit" name="nit"
                                onkeypress="return valid_enter(event)" placeholder="Ejemplo" required readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre"
                                onkeypress="return valid_enter(event)" placeholder="Ejemplo" required readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nombre">E-mail <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="correo" name="correo"
                                onkeypress="return valid_enter(event)"  placeholder="Ejemplo" required readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="descripcion">Departamento</label>
                                <select name='departament' id='departament' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" required></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="descripcion">Cargo</label>
                                <input type="text" class="form-control form-control-sm" id="cargo" name="cargo"
                                onkeypress="return valid_enter(event)" placeholder="ADMINISTRADOR" required >
                            </div>
                        </div>
                        <input type="button" name="password" id="next" class="next btn btn-dark" value="Next" />
                    </fieldset>


                    <fieldset>
                        <h2>Step 2: Crea un usuario y perfil para el empleado</h2>
                        <div class="row">
                            <hr>
                            <br>

                            <div class="form-group col-md-4">
                                <label for="nombre">Usuario <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="user" name="user"
                                    placeholder="Ejemplo" required >
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nombre">Alias <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="alias" name="alias"
                                    placeholder="Ejemplo" required >
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nombre">Password <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="password" name="password"
                                    placeholder="Ejemplo" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nombre">Confirm Password <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="c_password" name="c_password"
                                    placeholder="Ejemplo" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nombre">Estado <span class="badge badge-danger">*</span></label>
                                <select name='estate' id='estate' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" required>
                                    <option value="1">ACTIVO</option>
                                    <option value="2">INACTIVO</option>
                                    <option value="3">BLOQUEADO</option>
                                    </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nombre">Nivel <span class="badge badge-danger">*</span></label>
                                <select name='level' id='level' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" required></select>
                            </div>

                        </div>
                        <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
                        <input type="button" name="button" class="submit btn btn-success" onclick="grabardatos();" value="Grabar" />
                    </fieldset>
                </form>

             
                <!--   <form id="registro" onsubmit="return createEmployee()">
                    <div class="form-row">
                        
                </form> -->
            </div>
        </div>
    </div>
    </div>
    </div>






    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro_edit" novalidate action="action.php" method="post">
                        <div class="row">
                            <hr>
                            <br>
                            <input type='text' id='prefix_edit' name='prefix_edit' class='d-none' value='-'>
                            <input type='text' id='id_people_edit' name='id_people_edit' class='d-none'>
                            <input type='text' id='id_edit' name='id_edit' class='d-none'>
                            <div class='form-group col-md-4'>
                                <label for='docNIT'>Doc. Identidad <span class="badge badge-danger">*</span></label>
                                <div class="input-group mb-3 ">
                                    <input type="text" class="form-control form-control-sm" onkeypress="return valid_enter(event);" onkeyup="buscando_datos();" name="documento_persona_edit" id="documento_persona_edit" placeholder="0000000-0"
                                        aria-label="0000000-0" aria-describedby="basic-addon2"  required readonly>
                                </div>
                            </div>

                            <div class='form-group col-md-4'>
                                <label for='docNIT'>Codigo <span class="badge badge-danger">*</span></label>
                                <input type='text' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" id='codigo_edit' name='codigo_edit'
                                    placeholder='ABD-0002' required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nombre">NIT <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="nit_edit" name="nit_edit"
                                    placeholder="Ejemplo" required readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="nombre_edit" name="nombre_edit"
                                    placeholder="Ejemplo" required readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nombre">E-mail <span class="badge badge-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="correo_edit" name="correo_edit"
                                    placeholder="Ejemplo" required readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="descripcion">Departamento</label>
                                <select name='departament_edit' id='departament_edit' class='form-control form-control-sm'
                                    onkeypress="return valid_enter(event)" required></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="descripcion">Cargo</label>
                                <input type="text" class="form-control form-control-sm" id="cargo_edit" name="cargo_edit"
                                    placeholder="ADMINISTRADOR" required >
                            </div>
                        </div>
                        <input type="button" name="button" class="submit btn btn-success" onclick="grabardatos_edit();" value="Grabar" />
                </form>
            </div>
        </div>
    </div>
    </div>