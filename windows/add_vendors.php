<?php 


?>

<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Proveedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro" onsubmit="return createVendors()">
                    <div class="form-row">
                        <input type='text' id='id' name='id' class='d-none'>

                      
                        <div class='form-group col-md-4'>
                            <label for='docNIT'>Codigo <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='codigo' name='codigo'
                                placeholder='ABD-0002' required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Nombre <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ejemplo" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Nombre Comercial <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="nombre_comercial" name="nombre_comercial" placeholder="Ejemplo" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">E-Mail <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Ejemplo">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Contacto <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="contacto" name="contacto" placeholder="2606-5254" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Contacto - Directo <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="contacto_2" name="contacto_2" placeholder="7458-8569" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Plazo </label>
                            <label for="" class="text-sm text-danger">Dias</label>
                            <input type="number" class="form-control form-control-sm" id="plazo" name="plazo" placeholder="30" required>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="nombre">Direccion <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ejemplo" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="descripcion">Descripcion</label>
                            <input type="textarea" class="form-control form-control-sm" id="descripcion" name="descripcion"
                                placeholder="Tipo o Proposito del producto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnGrabar" class="btn btn-outline-dark" value="Grabar">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    