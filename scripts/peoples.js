function init_list() {
    get_peoples();
  }
  
  function init_add() {
    list_countries();
    list_countries_nacionality();
    cargar_departamentos();
    cargar_municipios();

    $(document).ready(function(){
      $('#docNIT').mask('0000-000000-000-0');
      $('#docDUI').mask('00000000-0');
      $('#telFijo').mask('0000-0000');
      $('#telCelular').mask('0000-0000');
      $('#whattsapp').mask('0000-0000');
    });
  }
  
  function init_list_data_cre() {
    init_list_data();
  }
  
  function init_list_client() {
    list_data_clients();
  }

  function initVendors() {
    readVendors();
  }
  
  function get_peoples() {
    let url = "&action=listPeople";
    $.ajax({
      url: "../../controller/controller_people.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        var table = $("#datos").DataTable().clear().draw();;
        table.destroy();
        let filas = "";
        for (let i = 0; i < datos.length; i++) {
          let id_va = datos[i]["id"];
          let id = "<td>" + datos[i]["id"] + "</td>";
          let identetity_documents =
            "<td>" + datos[i]["identity_documents"] + "</td>";
          let document_nit = "<td>" + datos[i]["document_nit"] + "</td>";
          let name =
            "<td>" +
            datos[i]["name"] +
            " " +
            datos[i]["name2"] +
            " " +
            datos[i]["surname"] +
            " " +
            datos[i]["surname2"] +
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
        $("#datos").DataTable({});
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  }
  
  function list_data_clients() {
    let url = "&action=list_data_clients";
    $.ajax({
      url: "../../controller/controller_people.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        var table = $("#datos").DataTable().clear().draw();;
        table.destroy();
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
        $("#datos").DataTable({});
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  }
  
  
  
  function init_list_data() {
    let url = "&action=list_cot";
    $.ajax({
      url: "../../controller/controller_people.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        var table = $("#datos").DataTable().clear().draw();;
        table.destroy();
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
         
  
  
          filas +=
            "<tr>" +
            numero +
            monto +
            cliente +
            documento +
            "</tr>";
        }
  
        $("#data").append(filas);
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
      url: "../../controller/controller_people.php",
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
      url: "../../controller/controller_people.php",
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
      url: "../../controller/controller_people.php",
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
      url: "../../controller/controller_people.php",
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
      url: "../../controller/controller_people.php",
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
      url: "../../controller/controller_people.php",
      data: $("#registro").serialize() + type,
      success: function (r) {
        if (r == 1) {
          console.log(r);
          $("#registro")[0].reset();
          alert_top_mi("Se ha ingresado la nueva persona", "success");
          get_peoples();
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


  function activateProductos() {
    $(".inventarios").click();
  }
  
  /* ***************************************************************************************** */
  /* 
    Obteniendo perfil de persona
  */
  
  function get_person_profile(id) {
    let url = "&action=get_person_profile&id=" + id;
    $.ajax({
      url: "../../controller/controller_people.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        var cant = datos.length;
        if (cant >= 1) {
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
  
  
  function is_client(id) {
    let url = "&action=is_client&id=" + id;
    $.ajax({
      url: "../../controller/controller_people.php",
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
  
  
  function hacer_cliente() {
    var id_person = document.getElementById("id_person").value;
    let type = "&action=insert_client&id=" + id_person;
      $.ajax({
      type: "POST",
      url: "../../controller/controller_people.php",
      data: type,
      success: function (r) {
        if (r == "true") {
          console.log(r);
          alert_top_mi("Se ha ingresado el nuevo cliente", "success");
          get_person_profile(id_person)
        } else {
          alert_top_mi("Error al tratar registrar los datos", "error");
          return false;
        }
      },
    });
  
    return false;
  }


  function viewPeopleAdd() {
    mostrarModal();
    init_add();
  }
  

  function valid_enter(e) {
    if (e.keyCode == 13) {
        return false;
    }else{
      return true;
    }
}



 /************************ AREA DE PROVEEDORES ********************************* */
/************************ FUNCIONES CRUD  ************************/
function createVendors() {
  let type = "&action=insertVendors";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_people.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readVendors();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editVendors(id) {
  mostrarModalCommand();
    let url = "&id="+id+"&action=listDataVendorsToId";
  $.ajax({
    url: "../../controller/controller_people.php",
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
        $("#nombre_comercial").val(datos[i]["tradename"]);
        $("#email").val(datos[i]["email"]);
        $("#contacto").val(datos[i]["contact"]);
        $("#contacto_2").val(datos[i]["contact_2"]);
        $("#plazo").val(datos[i]["term"]);
        $("#direccion").val(datos[i]["direction"]);
        $("#descripcion").val(datos[i]["description"]);
      }

      console.log(id)
     
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function readVendors() {
  let url = "&action=listDataVendors";
  $.ajax({
    url: "../../controller/controller_people.php",
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
        let tradename = "<td>" + datos[i]["tradename"] + "</td>";
        let contact = "<td>" + datos[i]["contact_2"] + "</td>";
        let email = "<td>" + datos[i]["email"] + "</td>";
        let plazo = "<td>" + datos[i]["term"] + "</td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editVendors(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletVendors(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + cod + name + tradename +  contact + email + plazo +  btn + "</tr>";
      }
      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function deletVendors(id) {
  Swal.fire({
    title: 'Estas seguros de esto?',
    text: "Una vez eliminado no habra vuelta atras!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!'
  }).then((result) => {
    if (result.value) {
      deletVendorsToId(id);
    }else{
      alert_top_mi('Se cancelo el proceso de eliminado', 'warning')
    }
  })
}



function deletVendorsToId(id) {
  let type = "&id=" + id + "&action=deleteVendors";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_people.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el grupo", "success");
        readVendors();
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
      mostrarModalCommand();
    } else if (e.altKey & (String.fromCharCode(e.keyCode) == "R")) {
      readGroups();
    }
  });


   /* Lanza el modal para llenar los datos del grupo */
   function mostrarModalCommand() {
    $("#registro")[0].reset();
    mostrarModal();
    $(document).ready(function () {
      $("#codigo").mask("AAA-000");
    });
  }