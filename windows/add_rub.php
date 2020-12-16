<?php 


?>

<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Rubros </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro" onsubmit="return createMaxRub()">
                    <div class="form-row">
                        <input type='text' id='id' name='id' class='d-none'>

                      
                        <div class='form-group col-md-12'>
                            <label for='docNIT'>Codigo <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='codigo' name='codigo'
                                placeholder='ABD-0002' required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nombre">Nombre <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ejemplo" required>
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