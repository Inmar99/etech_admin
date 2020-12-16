</div>
</div>
<div class="modal fade" id="modal_view_2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Presentaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro_secondary_pres" onsubmit="return createPresentations()">
                    <div class="form-row">
                        <input type='text' id='id_pres' name='id_pres' class='d-none'>
                        <input type='text' id='id_product_pres' name='id_product_pres' class='d-none'>

                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Cod Barra <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='barcode_pres' name='barcode_pres' placeholder='012541254'
                                >
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='docNIT'>Nombre <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='name_pres' name='name_pres' placeholder='CAJA'
                                required>
                        </div>


                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Factor <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='factor_pres' name='factor_pres' placeholder='250'
                                required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nombre">Precio Sugerido <span class="badge badge-danger">*</span></label>
                            <input type="text"  class="form-control form-control-sm"  onkeypress="return valid_enter_final(event)" 
                             id="precio_presS" name="precio_presS"  placeholder="5.25">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nombre">Precio Venta <span class="badge badge-danger">*</span></label>
                            <input type="text"  class="form-control form-control-sm"  onkeypress="return valid_enter_final(event)" 
                             id="precio_pres" name="precio_pres"  placeholder="3.25" required>
                        </div>
                       
                    </div>

                    <div class="table-responsive py-4">
                    <table class="table table-flush" id="datos_secondary_pres">
                        <thead class="thead-light">
                            <tr>
                                <th>Cod Barra</th>
                                <th>Nombre</th>
                                <th>Factor</th>
                                <th>Precio Sugerido</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                                <th>Cod Barra</th>
                                <th>Nombre</th>
                                <th>Factor</th>
                                <th>Precio Venta</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody id="data_secondary_pres">

                        </tbody>
                    </table>
                </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnGrabarFinal" class="btn btn-outline-dark" value="Grabar">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>