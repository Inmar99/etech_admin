<?php

/**
*
* Inmar Cortez | Programer & CEO (E-TECH)
* Copyright  E-TECH SOLUTIONS
* Coded by inmarcortez | inmarcortez@outlook.com
* Creado el: 28-11-2020
*
**/

?>
</div>
</div>
</div>
</div>
<div class="modal fade" id="finish_invoice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Company Information -->
                <h6 class="heading-small text-muted mb-4">Datos del Facturacion</h6>
                <div class="form-row">
                    <div class='form-group col-md-6'>
                        <div class='form-group col-md-12'>
                            <label for='usrEmail'>Total a Pagar: <span class="badge badge-danger">*</span></label>
                            <input type='price_total_invoice' class='form-control form-control-lg' id='txt_total'
                                name='txt_total' readonly onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="usrName">Paga con: <span class="badge badge-danger">*</span></label>
                            <input type="text" style="display: inline-block; width: 85%;"
                                class="form-control form-control-lg" id="txt_paga" name="txt_paga"
                                onkeypress="return valid_enter(event)" onkeyup="total_entrega(this.value)" required>
                            <label for="cmpSlogan">
                                <span id="usrAvailable" class="badge badge-success" style="font-size: medium;"
                                    data-toggle="tooltip" data-placement="top">
                                    <i id="tipIcon" class="ni ni-check-bold"></i>
                                </span>
                            </label>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <label class="custom-toggle">
                                <input type="checkbox" name="descReceta" id="descReceta" onclick="aplicateDesc();">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="NO"
                                    data-label-on="SI"></span>
                            </label>
                            <label for="descReceta">APLICAR 5% DESCUENTO POR RECETA</label>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <label class="custom-toggle">
                                <input type="checkbox" name="descCompra" id="descCompra"
                                    onclick="aplicateDescCompra();">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="NO"
                                    data-label-on="SI"></span>
                            </label>
                            <label for="descCompra">APLICAR 3% POR COMPRAS MAYORES</label>
                        </div>



                        <div class='form-group col-md-12'>
                            <label for='usrEmail'>Cambio :</label>
                            <input type='price_total_invoice' class='form-control form-control-lg' id='txtCambio'
                                name='txtCambio' readonly onkeypress="return valid_enter(event)" required>
                            <input type="text" class="d-none" name="txt_descuentoReceta" id="txt_descuentoReceta"
                                value="0">
                            <input type="text" class="d-none" name="txt_descuentoCompra" id="txt_descuentoCompra"
                                value="0">

                        </div>
                    </div>

                    <div class='form-group col-md-3'>
                        <div class="form-row">
                            <div class='form-group col-md-6'>
                                <button class="btn btn-lg btn-outline-primary"
                                    onclick="insertCant('100.00')"> 
                                    &nbsp;100.0</button>
                            </div>

                            <div class='form-group col-md-6'>
                                <button class="btn btn-lg btn-outline-primary"
                                    onclick="insertCant('50.00')"> 
                                    &nbsp;50.00</button>
                            </div>

                            <div class='form-group col-md-6'>
                                <button class="btn btn-lg btn-outline-primary"
                                    onclick="insertCant('20.00')"> 
                                    &nbsp;20.00</button>
                            </div>
                            <div class='form-group col-md-6'>
                                <button class="btn btn-lg btn-outline-primary"
                                    onclick="insertCant('10.00')"> 
                                    &nbsp;10.00</button>
                            </div>
                            <div class='form-group col-md-6'>
                                <button class="btn btn-lg btn-outline-primary"
                                    onclick="insertCant('5.00')"> 
                                    &nbsp;$5.00</button>
                            </div>
                            <div class='form-group col-md-6'>
                                <button class="btn btn-lg btn-outline-primary"
                                    onclick="insertCant('1.00')"> 
                                    &nbsp;$1.00</button>
                                    </div>
                            </div>
                            <div class='form-group col-md-12'>
                                <button class="btn btn-lg btn-outline-danger"
                                    onclick="deletCant()"> <i class="fas fa-backspace"></i>
                                    &nbsp;  Eliminar </button>
                                    
                            </div>
                    </div>


                    <div class='form-group col-md-3'>
                        <div class="form-row">
                            <div class='form-group col-md-12'>
                                <button class="btn btn-lg btn-outline-primary"
                                    onclick="finishTransacctionSale('GRABAR')"> <i
                                        class="fas fa-save text-outline-dark"></i>
                                    &nbsp;Grabar Trans.</button>
                            </div>

                            <div class='form-group col-md-12'>
                                <button class="btn btn-lg btn-outline-dark"
                                    onclick="finishTransacctionSale('IMPRESION')"> <i
                                        class="fas fa-print text-outline-dark"></i>
                                    </i>&nbsp;Imprimir Doc.</button>
                            </div>


                            <div class='form-group col-md-12'>
                                <button class="btn btn-lg btn-outline-primary"
                                    onclick="finishTransacctionSale('GRABAR-OPEN')"> <i
                                        class="fas fa-money-bill-alt text-outline-dark"></i>
                                    &nbsp;Grabar & Open.</button>
                            </div>

                            <div class='form-group col-md-12'>
                                <button class="btn btn-lg btn-outline-dark"
                                    onclick="finishTransacctionSale('IMPRESION-OPEN')"> <i
                                        class="fas fa-money-bill-alt text-outline-dark"></i>
                                    </i>&nbsp;Impr. & Open.</button>
                            </div>

                            <div class=' col-md-12'>
                                <button class="btn btn-outline-danger" onclick="cancelarTransaccion();"><i
                                        class="fas fa-ban text-outline-dark"></i>
                                    </i>&nbsp;Cancelar Trans.</button>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>