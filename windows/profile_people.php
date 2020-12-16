<?php



?>


<?php 


?>




<div class="modal fade bd-example-modal-lg" id="perfil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="container emp-profile">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="profile-img">
                                        <img src="../../src/img/perfil/user.jpg" alt="" with="200px"
                                            height="200px" />
                                    </div>
                                    <button type="button" id="haz_cliente" class="btn btn-primary" onclick="hacer_cliente();">
                                        Hacer Cliente
                                    </button>
                                    <button type="button" id="cliente" class="btn btn-success">
                                        Cliente
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-head">
                                        <h6>
                                            <label for="">Nombre completo: </label>
                                            <input class="form-control" id="persona" type="text" placeholder=""
                                                readonly>
                                        </h6>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                                    role="tab" aria-controls="home" aria-selected="true">Datos
                                                    Personales</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                                    role="tab" aria-controls="profile" aria-selected="false">Historial</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Tipo:
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="type_person" type="text"
                                                                placeholder="Tipo" readonly>
                                                                <input class="d-none" id="id_person" type="text"
                                                                placeholder="Tipo" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Doc
                                                            Identidad: </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="identity_documents"
                                                                type="text" placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Doc.
                                                            NIT: </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="document_nit" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Email:
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="email" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail"
                                                            class="col-sm-4 col-form-label">Telefono: </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="landline" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail"
                                                            class="col-sm-4 col-form-label">Celular: </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="cell_phone" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Lugar
                                                            de Trabajo</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="work_place" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail"
                                                            class="col-sm-4 col-form-label">Posicion: </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="position" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail"
                                                            class="col-sm-4 col-form-label">Profesion: </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="profession" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail"
                                                            class="col-sm-4 col-form-label">Direccion</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="direction" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="d-none">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail"
                                                            class="col-sm-4 col-form-label">Departamento: </label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="department" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="staticEmail"
                                                            class="col-sm-4 col-form-label">Municipio</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="name" type="text"
                                                                placeholder="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="table-responsive">
                                                <table class="table " id="datos_credito" width="100%" cellspacing="0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Entidad</th>
                                                            <th>Tipo</th>
                                                            <th>Monto</th>
                                                            <th>Estado</th>
                                                            <th>Fecha</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="data_credito">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>