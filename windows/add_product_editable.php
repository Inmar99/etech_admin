</div>

</div>
</div>

</div>
</div>
<div class="modal fade" id="modal_producto_person" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AGREGAR PRODUCTO PERSONALIZADO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <input type='text' id='id_product' name='id_product' class='d-none'>
                    <input type='text' id='cod_product' name='cod_product' class='d-none'>
                    <input type='text' id='factor_product' name='factor_product' class='d-none'>

                    <div class='form-group col-md-12'>
                        <label for='docNIT'>Nombre <span class="badge badge-danger">*</span></label>
                        <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)"
                            id='name_product' name='name_product' placeholder='Nombre' required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="descripcion" class="text-default"><strong>Precio Venta</strong></label>
                        <input type="text" class="form-control form-control-sm" id="precio_producto"
                            name="precio_producto" placeholder="Tipo o Proposito del producto">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="nombre">Precio Sugerido <span class="badge badge-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="precio_producto_sug"
                            name="precio_producto_sug" placeholder="Ejemplo" value="0.0">
                    </div>

                 

                    <div class='form-group col-md-6'>
                        <label for='docNIT'>Presentacion <span class="badge badge-danger">*</span></label>
                        <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)"
                            id='presentacion_producto' name='presentacion_producto' placeholder='UNIDAD' required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success"
                    onclick="agregarProductoGenerico();">Agregar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>