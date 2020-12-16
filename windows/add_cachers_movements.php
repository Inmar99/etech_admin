<?php 


?>

<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Movimientos Caja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro" onsubmit="return createMovements()">
                    <div class="form-row">
    
                        <div class='form-group col-md-6'>
                            <label for='docNIT'>Codigo <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='codigo' name='codigo'
                                placeholder='ABD-0002' required readonly >
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='docNIT'>Afecta</label>
                            <select name='afecta' id='afecta' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required>
                                <option value="SALE">SALE</option>
                                <option value="ENTRA">ENTRA</option>
                                </select>
                        </div>


                        <div class="form-group col-md-12">
                            <label for="nombre">Tipo</label>
                            <select name='type_movement' id='type_movement' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required></select>
                        </div>

                        <div class='form-group col-md-12'>
                            <label for='docNIT'>Monto <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='monto' name='monto'
                                placeholder='0,00' required>
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
    
    
    </div>
        </div>
    </div>
    
    </div>
        </div>
    </div>
    