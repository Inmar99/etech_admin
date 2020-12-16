function init_employee() {
  readEmployees();
  disableButtons("new");
}




function grabardatos_edit() {
  let id = document.getElementById("id_edit").value;
  let url = "&action=createEmployee&id=" + id;
  $.ajax({
    type: "POST",
    url: "../../controller/controller_rrhh.php",
    data: $("#registro_edit").serialize() + url,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro_edit")[0].reset();
        alert_top_mi("Se han actualizado los datos", "success");
        disableButtons("new");
      } else {
        alert_top_mi("Error al tratar actualizar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function grabardatos() {
  let password = $("#password").val();
  let c_password = $("#c_password").val();

  if (password == c_password) {
    let url = "&action=createEmployee";
    $.ajax({
      type: "POST",
      url: "../../controller/controller_rrhh.php",
      data: $("#registro").serialize() + url,
      success: function (r) {
        if (r == 1) {
          console.log(r);
          $("#registro")[0].reset();
          alert_top_mi("Se ha ingresado el los datos", "success");
          disableButtons("new");
          searchMaxEmployee();
        } else {
          alert_top_mi("Error al tratar registrar los datos", "error");
          return false;
        }
      },
    });
    return false;
  } else {
    alert_top_mi("Las contraseñas no coinciden", "error");
  }
}

/* AREA OF EMPLOYEES */

function createEmployee() {
  let type = "&action=insertDepartament";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_rrhh.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readDepartaments();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function createCodEmployee() {
  let url = "&action=createCodEmployee";
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      if (datos.length >= 1) {
        for (let i = 0; i < datos.length; i++) {
          let numero = parseFloat(datos[i]["num"], 10);
          let prefix = document.getElementById("prefix").value;
          numero = numero + 1;
          let codigo = generarCodigo(numero, 5);
          let code_employee = (prefix += codigo);
          document.getElementById("codigo").value = code_employee;
        }
      } else {
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function validateExistEmployee() {
  let id = document.getElementById("documento_persona").value;
  let url = "&action=validateExistEmployee&id=" + id;
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      if (datos.length >= 1) {
        for (let i = 0; i < datos.length; i++) {}

        alert_top_mi("Esta persona ya esta registrada como empleado", "error");
        disableButtons("new");
      } else {
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function editEmployee(id) {
  $("#modal_edit").modal("show");
  $("#registro")[0].reset();
  disableButtons("new");
  list_departaments_edit();
  $("#departament").removeAttr("disabled", true);
  $("#id_edit").val(id);

  var id_employee = document.getElementById("id_edit").value;
  let url = "&identity_documents=" + id_employee + "&action=searchEmployee";
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      if (datos.length >= 1) {
        for (let i = 0; i < datos.length; i++) {
          $("#nombre_edit").val(datos[i]["NAME"]);
          $("#nit_edit").val(datos[i]["document_nit"]);
          $("#correo_edit").val(datos[i]["email"]);
          $("#cargo_edit").val(datos[i]["cargo"]);
          $("#codigo_edit").val(datos[i]["cod"]);
          $("#documento_persona_edit").val(datos[i]["identity_documents"]);
          $(
            "#departament_edit option[value='" +
              datos[i]["id_departament"] +
              "']"
          ).attr("selected", true);
        }
      } else {
        alert_top_mi(
          "Al parecer los datos no hacen referencia a ninguna persona",
          "error"
        );
        $("#id_people_edit").val("");
        $("#nombre_edit").val("");
        $("#nit_edit").val("");
        $("#correo_edit").val("");
        $("#cargo_edit").val("");
        disableButtons("new");
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function readEmployees() {
  let url = "&action=list_data_employees";
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      var table = $("#datos").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let cod = "<td>" + datos[i]["cod"] + "</td>";
        let name = "<td>" + datos[i]["NAME"] + "</td>";
        let cargo = "<td>" + datos[i]["cargo"] + "</td>";
        let departament = "<td>" + datos[i]["departament"] + "</td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editEmployee(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletDepartament(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + cod + name + cargo + departament + btn + "</tr>";
      }
      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

/* AREA OF DEPARTAMENTS */

function createDepartament() {
  let type = "&action=insertDepartament";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_rrhh.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readDepartaments();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editDepartament(id) {
  mostrarModalGrupos();
  let url = "&id=" + id + "&action=listDataDepartamentToId";
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      for (let i = 0; i < datos.length; i++) {
        $("#id").val(datos[i]["id"]);
        $("#codigo").val(datos[i]["cod"]);
        $("#nombre").val(datos[i]["name"]);
        $("#descripcion").val(datos[i]["description"]);
      }

      console.log(id);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function readDepartaments() {
  let url = "&action=listDataDepartament";
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      var table = $("#datos").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let cod = "<td>" + datos[i]["cod"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";
        let description = "<td>" + datos[i]["description"] + "</td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editDepartament(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletDepartament(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + cod + name + description + btn + "</tr>";
      }
      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function deletDepartament(id) {
  Swal.fire({
    title: "Estas seguros de esto?",
    text: "Una vez eliminado no habra vuelta atras!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.value) {
      deletDepartamentToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletDepartamentToId(id) {
  let type = "&id=" + id + "&action=deleteDepartament";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_rrhh.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el grupo", "success");
        readDepartaments();
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/************************ FUNCIONES VARIAS  ************************/

/* Detecta eventos del teclado asi como las diferentes combinaciones del mismo */
$(document).keydown(function (e) {
  e = e || event;
  if (e.altKey & (String.fromCharCode(e.keyCode) == "N")) {
    mostrarModalGrupos();
  } else if (e.altKey & (String.fromCharCode(e.keyCode) == "R")) {
    readDepartaments();
  }
});

/* -----> Generalidades
  altKey: para la tecla alt.
  shiftKey: para la tecla shift (mayúsculas)
  ctrlKey: para la tecla Ctrl
  */

/* Limpia el buscador local, en la parte superior de la ventana */
function cancel_search() {}

/* Ejecuta el buscador local, en la parte superior de la ventana */
function search() {
  alert_top_mi("Buscando...", "info");
}

/* Lanza el modal para llenar los datos del grupo */
function mostrarModalGrupos() {
  $("#registro")[0].reset();
  mostrarModal();
  $(document).ready(function () {
    $("#codigo").mask("AAAA-0000");
  });

  disableButtons("new");
}

/* Cancela el evento enter de los campos para impedir enviar data mediante el enter default */
function valid_enter(e) {
  if (e.keyCode == 13) {
    return false;
  } else {
    return true;
  }
}

/**
 * Funcion para buscar la persona que corresponde a la persona
 *
 */

function search_people() {
  var identity_documents = document.getElementById("documento_persona").value;
  let url =
    "&identity_documents=" + identity_documents + "&action=searchPeople";
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      if (datos.length >= 1) {
        for (let i = 0; i < datos.length; i++) {
          $("#id_people").val(datos[i]["id"]);
          $("#nombre").val(datos[i]["name"]);
          $("#nit").val(datos[i]["document_nit"]);
          $("#correo").val(datos[i]["email"]);
        }
        disableButtons("is_people");
        validateExistEmployee();
      } else {
        alert_top_mi(
          "Al parecer los datos no hacen referencia a ninguna persona",
          "error"
        );
        $("#id_people").val("");
        $("#nombre").val("");
        $("#nit").val("");
        $("#correo").val("");
        disableButtons("new");
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

$(document).ready(function () {
  $("#documento_persona").mask("00000000-0");
});

function buscando_datos() {
  var data = document.getElementById("documento_persona").value.length;
  if (data == 10) {
    search_people();
    $("#search_peoples").removeAttr("disabled", true);
  }
}

/**
 * Funciones del modal por step
 *
 */
$(document).ready(function () {
  var current = 1,
    current_step,
    next_step,
    steps;
  steps = $("fieldset").length;

  $(".next").click(function () {
    let code = document.getElementById("codigo").value.length;
    let id = document.getElementById("id_people").value.length;
    let cargo = document.getElementById("cargo").value.length;

    if (code >= 1) {
      if (id >= 1) {
        if (cargo >= 1) {
          current_step = $(this).parent();
          next_step = $(this).parent().next();
          next_step.show();
          current_step.hide();
          setProgressBar(++current);
          generarUsuario();
          getLevelUsers();
        } else {
          alert_top_mi("Debes de agregar un cargo al empleado", "info");
        }
      } else {
        alert_top_mi("No se seleccionaron datos de una persona", "info");
      }
    } else {
      alert_top_mi("Debes de asignar un codigo", "info");
    }
  });

  $(".previous").click(function () {
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
    setProgressBar(--current);
  });

  setProgressBar(current);
  // Change progress bar action
  function setProgressBar(curStep) {
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar").css("width", percent + "%");
    $("#porcentaje").html(percent + "%");
  }
});

function disableButtons(cons) {
  if (cons == "new") {
    $("#search_peoples").attr("disabled", true);
    $("#next").attr("disabled", true);
    $("#departament").attr("disabled", true);
    $("#cargo").attr("disabled", true);
  } else if (cons == "is_people") {
    $("#departament").removeAttr("disabled", true);
    $("#cargo").removeAttr("disabled", true);
    $("#next").removeAttr("disabled", true);
    list_departaments();
    createCodEmployee();
  } else if (cons == "search") {
    $("#search_peoples").removeAttr("disabled", true);
  }
}

/* List Departaments */

/**Llena el combo de grupos en el modal de productos */
function list_departaments() {
  let url = "&action=list_departaments";
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      document.getElementById("departament").innerHTML = "";
      var select = document.getElementById("departament"); //Seleccionamos el select
      for (var i = 0; i < datos.length; i++) {
        select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function list_departaments_edit() {
  let url = "&action=list_departaments";
  $.ajax({
    url: "../../controller/controller_rrhh.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      document.getElementById("departament_edit").innerHTML = "";
      var select = document.getElementById("departament_edit"); //Seleccionamos el select
      for (var i = 0; i < datos.length; i++) {
        select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

/* GET LEVEL USERS */

function getLevelUsers() {
  let url = "&action=getLevelUsers";
  $.ajax({
    url: "../../controller/controller_user.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      document.getElementById("level").innerHTML = "";
      var select = document.getElementById("level"); //Seleccionamos el select
      for (var i = 0; i < datos.length; i++) {
        let nivel = parseInt(datos[i]["level"]);
        if (nivel >= 60) {
        } else {
          select.options[i] = new Option(
            datos[i]["level"] + " | " + datos[i]["name"],
            datos[i]["id"]
          );
        }
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function getCompanyInfoProfile() {
  let url = "&action=getCompanyInfoProfile";
  $.ajax(
    {
      url: "../../controller/controller_admin.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {}
    }
  ).done(datos => {
    
  }).fail(resp => { console.log(resp.responseText) });
}


function generarUsuario() {
  let name = document
    .getElementById("nombre")
    .value.substr(0, 15)
    .toLowerCase()
    .replace(/ /g, "");
  let code = document.getElementById("codigo").value;
  $("#user").val(name);
  $("#alias").val(name);
  $("#password").val(code);
  $("#c_password").val(code);
}

function generarCodigo(number, len) {
  const fill = (number, len) =>
    "0".repeat(len - number.toString().length) + number.toString();
  let a = "";
  return (a = fill(number, len));
}





/* AREA OF MARKER */

function init_marker() {
  console.log("Datos");
  document.getElementById("lc_code").focus();
  
}





function post_data() {
  let code_target = document.getElementById("lc_code").value;
  let prexif = document.getElementById("prefix").value;
  let code_employee = prexif + document.getElementById("code").value;

 

  if (code_target.length > 1 ) {
    getEmployeeMarkerCod(code_target)
    
  }else if (code_employee.length > 1) {
    getEmployeeMarkerCod(code_employee);
  }else {
    alert_top_mi("Error, debe de llenar todos los campos, o presentar su carnet", "error") 
  }


  function getEmployeeMarkerCod(cod) {
      let url = "&action=getEmployeeMarkerCod&cod=" + cod;
      $.ajax({
        url: "../../controller/controller_rrhh.php",
        type: "POST",
        dataType: "json",
        data: url,
        beforeSend: function () {},
      })
        //Obtenemos la respuesta del servidor
        .done(function (datos) {
          if (datos.length >= 1) {
            let id = datos[0]['id'];
            let name = datos[0]['name_employee'];
            searchMarkerEmployee(id, name);
          }else {
            alert_top_mi("Error, al parecer no se encontro el empleado", "warning")
          }
          
        })
        .fail(function (resp) {
          console.log(resp.responseText);
        });
    }
}

function valid_enter_lector(e) {
  if (e.keyCode == 13) {
    post_data();
  } else {
    return true;
  }
}

function isPar(num) { return num % 2;}

function generateMarkerEmployee(id,name,tipo) {
  let dat = "&action=generateMarkerEmployee"+ "&id=" + id + "&type=" + tipo;
  $.ajax({
    type: "POST",
    url: "../../controller/controller_rrhh.php",
    data: dat,
    success: function (r) {
     if (r == true || r == "true" || r == 1 || r == "1") {
       alert_warning("Perfecto, se registro su " + tipo + ", correctamente " + name);
       setTimeout(function(){
        window.location.reload(1);
     }, 3000);
     }else{
       alert_warning("Error, No se logro registrar su acceso, contacte a INMAR CORTEZ", "warning")
     }
      
    },
  });
  return false;
}


function searchMarkerEmployee(id, name) {
  let url = "&action=searchMarkerEmployee&id=" + id;
      $.ajax({
        url: "../../controller/controller_rrhh.php",
        type: "POST",
        dataType: "json",
        data: url,
        beforeSend: function () {},
      })
        //Obtenemos la respuesta del servidor
        .done(function (datos) {
          if (datos.length >= 1) {
            let number = parseInt(datos[0]['number_marker'], 10);
            let type_number = isPar(number);
            let type = "";
            if (type_number == 0) {
             type = "ENTRADA";
            }else{
              type = "SALIDA";
            }
            generateMarkerEmployee(id,name, type);
            
          }else {
            alert_top_mi("Error, al parecer no se encontro el empleado", "warning")
          }
          
        })
        .fail(function (resp) {
          console.log(resp.responseText);
        });
}

function sendmail(params) {
  
}

function sendmailEmployee(name, emial, cod, cargo, user, password) {
  let url = "&name_employee=" + name + "&email_employee=" +emial+ "&code_employee=" + cod + "&cargo_employee=" + cargo + "&user_employee=" + user + "&password=" + password;
  $.ajax({
    url: "../out/send_mail_employee.php",
    type: "POST",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos)
      
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function searchMaxEmployee() {
  let url = "&action=searchMaxEmployee";
      $.ajax({
        url: "../../controller/controller_rrhh.php",
        type: "POST",
        dataType: "json",
        data: url,
        beforeSend: function () {},
      })
        //Obtenemos la respuesta del servidor
        .done(function (datos) {
          if (datos.length >= 1) {
            let number = datos[0]['id'];
            getDataEmployee(number);
          }else {
            alert_top_mi("Error, No se pudo enviar el correo", "warning")
          }
          
        })
        .fail(function (resp) {
          console.log(resp.responseText);
        });
}

function getDataEmployee(id) {
  let url = "&action=getDataEmployee&id=" + id;
      $.ajax({
        url: "../../controller/controller_rrhh.php",
        type: "POST",
        dataType: "json",
        data: url,
        beforeSend: function () {},
      })
        //Obtenemos la respuesta del servidor
        .done(function (datos) {
          if (datos.length >= 1) {
            let name = datos[0]['name_people'];
            let mail = datos[0]['email'];
            let code = datos[0]['cod'];
            let cargo = datos[0]['cargo'];
            let user = datos[0]['username'];
            let password = datos[0]['password'];
            sendmailEmployee(name, mail, code, cargo, user, password)
          }else {
            alert_top_mi("Error, No se pudo enviar el correo", "warning")
          }
          
        })
        .fail(function (resp) {
          console.log(resp.responseText);
        });
  
 
}



