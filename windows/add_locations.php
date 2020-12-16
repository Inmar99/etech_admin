<?php 


?>

<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Ubicaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro" onsubmit="return createLocations()">
                    <div class="form-row">
                        <input type='text' id='id' name='id' class='d-none'>

                        <div class='form-group col-md-12'>
                            <label for='docNIT'>Codigo <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='codigo' name='codigo'
                                placeholder='ABD-0002' required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nombre">Nombre <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Vitrina 1" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nombre">Descripcion</label> 
                            <textarea type="text" class="form-control form-control-sm"
                                onkeypress="return valid_enter(event)" id="descripcion" name="descripcion"
                                placeholder="Una pequeña descripción" rows="3"></textarea>
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
    