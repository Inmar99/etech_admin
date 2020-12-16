<?php 
/**
*
* Inmar Cortez | Programer & CEO (iPOS-Systems)
* Copyright  iPOS-Systems
* Coded by inmarcortez | inmarcortez@outlook.com
* Creado el: 14-05-2020
*
**/

?>

<div class="modal fade" id="modal_view">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
<!-- <div class="col-xl-8 order-xl-1"> -->
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Editar Perfil</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control" placeholder="Username" value="<?php echo $_SESSION['alias_perfil'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control" placeholder="ejemplo@e_tech.com" value="<?php echo $_SESSION['email_usuario'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="<?php echo $_SESSION['nombre_perfil'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="<?php echo $_SESSION['apellido_perfil'] ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="input-address" class="form-control" placeholder="Home Address" value="<?php echo $_SESSION['direcion_perfil'] ?>" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" class="form-control" placeholder="City" value="<?php echo $_SESSION['ciudad_perfil'] ?>">
                      </div>
                    </div>
                  
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Contact</label>
                        <input type="number" id="input-postal" class="form-control" placeholder="503" value="<?php echo $_SESSION['contacto_perfil'] ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About me</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">About Me</label>
                    <textarea rows="4" class="form-control" placeholder="A few words about you ..."><?php echo $_SESSION['acerca_perfil'] ?></textarea>
                  </div>
                </div>
                <div class="col-12 text-right">
                <button  class="btn btn-success" onclick="modificar_perfil();">Actualizar</button>
                <input type="button" class="btn btn-danger" value="Cerrar" onclick="cerrarModal();" >
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_view_sec">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
<!-- <div class="col-xl-8 order-xl-1"> -->
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Modificar contraseña</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">Completa la informacion</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Antigua Contraseña</label>
                        <input type="password" id="ant_password" class="form-control" placeholder="**********">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Nueva Contraseña</label>
                        <input type="password" id="new_password" class="form-control" placeholder="**********">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Repita Contraseña</label>
                        <input type="password" id="rep_password" class="form-control" placeholder="**********">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 text-right">
                <button  class="btn  btn-success" onclick="validar_datos_reset();">Actualizar</button>
                <input type="button" class="btn  btn-danger" value="Cerrar" onclick="cerrarModal_Sec();" >
                </div>

            </div>
          </div>
        </div>
    </div>
</div>

