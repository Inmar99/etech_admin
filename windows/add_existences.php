</div>
</div>
</div>
</div>
<div class="modal fade" id="modal_view_existences" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Toma fisica de existencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro_secondary" onsubmit="return createExistence()">
                    <div class="form-row">
                        <input type='text' id='id_existences' name='id_existences' class='d-none'>
                        <input type='text' id='id_product_existences' name='id_product_existences' class='d-none'>
                        <input type='text' id='id_product_pres' name='id_product_pres' class='d-none'>

                      
                        <div class='form-group col-md-3'>
                            <label for='cod'>Codigo Interno</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='cod' name='cod' placeholder='Producto'
                                readonly>
                        </div>
                        <div class='form-group col-md-3'>
                            <label for='bar_code'>Codigo de Barra</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='bar_code' name='bar_code' placeholder='Producto'
                                readonly>
                        </div>
                        <div class='form-group col-md-6'>
                            <label for='existen'>Nombre del Product </label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='name' name='name' placeholder='Producto'
                                readonly>
                        </div>

                        <div class='form-group col-md-3'>
                            <label for='existen'>Existencias Actuales </label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='existen' name='existen' placeholder='Numero de Existencias'
                                readonly>
                        </div>


                        <div class='form-group col-md-3'>
                            <label for='exis_sumar'> <span class="badge badge-success">SUMAR</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='exis_sumar' name='exis_sumar' placeholder='250'
                                >
                        </div>

                        <div class='form-group col-md-3'>
                            <label for='exis_restar'> <span class="badge badge-danger">RESTAR</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='exis_restar' name='exis_restar placeholder='250'
                                >
                        </div>

                    
                    </div>

                    <div class="table-responsive py-4" id="tabla_presentaciones">
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
                        <input type="submit" id="btnGrabar" class="btn btn-outline-dark" value="Grabar">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>