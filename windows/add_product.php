<?php 


?>

<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Grupo de Productos</h5>
                <br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="dataFormClear();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
                <form id="registro" onsubmit="return createProduct()">
                    <div class="form-row">

                        <input type='text' id='id' name='id' class='d-none'>
                        <input type='text' id='type_process' name='type_process' class='d-none' value='insert'>
                        
                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Codigo Interno<span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='codigo' name='codigo' placeholder='ABD-0002'
                                required>
                        </div>

                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Codigo Barra</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='codigo_barra' name='codigo_barra'
                                placeholder='0005215-254055-200'>
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='docNIT'>Nombre <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='nombre' name='nombre'
                                placeholder='Modulo o Producto' required>
                        </div>

                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Costo<span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='precio_costo' name='precio_costo'
                                placeholder='$5.22' required>
                        </div>

                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Precio sugerido<span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='precio_v1' name='precio_v1'
                                placeholder='$12.22' required>
                        </div>
                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Precio Venta</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='precio_v2' name='precio_v2'
                                placeholder='$9.99'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Precio Mayoreo</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='precio_mayoreo' name='precio_mayoreo'
                                placeholder='$9.99'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Presentacion</label>
                            <select name='id_presentacion' id='id_presentacion' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required>
                                <option value="1">Unidad</option>
                                <option value="2">Caja</option>
                                <option value="3">Fardo</option>
                                </select>
                        </div>
                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Modelo</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='modelo' name='modelo' placeholder='B4'>
                        </div>
                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Version</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='version' name='version'
                                placeholder='V2.1'>
                        </div>
                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Stock Minimo</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='stk_min' name='stk_min'
                                placeholder='500'>
                        </div>
                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Stock Medio</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='stk_med' name='stk_med'
                                placeholder='1000'>
                        </div>
                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Stock Maximo</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='stk_max' name='stk_max'
                                placeholder='2000'>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombre">Proveedor</label>
                            <select name='id_proveedor' id='id_proveedor' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required></select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombre">Laboratorio</label>
                            <select name='id_lab' id='id_lab' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required></select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombre">Rubro </label>
                            <select name='id_rub' id='id_rub' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" onchange="list_groupsToRub();" required></select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Grupo </label>
                            <select name='id_grupo' id='id_grupo' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" onchange="list_subgroupToGroup();" required></select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Sub-Grupo </label>
                            <select name='id_subgrupo' id='id_subgrupo' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required> 
                                </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Ubicacion </label>
                            <select name='id_ubicacion' id='id_ubicacion' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required></select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nombre">Ubicacion Secundaria</label>
                            <select name='id_ubicacion_2' id='id_ubicacion_2' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)"></select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nombre">Estado</label>
                            <select name='state' id='state' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required></select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nombre">Incluye IVA</label>
                            <select name='precio_iva' id='precio_iva' class='form-control form-control-sm select-activo'
                                onkeypress="return valid_enter(event)" required>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                                </select>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="descripcion">Descripcion</label>
                            <textarea type="text" class="form-control form-control-sm"
                                onkeypress="return valid_enter(event)" id="descripcion" name="descripcion"
                                placeholder="Tipo o Proposito del producto" rows="3"></textarea>
                        </div>

                    
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnGrabar" class="d-none" value="Grabar">
                        <input type="button" id="btnData" class="btn btn-outline-dark" value="Grabar" onclick="validate_cod_inser();">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>