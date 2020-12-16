/* function init_list() {
    get_peoples();
  }
  
  function init_add() {
    list_countries();
    list_countries_nacionality();
    cargar_departamentos();
    cargar_municipios();
  }
  
  function init_list_data_cre() {
    init_list_data();
  }
  
  function init_list_client() {
    list_data_clients();
  }
   */
function get_peoples() {
  let url = "&action=listPeople";
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id_va = datos[i]["id"];
        let id = "<td>" + datos[i]["id"] + "</td>";
        let identetity_documents =
          "<td>" + datos[i]["identity_documents"] + "</td>";
        let document_nit = "<td>" + datos[i]["document_nit"] + "</td>";
        let name =
          "<td>" +
          datos[i]["name"].toUpperCase() +
          " " +
          datos[i]["name2"].toUpperCase() +
          " " +
          datos[i]["surname"].toUpperCase() +
          " " +
          datos[i]["surname2"].toUpperCase() +
          "</td>";
        let contact = "<td>" + datos[i]["landline"] + "</td>";
        let email = "<td>" + datos[i]["email"] + "</td>";
        let type = "<td>" + datos[i]["type_person"] + "</td>";
        let work_place = "<td>" + datos[i]["work_place"] + "</td>";

        var btn =
          "<td>" +
          "<button class=' btn btn-sm btn-primary' onclick='obtener_persona(" +
          id_va +
          ");'><i class='fas fa-eye'></i></button>" +
          "</td>";

        filas +=
          "<tr>" +
          identetity_documents +
          document_nit +
          type +
          name +
          contact +
          work_place +
          btn +
          "</tr>";
      }

      $("#data").append(filas);

      var table = $("#datos").DataTable();
      table.destroy();
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function list_data_clients() {
  let url = "&action=list_data_clients";
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id_va = datos[i]["id"];
        let id = "<td>" + datos[i]["id"] + "</td>";
        let identetity_documents =
          "<td>" + datos[i]["identity_documents"] + "</td>";
        let document_nit = "<td>" + datos[i]["document_nit"] + "</td>";
        let name =
          "<td>" +
          datos[i]["name"].toUpperCase() +
          " " +
          datos[i]["name2"].toUpperCase() +
          " " +
          datos[i]["surname"].toUpperCase() +
          " " +
          datos[i]["surname2"].toUpperCase() +
          "</td>";
        let contact = "<td>" + datos[i]["landline"] + "</td>";
        let email = "<td>" + datos[i]["email"] + "</td>";
        let type = "<td>" + datos[i]["type_person"] + "</td>";
        let work_place = "<td>" + datos[i]["work_place"] + "</td>";

        var btn =
          "<td>" +
          "<button class=' btn btn-sm btn-primary' onclick='obtener_persona(" +
          id_va +
          ");'><i class='fas fa-eye'></i></button>" +
          "</td>";

        filas +=
          "<tr>" +
          identetity_documents +
          document_nit +
          type +
          name +
          contact +
          work_place +
          btn +
          "</tr>";
      }

      $("#data").append(filas);

      var table = $("#datos").DataTable();
      table.destroy();
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function init_list_data() {
  let url = "&action=list_cot";
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id_va = datos[i]["id_cotizacion"];
        let numero = "<td>" + datos[i]["numero_cotizacion"] + "</td>";
        let monto = "<td> $" + datos[i]["total_venta"] + "</td>";
        let cliente =
          "<td>" +
          datos[i]["name"].toUpperCase() +
          " " +
          datos[i]["name2"].toUpperCase() +
          " " +
          datos[i]["surname"].toUpperCase() +
          " " +
          datos[i]["surname2"].toUpperCase() +
          "</td>";
        let documento = "<td>" + datos[i]["identity_documents"] + "</td>";

        filas += "<tr>" + numero + monto + cliente + documento + "</tr>";
      }

      $("#data").append(filas);

      var table = $("#datos").DataTable();
      table.destroy();
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function verificar_datos() {
  alert_top_mi("Alert", "error");
}

function list_countries() {
  let url = "&action=list_countries";
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      var select = document.getElementById("id_paisResid"); //Seleccionamos el select
      for (var i = 0; i < datos.length; i++) {
        select.options[i] = new Option(datos[i]["NAME"], datos[i]["id"]);
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function list_countries_nacionality() {
  let url = "&action=list_countries";
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      document.getElementById("id_paisNac").innerHTML = "";
      var select = document.getElementById("id_paisNac"); //Seleccionamos el select
      for (var i = 0; i < datos.length; i++) {
        select.options[i] = new Option(datos[i]["NAME"], datos[i]["id"]);
      }
      cargar_nacionalidad();
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function get_nacionality(id) {
  let url = "&action=get_nationality&id_country=" + id;
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      var nacionalidad = datos[0]["nationality"];
      document.getElementById("nacionalidad").value = nacionalidad;
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function list_departaments(id_country) {
  let url = "&action=list_departaments&id_country=" + id_country;
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      document.getElementById("id_departamento").innerHTML = "";
      var select = document.getElementById("id_departamento"); //Seleccionamos el select
      for (var i = 0; i < datos.length; i++) {
        select.options[i] = new Option(datos[i]["NAME"], datos[i]["id"]);
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function list_municipalities(id_departament) {
  let url = "&action=list_municipalities&id_departament=" + id_departament;
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      document.getElementById("id_municipio").innerHTML = "";
      var select = document.getElementById("id_municipio"); //Seleccionamos el select
      for (var i = 0; i < datos.length; i++) {
        select.options[i] = new Option(datos[i]["NAME"], datos[i]["id"]);
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function insertarDatos() {
  let type = "&action=insertPeople";
  $.ajax({
    type: "POST",
    url: "src/controllers/people_controller.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado la nueva persona", "success");
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });

  return false;
}

function cargar_nacionalidad() {
  var id_pais = document.getElementById("id_paisNac").value;
  get_nacionality(id_pais);
}

function cargar_departamentos() {
  var id_pais = document.getElementById("id_paisResid").value;
  list_departaments(id_pais);
}

function cargar_municipios() {
  var id_departamento = document.getElementById("id_departamento").value;
  list_municipalities(id_departamento);
}

function cancel_search() {
  console.log("hola");
}

function search() {
  alert_top_mi("Buscando...", "info");
}

function obtener_persona(id) {
  $("#perfil").modal("show");
  get_person_profile(id);
}

/* ***************************************************************************************** */
/* 
    Obteniendo perfil de persona
  */

function get_person_profile(id) {
  let url = "&action=get_person_profile&id=" + id;
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      var cant = datos.length;
      if (cant >= 1) {
        get_person_profile_history(id);
        get_person_record(id);
        is_client(id);

        document.getElementById("id_person").value = datos[0]["id"];
        document.getElementById("persona").value = datos[0]["persona"];
        document.getElementById("type_person").value = datos[0]["type_person"];
        document.getElementById("identity_documents").value =
          datos[0]["identity_documents"];
        document.getElementById("document_nit").value =
          datos[0]["document_nit"];
        document.getElementById("profession").value = datos[0]["profession"];
        document.getElementById("email").value = datos[0]["email"];
        document.getElementById("landline").value = datos[0]["landline"];
        document.getElementById("cell_phone").value = datos[0]["cell_phone"];
        document.getElementById("work_place").value = datos[0]["work_place"];
        document.getElementById("position").value = datos[0]["position"];
        document.getElementById("department").value = datos[0]["department"];
        document.getElementById("name").value = datos[0]["name"];
      } else {
        alert_top_mi(
          "Al parecer no se puede acceder al perfil solicitado",
          "info"
        );
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function get_person_record(id) {
  let url = "&action=get_person_record&id=" + id;
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      var cant = datos.length;
      if (cant >= 1) {
        document.getElementById("record").value = datos[0]["record"];
        document.getElementById("amount-1").value = datos[0]["amount"];
      } else {
        /* alert_top_mi("No hay registros de movimiento de la persona", "info"); */
      }

      console.log(datos);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function is_client(id) {
  let url = "&action=is_client&id=" + id;
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      var cant = datos.length;
      if (cant >= 1) {
        $("#cliente").show();
        $("#haz_cliente").hide();
      } else {
        $("#haz_cliente").show();
        $("#cliente").hide();
      }

      console.log(datos);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function get_person_profile_history(id) {
  let url = "&action=get_person_profile_history&id=" + id;
  $.ajax({
    url: "src/controllers/people_controller.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      let filas = "";
      var cont = datos.length;

      if (cont >= 1) {
        for (let i = 0; i < datos.length; i++) {
          let tipo = "<td>" + datos[i]["type_record"] + "</td>";
          let name = "<td>" + datos[i]["name"] + "</td>";
          let amount = "<td>" + datos[i]["amount"] + "</td>";
          let status = "<td>" + datos[i]["status"] + "</td>";
          let creado_SRV = "<td>" + datos[i]["creado_SRV"] + "</td>";

          filas +=
            "<tr>" + name + tipo + amount + status + creado_SRV + "</tr>";
        }

        var table = $("#datos_credito").DataTable();
        table.destroy();
        $("#data_credito").append(filas);
        $("#datos_credito").DataTable({});
      } else {
        var table = $("#datos_credito").DataTable();
        var rows = table.rows().remove().draw();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function hacer_cliente() {
  var id_person = document.getElementById("id_person").value;
  let type = "&action=insert_client&id=" + id_person;
  $.ajax({
    type: "POST",
    url: "src/controllers/people_controller.php",
    data: type,
    success: function (r) {
      if (r == "true") {
        console.log(r);
        alert_top_mi("Se ha ingresado el nuevo cliente", "success");
        get_person_profile(id_person);
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });

  return false;
}





function getDataHome() {
  
}



function validar_dia() {
  let url = "&action=validDayInit";
  $.ajax({
    url: "../../controller/controller_admin.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos)
      if (datos.length >= 1) {
        window.open('invoice.php', '_blank');
      }else {
        errorAperturarDia();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function validar_dia_cierre() {
  let url = "&action=validDayFinish";
  $.ajax({
    url: "../../controller/controller_admin.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      if (datos.length >= 1) {
        errorCierreDia();
      }else {
       return true;
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });

}



function errorAperturarDia() {
  Swal.fire({
    title: "Al parecer no se ha aperturado la CAJA-DIA",
    text:
      "Deceas aperturar CAJA-DIA",
    icon: "error",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Aperturar!",
  }).then((result) => {
    if (result.value) {
      window.location="cachers_movements.php";
    } else {
      alert_top_mi("Se cancelo el proceso", "warning");
    }
  });
}


function errorCierreDia() {
  Swal.fire({
    title: "¡¡ERROR!! Al parecer este dia ya esta cerrado",
    text:
      "¿Decea generar la transaccion con una fecha posterior? ",
    icon: "error",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, generar transaccion!",
  }).then((result) => {
    if (result.value) {
      cambiarFecha();
    } else {
      alert_top_mi("Se cancelo el proceso", "warning");
    }
  });
}


 function cambiarFecha() {

    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth() + 1; //obteniendo mes
    var dia = fecha.getDate() + 1; //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
    if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
    document.getElementById("fecha_trans").value = ano + "-" + mes + "-" + dia;

  
}


function sumarDias(fecha, dias){
  fecha.setDate(fecha.getDate() + dias);
  return fecha;
}

 

const mostrarFecha = days => {
  
  fecha=new Date();
  console.log("Fecha actual: "+devolverFechaFormateada(fecha));

  fecha.setDate(fecha.getDate()+days);
  console.log(" - Fecha "+(days>0?"+"+days:days)+" dias : "+devolverFechaFormateada(fecha));
}

const devolverFechaFormateada = fecha => {
  const day=fecha.getDate();
  // el mes es devuelto entre 0 y 11
  const month=fecha.getMonth()+1;
  const year=fecha.getFullYear();
  return day+"/"+month+"/"+year;
}



function fechas() {
  let hoy = new Date();
let semanaEnMilisegundos = 1000 * 60 * 60 * 24 * 7;
let suma = hoy.getTime() + semanaEnMilisegundos; //getTime devuelve milisegundos de esa fecha
let fechaDentroDeUnaSemana = new Date(suma);

console.log(fechaDentroDeUnaSemana)
}