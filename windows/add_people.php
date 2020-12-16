<?php 


?>

<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registro" onsubmit="return insertarDatos()">
                    <div class="form-row">
                        <input type='text' id='id' name='id' class='d-none'>

                        <div class="form-group col-md-2">
                            <label for="inputState">Tipo persona</label>
                            <select name="type_person" id="type_person" class="form-control form-control-sm">
                                <option value="NATURAL" selected>NATURAL</option>
                                <option value="JURIDICA">JURIDICA</option>
                            </select>
                        </div>

                        <div class='form-group col-md-2'>
                            <label for='docNIT'>Documento NIT <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='docNIT' name='docNIT'
                                placeholder='0000-000000-000-0' required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="docDUI">Documento DUI <span class="badge badge-danger">*</span></label> 
                            <input type="text" class="form-control form-control-sm" id="docDUI" name="docDUI" placeholder="00000000-0" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="fch_emision">Fecha de Emision</label>
                            <input type="date" class="form-control form-control-sm" id="fch_emision" name="fch_emision"
                                placeholder="Fecha de Emision">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="fch_expiracion">Fecha de Expiracion</label>
                            <input type="date" class="form-control form-control-sm" id="fch_expiracion" name="fch_expiracion"
                                placeholder="Fecha de Expiracion">
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='lgar_emision'>Lugar de emision</label>
                                <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='lgar_emision' name="lgar_emision"
                                    placeholder='Lugar de emision'>
                        </div>

                        <div class="form-group col-md-3">
                            <label  for="fch_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control form-control-sm" id="fch_nacimiento" name="fch_nacimiento"
                                    placeholder="Fecha de Nacimiento">
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='lgar_nacimiento'>Lugar de nacimiento</label>
                                <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='lgar_nacimiento' name="lgar_nacimiento"
                                    placeholder='Lugar de nacimiento'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='docPasaporte'>Doc. Pasaporte</label>
                                <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='docPasaporte' name="docPasaporte"
                                    placeholder='Doc. Pasaporte'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='docVISA'>Doc. VISA</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='docVISA' name="docVISA"
                                    placeholder='Doc. VISA'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='docConducir'>Lic. Conducir</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='docConducir' name="docConducir"
                                    placeholder='Lic. Conducir'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='profesion'>Profesion</label>
                            <input type='text' class='form-control form-control-sm ' id='profesion' name="profesion"
                                    placeholder='Profesion'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='p_nombre'>Primer Nombre <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='p_nombre' name="p_nombre"
                                    placeholder='Primer Nombre' required>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='s_nombre'>Segundo Nombre</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='s_nombre' name="s_nombre"
                                    placeholder='Segundo Nombre'>
                        </div>


                        <div class='form-group col-md-3'>
                            <label  for='p_apellido'>Primer Apellido <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='p_apellido' name="p_apellido"
                                    placeholder='Primer Apellido' required>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='s_apellido'>Segundo Apellido</label>
                           <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='s_apellido' name="s_apellido"
                                    placeholder='Segundo Apellido'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='email'>Correo Electronico</label>
                            <input type='email' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='email' name="email"
                                    placeholder='Correo Electronico'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='telFijo'>Tel. Fijo <span class="badge badge-danger">*</span></label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='telFijo' name="telFijo"
                                    placeholder='Tel. Fijo' required>
                        </div>


                        <div class='form-group col-md-3'>
                            <label  for='telCelular'>Tel. Celular</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='telCelular' name="telCelular"
                                    placeholder='Tel. Celular'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='whattsapp'>Whattsapp</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='whattsapp' name="whattsapp"
                                    placeholder='Whattsapp'>
                        </div>

                        <div class='form-group col-md-2'>
                            <label  for='slt_ecivil'>Estado Civil</label>
                            <select name='slt_ecivil' id='slt_ecivil' class='form-control form-control-sm' onkeypress="return valid_enter(event)">
                                    <option value='Soltero/a'>Soltero/a</option>
                                    <option value='Casado/a'>Casado/a</option>
                                    <option value='Divorciado/a'>Divorciado/a</option>
                                    <option value='Viudo/a'>Viudo/a</option>
                                </select>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='lgar_trabajo'>Lugar de Trabajo</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='lgar_trabajo' name="lgar_trabajo"
                                    placeholder='Lugar de Trabajo'>
                        </div>

                        <div class='form-group col-md-3'>
                            <label  for='cargo'>Cargo desempeña</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='cargo' name="cargo"
                                    placeholder='Cargo desempeña'>
                        </div>

                        <div class='form-group col-md-2'>
                            <label  for='id_paisNac'>Pais de Nacionalidad</label>
                            <select name='id_paisNac' id='id_paisNac' class='form-control form-control-sm' onkeypress="return valid_enter(event)"
                                    onchange="cargar_nacionalidad()" required>

                                </select>
                        </div>

                        <div class='form-group col-md-2'>
                            <label  for='nacionalidad'>Nacionalidad</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='nacionalidad' name="nacionalidad"
                                    placeholder='Nacionalidad'>
                        </div>


                        <div class='form-group col-md-2'>
                            <label  for='id_paisResid'>Pais de Redisencia</label>
                            <select name='id_paisResid' id='id_paisResid' class='form-control form-control-sm' onkeypress="return valid_enter(event)"
                                    onchange="cargar_departamentos()">
                                    <option value='1'>EL Salvador</option>
                                </select>
                        </div>

                        <div class='form-group col-md-2'>
                            <label  for='id_departamento'>Departamento</label>
                            <select name='id_departamento' id='id_departamento' class='form-control form-control-sm' onkeypress="return valid_enter(event)"
                                    onchange="cargar_municipios()">
                                    <option value='1'>EL Salvador</option>
                                </select>
                        </div>

                        <div class='form-group col-md-2'>
                            <label  for='id_municipio'>Municipio</label>
                            <select name='id_municipio' id='id_municipio' class='form-control form-control-sm' onkeypress="return valid_enter(event)">
                                    <option value='1'>EL Salvador</option>
                                </select>
                        </div>

                        <div class='form-group col-md-8'>
                            <label  for='direccion'>Direccion</label>
                            <input type='text' class='form-control form-control-sm' onkeypress="return valid_enter(event)" id='direccion' name="direccion"
                                    placeholder='Direccion'>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnGrabar" class="btn btn-dark" value="Ok">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>