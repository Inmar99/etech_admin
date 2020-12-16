</div>
<div class="modal fade" id="modal_view_1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Lotes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro_secondary" onsubmit="return createLot()">
                    <div class="form-row">
                        <input type='text' id='id_lot' name='id_lot' class='d-none'>
                        <input type='text' id='id_product_lot' name='id_product_lot' class='d-none'>

                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Numero Lote <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='num_lot' name='num_lot' placeholder='AS211251W'
                                required>
                        </div>


                        <div class='form-group col-md-3'>
                            <label for='docNIT'>Cantidad <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='cant_lot' name='cant_lot' placeholder='250' value = '1'
                                required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nombre">Fecha de Lote <span class="badge badge-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" id="fecha_lot" name="fecha_lot"
                                placeholder="Ejemplo" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="descripcion">Fecha de Caducidad</label>
                            <input type="date" class="form-control form-control-sm" id="vence_lot"
                                name="vence_lot" placeholder="Tipo o Proposito del producto">
                        </div>
                    </div>

                    <div class="table-responsive py-4">
                    <table class="table table-flush" id="datos_secondary">
                        <thead class="thead-light">
                            <tr>
                                <th>Lote N°</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Fecha caduca</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Lote N°</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Fecha caduca</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody id="data_secondary">

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