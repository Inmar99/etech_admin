<?php


?>

<div class="modal fade" id="modify_comp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar datos de la compa&ntilde;&iacute;a</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateCmp" onsubmit="return updateCompanyInfo()">
                <div class="modal-body">
                    <!-- Company Information -->
                    <h6 class="heading-small text-muted mb-4">informac&oacute;n de la compa&ntilde;&iacute;a</h6>
                    <hr class="my-4" />
                    <div class="form-row">
                        <input type='text' id='id' name='id' class='d-none form-control form-control-sm'>

                        <div class='form-group col-md-6'>
                            <label for='cmpName'>Nombre<span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' id='cmpName' name='cmpName' onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cmpEmail">Correo Electr&oacute;nico<span class="badge badge-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="cmpEmail" name="cmpEmail" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="cmpSlogan">Eslogan</label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpSlogan" name="cmpSlogan" onkeypress="return valid_enter(event)">
                        </div>
                    </div>
                    <!-- Company Legal Information -->
                    <h6 class="heading-small text-muted mb-4">informac&oacute;n legal de la compa&ntilde;&iacute;a</h6>
                    <hr class="my-4" />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cmpLegalName">Nombre Legal<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpLegalName" name="cmpLegalName" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cmpTurn">Giro Principal<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpTurn" name="cmpTurn" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cmpNIT">NIT<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpNIT" name="cmpNIT" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cmpNRC">NRC<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpNRC" name="cmpNRC" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="cmpLegalRep">Representante Legal<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpLegalRep" name="cmpLegalRep" onkeypress="return valid_enter(event)" required>
                        </div>
                    </div>
                    <!-- Company Contact and Location Information -->
                    <h6 class="heading-small text-muted mb-4">Informaci&oacute;n de Contacto y Ubicaci&oacute;n</h6>
                    <hr class="my-4" />
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cmpAddress">Direcci&oacute;n<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpAddress" name="cmpAddress" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="cmpCountry">Pa&iacute;s<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpCountry" name="cmpCountry" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="cmpState">Departamento<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpState" name="cmpState" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="cmpPostalCode">C&oacute;digo Postal</label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpPostalCode" name="cmpPostalCode" onkeypress="return valid_enter(event)">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="cmpMunicipality">Municipio<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpMunicipality" name="cmpMunicipality" onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cmpCity">Ciudad</label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpCity" name="cmpCity" onkeypress="return valid_enter(event)">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="cmpTelephone">Numero Telef&oacute;nico<span class="badge badge-danger">*</span></label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpTelephone" name="cmpTelephone" onkeypress="return valid_enter(event)" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cmpFAX">FAX</label>
                            <input type="textarea" class="form-control form-control-sm" id="cmpFAX" name="cmpFAX" onkeypress="return valid_enter(event)">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnGrabar" class="btn btn-outline-dark" value="Grabar">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>