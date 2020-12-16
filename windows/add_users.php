<?php


?>

<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar un nuevo Usuario.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_user" onsubmit="return create_user()">
                <div class="modal-body">
                    <!-- Company Information -->
                    <h6 class="heading-small text-muted mb-4">Datos del Usuario.</h6>
                    <hr class="my-4" />
                    <div class="form-row">
                        <input type='text' id='id' name='id' class=''>

                        <div class='form-group col-md-12'>
                            <label for='usrEmail'>Correo Electr&oacute;nico<span class="badge badge-danger">*</span></label>
                            <input type='email' class='form-control form-control-sm' id='usrEmail' name='usrEmail' onkeypress="return valid_enter(event)" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="usrName">Nombre de Usuario<span class="badge badge-danger">*</span></label>
                            <input type="text" style="display: inline-block; width: 85%;" class="form-control form-control-sm" id="usrName" name="usrName" 
                            onkeypress="return valid_enter(event)" onkeyup="verify_username(this.value)" required>
                            <label for="cmpSlogan">
                                <span id="usrAvailable" class="badge" style="font-size: medium; color: white;" data-toggle="tooltip" data-placement="top">
                                    <i id="tipIcon" class="ni ni-check-bold"></i>
                                </span>
                            </label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="usrLevel">Cargo o Privilegios</label>
                            <select name="usrLevel" id="usrLevel" class='form-control form-control-sm' onkeypress="return valid_enter(event)" required></select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="usrPass">Contrase&ntilde;a<span class="badge badge-danger">*</span></label>
                            <input type="password" class="form-control form-control-sm" id="usrPass" name="usrPass" onkeypress="return valid_enter(event)">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="usrConfPass">Repita la Contrase&ntilde;a<span class="badge badge-danger">*</span></label>
                            <input type="password" class="form-control form-control-sm" id="usrConfPass" name="usrConfPass" 
                            onkeypress="return valid_enter(event)" onkeyup="confirm_password(this)">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="usrStatus">Estado</label>
                            <select name="usrStatus" id="usrStatus" class='form-control form-control-sm' onkeypress="return valid_enter(event)"></select>
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

<script>

</script>