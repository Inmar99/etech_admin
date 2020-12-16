<?php 


?>

<div class="modal fade" id="modal_view_2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mantenimiento de Caja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro_sec" onsubmit="return createManagement()">
                    <div class="form-row">

                        <div class='form-group col-md-6'>
                            <div class="card text-white">
                            <div class="card-header text-white bg-gradient-default ">BILLETES</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-dark">$100.00</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event);"   id='billete100' name='billete100'
                                                placeholder='Billetes de $100' >
                                        </div>

                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-dark">$50.00</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event);" id='billete50' name='billete50'
                                                placeholder='Billetes de $50' >
                                        </div>

                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-dark">$20.00</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)"  id='billete20' name='billete20'
                                                placeholder='Billetes de $20' >
                                        </div>
                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-dark">$10.00</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)"  id='billete10' name='billete10'
                                                placeholder='Billetes de $10' >
                                        </div>
                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-dark">$5.00</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)"  id='billete5' name='billete5'
                                                placeholder='Billetes de $5' >
                                        </div>
                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-dark">$1.00</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)"  id='billete1' name='billete1'
                                                placeholder='Billetes de $1' >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class='form-group col-md-6'>
                            <div class="card text-white">
                            <div class="card-header text-white bg-gradient-dark ">MONEDAS</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-default">$1.00</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)" id='moneda1' name='moneda1'
                                                placeholder='Monedas de $1' >
                                        </div>

                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-default">$0.25</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)" id='moneda25' name='moneda25'
                                                placeholder='Monedas de $0.25' >
                                        </div>

                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-default">$0.10</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)" id='moneda10' name='moneda10'
                                                placeholder='Monedas de $0.10' >
                                        </div>
                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-default">$0.5</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)" id='moneda5' name='moneda5'
                                                placeholder='Monedas de $0.5' >
                                        </div>
                                        <div class='form-group col-md-6'>
                                            <label for='docNIT' class="text-default">$0.1</label>
                                            <input type='text' class='form-control form-control-sm soloNumeros'
                                                onkeypress="return valid_enter_caja(event)" id='moneda01' name='moneda01'
                                                placeholder='Monedas de $0.1' >
                                        </div>

                                        <div class='form-group col-md-6'>
                                            <br>
                                        <button type="button" class="btn btn-outline-dark" onclick="moviCajas();">Calcular</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='form-group col-md-2'>
                            <label for='docNIT'></span></label>
                        </div>

                        <div class='form-group col-md-4'>
                            <label for='docNIT'>TIPO <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='type' name='type' placeholder='ABD-0002'
                                required readonly>
                        </div>


                        <div class='form-group col-md-4'>
                            <label for='docNIT'>MONTO</label>
                            <input type='text' class='form-control form-control-sm'
                                onkeypress="return valid_enter(event)" id='mount' name='mount' placeholder='500'
                                required>
                        </div>

                        <div class='form-group col-md-2'>
                            <label for='docNIT'></span></label>
                        </div>

        

                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnGrabar" class="btn btn-outline-success" value="Grabar">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>