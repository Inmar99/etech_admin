/************************ FUNCIONES INICIALES  ************************/
function initGroups() {
  readGroups();
  activateProductos();
}


function initProducts() {
  readProducts();
  activateProductos();
}

function initProducts_existences() {
  readProducts_existences();
  activateProductos();
}

function initListInvoices() {
  readInvoices();
}




function initMaxGroups() {
  readMaxGroups();
  list_rubs();
  activateProductos();
}

function initMaxGroups() {
  readMaxRubs();
  activateProductos();
}

function initSubGroups() {
  readSubGroups();
  activateProductos();
}

function initLaboratories() {
  readLaboratories();
  activateProductos();
}

function initLocations() {
  readLocations();
  activateProductos();
}

function activateProductos() {
  $(".inventarios").click();
}

function readInvoices() {
  let url = "&action=list_data_invoices";
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let numero = datos[i]["number"];
        let numer = "<td>" + datos[i]["number"] + "</td>";
        let document = "<td>" + datos[i]["name"] + "</td>";
        let fecha = "<td>" + datos[i]["update_SRV"] + "</td>";
        let total = "<td > $" + datos[i]["total_document"] + "</td>";
        let descuento = "<td> $" + datos[i]["total_document_desc"] + "</td>";
        let des_receta = "<td> $" + datos[i]["desc_recipe"] + "</td>";
        let descuento_extra = "<td> $" + datos[i]["desc_invoice_plus"] + "</td>";
        let usuario = "<td> " + datos[i]["alias"] + "</td>";
      
        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='imprimirTicket_re(" +
          id +
          ")'><i class='fas fa-print text-outline-dark'></i> <span class='nav-link-text'>Re-Impresion</span></button>" +
          "<button class='dropdown-item' onclick='readInvoices_details(" +
          id +
          ", "+ numero + ")'><i class='fas fa-box text-warning'></i> <span class='nav-link-text'>Detalle</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";


        filas +=
        "<tr>" + document +  numer + fecha + usuario  + total + descuento + des_receta  +  btn + "</tr>";

      }

      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function valid_enter_search_invoices(e) {
  if (e.keyCode == 13) {
    readInvoices_where();
    return false;

  } else {
    return true;
  }
}



function readInvoices_where() {
  let num_document = document.getElementById('search_database').value;
  let url = "&action=list_data_invoicesWhere&id=" + num_document;
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let numero = datos[i]["number"];
        let numer = "<td>" + datos[i]["number"] + "</td>";
        let document = "<td>" + datos[i]["name"] + "</td>";
        let fecha = "<td>" + datos[i]["update_SRV"] + "</td>";
        let total = "<td > $" + datos[i]["total_document"] + "</td>";
        let descuento = "<td> $" + datos[i]["total_document_desc"] + "</td>";
        let des_receta = "<td> $" + datos[i]["desc_recipe"] + "</td>";
        let descuento_extra = "<td> $" + datos[i]["desc_invoice_plus"] + "</td>";
        let usuario = "<td> " + datos[i]["alias"] + "</td>";
      
        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='imprimirTicket_re(" +
          id +
          ")'><i class='fas fa-print text-outline-dark'></i> <span class='nav-link-text'>Re-Impresion</span></button>" +
          "<button class='dropdown-item' onclick='readInvoices_details(" +
          id +
          ", "+ numero + ")'><i class='fas fa-box text-warning'></i> <span class='nav-link-text'>Detalle</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";


        filas +=
        "<tr>" + document +  numer + fecha + usuario  + total + descuento + des_receta  +  btn + "</tr>";

      }

      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}



function readInvoices_details(id, number) {
  $('#example_doc').modal('show');
  let url = "&action=list_data_invoiceDetails&id=" + id;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      var table = $("#datos_busqueda").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let name = "<td>" + datos[i]["name"] + "</td>";
        let presentation = "<td>" + datos[i]["presentation"] + "</td>";
        let cant = "<td>" + datos[i]["cant"] + "</td>";
        let factor = "<td > " + datos[i]["factor"] + "</td>";
        let sale_price = "<td> $" + datos[i]["sale_price"] + "</td>";
        let sale_price_suggested = "<td> $" + datos[i]["sale_price_suggested"] + "</td>";
    
  
  
        filas +=
        "<tr>" + name +  cant + presentation + factor  + sale_price_suggested + sale_price + "</tr>";

      }
  
      document.getElementById("data_id").innerHTML = number;

      $("#data_busqueda").append(filas);
      $("#datos_busqueda").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}



/************************ AREA DE PRODUCTOS ******************** */
/************************ FUNCIONES CRUD  ************************/
function createProduct() {

  let data = document.getElementById("page").value; 
  let type = "&action=insertProduct";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (!r.error ) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        if (data == "Normal") {
          readProducts();
        }else if (data == "Detalle") {
          readProductsDet();
        }
        mostrarModalGrupos();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}
function dataFormClear() {
  $("#registro")[0].reset();
}

function validate_cod_inser() {
  let type_process = document.getElementById("type_process").value;
  if (type_process == "insert") {
    validateCodProduct();
  } else {
    $("#btnGrabar").click();
  }
}

function validateCodProduct() {
  let cod = document.getElementById("codigo").value;
  let url = "&action=validateCodProduct&cod=" + cod;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      if (datos.length >= 1) {
        alert_top_mi(
          "Error, El codigo ya existe y pertenece al producto " +
            datos[0]["name"] +
            " Espere un momento se esta creando un nuevo codigo.",
          "error"
        );

        generateCodProduct();
      } else {
        $("#btnGrabar").click();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function generateCodProduct() {
  let table = document.getElementById("table_name").value;
  let url = "&action=generateCodProduct&table=" + table;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",

    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      /**Obtenemo el codigo maximo que existe en la base de datos */
      let data = datos[0]["cod"];
      if (data == "null" || data == null) {
        document.getElementById("codigo").value = "0001";
      } else {
        /* Eliminamos todo tipo de texto que venga con el */
        let code = data.replace(/\D/g, "");
        /* Pasamos el dato a entero para poder sumarle uno */
        let number = parseInt(code, 10) + 1;
        /* Una vez lo tenemos en entero y ya sumado, lo convertimos a texto */
        number = number.toString();
        /* Funcion padStart agrega caracteres a un string */
        number = number.padStart(4, 0);

        document.getElementById("codigo").value = number;
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function readProducts() {
  let url = "&action=listDataProduct";
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let barcode = "<td>" + datos[i]["bar_code"] + "</td>";
        let group = "<td>" + datos[i]["name_group"] + "</td>";
        let name = "<td onclick='addPresentacion(" + id + ")'>" + datos[i]["name"] + "</td>";
        let description = "<td>" + datos[i]["description"] + "</td>";
        let sale_price = "<td> $ " + datos[i]["sale_price"] + "</td>";
        let sale_price_1 = "<td> $ " + datos[i]["sale_price_1"] + "</td>";
        let vendedor = "<td>" + datos[i]['proveedor'] + "</td>";
        let location = "";
        let laboratorie = "<td> " + datos[i]["laboratorie"] + "</td>";
        let set_location = datos[i]["location"];
        let sub_location = datos[i]["sub_location"];
        let existencias = datos["current_existence"];

       
        if (sub_location === "" ||sub_location === ' ' ||sub_location === "null" || sub_location === null || sub_location === undefined) {
          location = "<td>"+ set_location +"</td>";
        }else{
          location = "<td>"+ set_location + "<br><strong>  Otra ubicacion:</strong><br>"+ sub_location +"</td>";
        }

        let status_product =
          "<td><span class='badge badge-" +
          datos[i]["status_product_color"] +
          "'> " +
          datos[i]["status_product_name"] +
          "</span></td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editProduct(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='addPresentacion(" +
          id +
          ")'><i class='fas fa-box text-warning'></i> <span class='nav-link-text'>Presentaciones</span></button>" +
          "<button class='dropdown-item' onclick='addLote(" +
          id +
          ")'><i class='fas fa-poll-h text-info'></i> <span class='nav-link-text'>Lotes</span></button>" +
          "<button class='dropdown-item' onclick='deletProduct(" +
          id +
          ")'><i class='fas fa-trash-alt text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas +=
        "<tr>" + cod + barcode + name  + group + laboratorie + vendedor +  btn + "</tr>";
      }

      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function readProductsDet() {
  document.getElementById("search_database").value = "";
  let url = "&action=listDataProduct";
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let barcode = "<td>" + datos[i]["bar_code"] + "</td>";
        let group = "<td>" + datos[i]["name_group"] + "</td>";
        let name = " <td onclick='addPresentacion(" +id +")'>" + datos[i]["name"] + "</td>";
        let description = "<td>" + datos[i]["description"] + "</td>";
        let sale_price = "<td onclick='addLote(" +id +")'> $ " + datos[i]["sale_price"] + "</td>";
        let sale_price_1 = "<td> $ " + datos[i]["sale_price_1"] + "</td>";
        
        let laboratorie = "<td> " + datos[i]["laboratorie"] + "</td>";
        let location = "";
        let set_location = datos[i]["location"];
        let sub_location = datos[i]["sub_location"];
        let existencias = datos[i]["current_existence"];
        let rowExisten = "";


       
        if (sub_location === "" ||sub_location === ' ' ||sub_location === 'SIN UBICACION' ||sub_location === "null" || sub_location === null || sub_location === undefined) {
          location = "<td>"+ set_location +"</td>";
        }else{
          location = "<td>"+ set_location + "<br><strong>  Otra ubicacion:</strong><br> <label class='text-sm'>"+ sub_location +"</label></td>";
        }


        if (existencias === "" ||existencias === ' ' ||existencias === "null" || existencias === null || existencias === undefined) {
          rowExisten = "<td> 0 </td>";
        }else{
          rowExisten = "<td>"+ existencias +"</td>";
        }

        let status_product =
          "<td><span class='badge badge-" +
          datos[i]["status_product_color"] +
          "'> " +
          datos[i]["status_product_name"] +
          "</span></td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editProduct(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='addPresentacion(" +
          id +
          ")'><i class='fas fa-box text-warning'></i> <span class='nav-link-text'>Presentaciones</span></button>" +
          "<button class='dropdown-item' onclick='addLote(" +
          id +
          ")'><i class='fas fa-poll-h text-info'></i> <span class='nav-link-text'>Lotes</span></button>" +
          "<button class='dropdown-item' onclick='deletProduct(" +
          id +
          ")'><i class='fas fa-trash-alt text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas +=
        "<tr>" + barcode + group + name + sale_price + sale_price_1 + location + laboratorie + rowExisten +  btn + "</tr>";
      }

      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function readProducts_existences() {
  let url = "&action=listDataProduct";
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let barcode = "<td>" + datos[i]["bar_code"] + "</td>";
        let group = "<td onclick='addLote(" + id + ")'>" + datos[i]["name_group"] + "</td>";
        let name = "<td onclick='mostrarModalExistencias(" + id + ")'>" + datos[i]["name"] + "</td>";
        let description = "<td>" + datos[i]["description"] + "</td>";
        let sale_price = "<td> $ " + datos[i]["sale_price"] + "</td>";
        let sale_price_1 = "<td> $ " + datos[i]["sale_price_1"] + "</td>";
        let vendedor = "<td>" + datos[i]['proveedor'] + "</td>";
        let location = "";
        let laboratorie = "<td> " + datos[i]["laboratorie"] + "</td>";
        let set_location = datos[i]["location"];
        let sub_location = datos[i]["sub_location"];

       
        if (sub_location === "" ||sub_location === ' ' ||sub_location === "null" || sub_location === null || sub_location === undefined) {
          location = "<td>"+ set_location +"</td>";
        }else{
          location = "<td>"+ set_location + "<br><strong>  Otra ubicacion:</strong><br>"+ sub_location +"</td>";
        }

        let status_product =
          "<td><span class='badge badge-" +
          datos[i]["status_product_color"] +
          "'> " +
          datos[i]["status_product_name"] +
          "</span></td>";

        var btn =
          "<td>" +
          "<button class='btn btn-dark btn-sm' onclick='mostrarModalExistencias(" +
          id +
          ")'><i class='fas fa-calculator'></i><span class='nav-link-text'></span></button>" +
          "</td>";

        filas +=
        "<tr>" + cod + barcode + name  + group + laboratorie + location +vendedor +  btn + "</tr>";
      }

      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function editProduct(id) {
  mostrarModalGruposEdit();
  document.getElementById("type_process").value = "edit";
  let url = "&id=" + id + "&action=listDataProductToId";
  setTimeout(
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      console.log(datos);
      for (let i = 0; i < datos.length; i++) {
        let status = datos[i]["status_product"];
        let grupo = datos[i]["id_group"];
        let rubro = datos[i]["id_rub"];
        let id_subgroup = datos[i]["id_subgroup"];
        let id_vendor = datos[i]["id_vendor"];
        let id_laboratorie = datos[i]["id_laboratorie"];
        let id_location = datos[i]["id_location"];
        let id_sub_location = datos[i]["id_sub_location"];
        let id_presentation = datos[i]["id_presentation"];

        $("#id").val(datos[i]["id"]);
        $("#codigo").val(datos[i]["cod"]);
        $("#codigo_barra").val(datos[i]["bar_code"]);
        $("#id_rub").select2({ val: rubro });
        $("#id_proveedor").select2({ val: id_vendor });

        $("#id_rub").val(rubro).trigger("change.select2");
        $("#id_proveedor").val(id_vendor).trigger("change.select2");
        $("#id_lab").val(id_laboratorie).trigger("change.select2");
        $("#id_ubicacion").val(id_location).trigger("change.select2");
        $("#id_ubicacion_2").val(id_sub_location).trigger("change.select2");
        $("#id_presentacion").val(id_presentation).trigger("change.select2");

        $("#state option[value=" + status + "]").attr("selected", true);
        $("#precio_v1").val(datos[i]["sale_price"]);
        $("#precio_v2").val(datos[i]["sale_price_1"]);
        $("#nombre").val(datos[i]["name"]);
        $("#descripcion").val(datos[i]["description"]);
        $("#precio_costo").val(datos[i]["cost"]);
        $("#precio_mayoreo").val(datos[i]["wholesalers_price"]);
        $("#modelo").val(datos[i]["model"]);
        $("#version").val(datos[i]["version"]);
        $("#stk_min").val(datos[i]["stk_min"]);
        $("#stk_med").val(datos[i]["stk_med"]);
        $("#stk_max").val(datos[i]["stk_max"]);
        $("#include_IVA").val(datos[i]["include_IVA"]);

        seleccionarGrupo(grupo, id_subgroup);
      }

      document.getElementById("type_process").value = "edit";

      console.log(id);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    }, 500)
  )
}

function mostrarModalExistencias(id) {
  $("#modal_view_existences").modal('show');
  editExistences(id);
  readPresentationsToId(id);
}

function editExistences(id) {

  document.getElementById('id_product_pres').value = id;
  document.getElementById('id_product_existences').value = id;
  

  let url = "&id=" + id + "&action=readExistences";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      if (datos.length >= 1) {

        let existen = datos[0]["current_existence"];
        let id = datos[0]["id"];
        let name = datos[0]["name"];
        let bar_code = datos[0]["bar_code"];
        let cod = datos[0]["cod"];

        if (existen === "" ||existen === ' ' ||existen === "null" || existen === null || existen === undefined) {
            existen = 0;
        }else{
          
        }
        $("#id_existences").val(id);
        $("#existen").val(existen);
        $("#cod").val(cod);
        $("#bar_code").val(bar_code);
        $("#name").val(name);
      }else {

        alert_top_mi('No se encontraron existencias relacionadas a este producto', 'error');
        $("#id_existences").val('');
        $("#existen").val('0');
        llenarDataExistencias(id)

      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });

}


function llenarDataExistencias(id) {
  let url = "&id=" + id + "&action=listDataProductsToId";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      if (datos.length >= 1) {

        let id = datos[0]["id"];
        let name = datos[0]["name"];
        let bar_code = datos[0]["bar_code"];
        let cod = datos[0]["cod"];
        let existen = 0;

      
        $("#id_existences").val('');
        $("#id_product_existences").val(id);
        $("#id_product_pres").val(id);
        $("#existen").val(existen);
        $("#cod").val(cod);
        $("#bar_code").val(bar_code);
        $("#name").val(name);

    
      }else {

        alert_top_mi('No se encontro datos de este prodcuto', 'error');

      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function createExistence() {

  let sumar = document.getElementById("exis_sumar").value; 
  let restar = document.getElementById("exis_restar").value; 
  let existen = parseInt(document.getElementById("existen").value); 
  let id_existen = document.getElementById("id_existences").value; 
  let id_product = document.getElementById("id_product_pres").value;
  let cantidad = 0; 
  let type = "";

   existen = (existen == null || existen == undefined || existen == "") ? 0 : existen;
 
  if (id_existen.length >= 1) {
    if (sumar.length >= 1) {
      type = "&action=UpdateExistences";
      cantidad = parseInt(existen) + parseInt(sumar);
    }else if (restar.length >= 1) {
      type = "&action=UpdateExistences";
      cantidad = parseInt(existen) - parseInt(restar);
    }else {
      alert_top_mi('Debe de agregar una cantidad para efectuar el calculo', 'error')
     return false;

    }
  }else{
    type = "&action=insertExistences";
      cantidad = parseInt(existen) + parseInt(sumar);
  }

  url = type + "&id_product=" + id_product + "&id_existen=" + id_existen + "&cantidad=" + cantidad;
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: url,
    success: function (r) {
      if (r == 1) {
        $("#registro_secondary")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        editExistences(id_product) 
        
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}



function dataFormClear() {
  $("#registro")[0].reset();
}



function seleccionarGrupo(id_grupo, id_subgroup) {
  alert_top_mi("Procesando Datos", "warning");
  setTimeout(function () {
    $("#id_grupo").val(id_grupo).trigger("change.select2");
    list_subgroupToGroup();
    seleccionarSubGrupo(id_subgroup);
  }, 3000);
}

function seleccionarSubGrupo(id_subgroup) {
  setTimeout(function () {
    $("#id_subgrupo").val(id_subgroup).trigger("change.select2");
  }, 3000);
}

function deletProduct(id) {
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
      deletProductToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletProductToId(id) {
  let data = document.getElementById("page").value;
  let type = "&id=" + id + "&action=deleteProduct";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el grupo", "success");
        if (data == "Normal") {
          readProducts();
        }else if (data == "Detalle") {
          readProductsDet();
        }
        
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/************************ AREA DE GRUPOS ********************************* */
/************************ FUNCIONES CRUD  ************************/
function createGroup() {
  let type = "&action=insertGroup";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        $("#modal_view").modal("hide");
      } else {
        alert_top_mi(
          "Error al tratar registrar los datos, verificar si el codigo ya existe",
          "error"
        );
        return false;
      }
    },
  });
  return false;
}

function readGroups() {
  let url = "&action=listDataGroup";
  $.ajax({
    url: "../../controller/controller_products.php",
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
          "<button class='dropdown-item' onclick='editGroup(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletGroup(" +
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

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editGroup(id) {
  mostrarModalGruposEdit();
  let url = "&id=" + id + "&action=listDataGroupToId";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      for (let i = 0; i < datos.length; i++) {
        $("#id").val(datos[i]["id"]);
        $("#id_rub option[value=" + datos[i]["id_rub"] + "]").attr(
          "selected",
          true
        );
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

function deletGroup(id) {
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
      deletGroupToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletGroupToId(id) {
  let type = "&id=" + id + "&action=deleteGroup";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el grupo", "success");
        readGroups();
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/************************ AREA DE SUBGRUPOS ********************************* */
/************************ FUNCIONES CRUD  ************************/
function createSubGroup() {
  let type = "&action=insertSubGroup";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readSubGroups();
        generateCodProduct();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function readSubGroups() {
  let url = "&action=listDataSubGroup";
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let group = "<td>" + datos[i]["grupo"] + "</td>";
        let cod = "<td>" + datos[i]["cod"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editSubGroup(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletSubGroup(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + cod + name + group + btn + "</tr>";
      }
      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editSubGroup(id) {
  mostrarModalGruposEdit();
  let url = "&id=" + id + "&action=listDataSubGroupToId";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      for (let i = 0; i < datos.length; i++) {
        $("#id").val(datos[i]["id"]);
        $("#id_grupo option[value=" + datos[i]["id_group"] + "]").attr(
          "selected",
          true
        );
        $("#codigo").val(datos[i]["cod"]);
        $("#nombre").val(datos[i]["name"]);
      }
      console.log(id);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editGroup(id) {
  mostrarModalGruposEdit();
  let url = "&id=" + id + "&action=listDataGroupToId";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      for (let i = 0; i < datos.length; i++) {
        $("#id").val(datos[i]["id"]);
        $("#id_rub option[value=" + datos[i]["id_rub"] + "]").attr(
          "selected",
          true
        );
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

function deletSubGroup(id) {
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
      deletSubGroupToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletSubGroupToId(id) {
  let type = "&id=" + id + "&action=deleteSubGroup";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el Sub-Grupo", "success");
        readSubGroups();
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/************************ AREA DE RUBROS ********************************* */
/************************ FUNCIONES CRUD  ************************/
function createMaxRub() {
  let type = "&action=insertRub";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readMaxRubs();
        generateCodProduct();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function readMaxRubs() {
  let url = "&action=listDataRub";
  $.ajax({
    url: "../../controller/controller_products.php",
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
          "<button class='dropdown-item' onclick='editMaxRub(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletMaxRub(" +
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

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editMaxRub(id) {
  mostrarModalGruposEdit();
  let url = "&id=" + id + "&action=listDataRubToId";
  $.ajax({
    url: "../../controller/controller_products.php",
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

function deletMaxRub(id) {
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
      deletMaxRubToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletMaxRubToId(id) {
  let type = "&id=" + id + "&action=deleteRub";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el grupo", "success");
        readMaxRubs();
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/************************ AREA DE LABORATORIOS ********************************* */
/************************ FUNCIONES CRUD  ************************/
function createLaboratories() {
  let type = "&action=insertLaboratories";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readLaboratories();
        generateCodProduct();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function readLaboratories() {
  let url = "&action=listDataLaboratories";
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let desc = "<td>" + datos[i]["description"] + "</td>";
        let cod = "<td>" + datos[i]["cod"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editLaboratories(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletLaboratories(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + cod + name + desc + btn + "</tr>";
      }
      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editLaboratories(id) {
  mostrarModalGruposEdit();
  let url = "&id=" + id + "&action=listDataLaboratoriesToId";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      for (let i = 0; i < datos.length; i++) {
        $("#id").val(datos[i]["id"]);
        $("#descripcion").val(datos[i]["description"]);
        $("#codigo").val(datos[i]["cod"]);
        $("#nombre").val(datos[i]["name"]);
      }
      console.log(id);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function deletLaboratories(id) {
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
      deletLaboratoriesToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletLaboratoriesToId(id) {
  let type = "&id=" + id + "&action=deleteLaboratories";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el Laboratorio", "success");
        readLaboratories();
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/************************ AREA DE LABORATORIOS ********************************* */
/************************ FUNCIONES CRUD  ************************/
function createLocations() {
  let type = "&action=insertLocations";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readLocations();
        generateCodProduct();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function readLocations() {
  let url = "&action=listDataLocations";
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let desc = "<td>" + datos[i]["description"] + "</td>";
        let cod = "<td>" + datos[i]["cod"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editLocations(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletLocations(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + cod + name + desc + btn + "</tr>";
      }
      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editLocations(id) {
  mostrarModalGruposEdit();
  let url = "&id=" + id + "&action=listDataLocationsToId";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      for (let i = 0; i < datos.length; i++) {
        $("#id").val(datos[i]["id"]);
        $("#descripcion").val(datos[i]["description"]);
        $("#codigo").val(datos[i]["cod"]);
        $("#nombre").val(datos[i]["name"]);
      }
      console.log(id);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function deletLocations(id) {
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
      deletLocationsToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletLocationsToId(id) {
  let type = "&id=" + id + "&action=deleteLocations";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el Laboratorio", "success");
        readLocations();
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

/************************ AREA DE LOTES ********************************* */
/************************ FUNCIONES CRUD  ************************/
function createLot() {
  let type = "&action=insertLots";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $("#registro_secondary").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        clearFormLots();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readLots();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function readLots() {
  let id_product = document.getElementById("id_product_lot").value;
  let url = "&action=listDataLots&id_product=" + id_product;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      var table = $("#datos_secondary").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let cant = "<td>" + datos[i]["cant"] + "</td>";
        let lote = "<td>" + datos[i]["lot"] + "</td>";
        let date = "<td>" + datos[i]["date_lote"] + "</td>";
        let date_expir = "<td>" + datos[i]["date_expiration"] + "</td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editLots(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletLots(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + lote + cant + date + date_expir + btn + "</tr>";
      }
      $("#data_secondary").append(filas);
      $("#datos_secondary").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function clearFormLots() {
  $("#num_lot").val("");
  $("#id_lot").val("");
  $("#cant_lot").val("");
  $("#fecha_lot").val("");
  $("#vence_lot").val("");
}

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editLots(id) {
  let url = "&id=" + id + "&action=listDataLotsToId";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let cant = datos[i]["cant"];
        let lote = datos[i]["lot"];
        let date = datos[i]["date_lote"];
        let date_expir = datos[i]["date_expiration"];
        $("#num_lot").val(lote);

        $("#cant_lot").val(cant);
        $("#fecha_lot").val(date);
        $("#vence_lot").val(date_expir);
        $("#id_lot").val(id);
      }
      console.log(id);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function deletLots(id) {
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
      deletLotsToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletLotsToId(id) {
  let type = "&id=" + id + "&action=deleteLots";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el Laboratorio", "success");
        readLots();
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function addLote(id) {
  $('#modal_view_1').modal({
    backdrop: 'static',
    keyboard: false
})
  document.getElementById("id_product_lot").value = id;
  readLots();
}

/************************ AREA DE LOTES ********************************* */
/************************ FUNCIONES CRUD  ************************/
function createPresentations() {
  let type = "&action=insertPresentations";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $("#registro_secondary_pres").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        clearFormPresentations();
        alert_top_mi("Se ha ingresado el los datos", "success");
        readPresentations();
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function readPresentationsToId(id_product) {
  let url = "&action=listDataPresentations&id_product=" + id_product;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      var table = $("#datos_secondary_pres").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let barcode = "<td>"+ datos[i]["barcode"] +"</td>"
        let cant = "<td>" + datos[i]["factor"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";
        let sale_price = "<td>" + datos[i]["sale_price"] + "</td>";
        let sale_price_suge = '';

        let precioSugerido = datos[i]["precio_presS"];

        if (precioSugerido == 'NULL' || precioSugerido == 'null' || precioSugerido ==  null ) {
          sale_price_suge = "<td>0.00</td>";  
        }else {
          sale_price_suge = "<td>" + datos[i]["precio_presS"] + "</td>";
        }
       
        
        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editPresentations(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletPresentations(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + barcode +  name + cant + sale_price_suge +  sale_price + btn + "</tr>";
      }
      $("#data_secondary_pres").append(filas);
      $("#datos_secondary_pres").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function readPresentations() {
  let id_product = document.getElementById("id_product_pres").value;
  let url = "&action=listDataPresentations&id_product=" + id_product;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      var table = $("#datos_secondary_pres").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let barcode = "<td>"+ datos[i]["barcode"] +"</td>"
        let cant = "<td>" + datos[i]["factor"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";
        let sale_price = "<td>" + datos[i]["sale_price"] + "</td>";
        let sale_price_suge = '';

        let precioSugerido = datos[i]["precio_presS"];

        if (precioSugerido == 'NULL' || precioSugerido == 'null' || precioSugerido ==  null ) {
          sale_price_suge = "<td>0.00</td>";  
        }else {
          sale_price_suge = "<td>" + datos[i]["precio_presS"] + "</td>";
        }
       
        
        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editPresentations(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletPresentations(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + barcode +  name + cant + sale_price_suge +  sale_price + btn + "</tr>";
      }
      $("#data_secondary_pres").append(filas);
      $("#datos_secondary_pres").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function readPresentations() {
  let id_product = document.getElementById("id_product_pres").value;
  let url = "&action=listDataPresentations&id_product=" + id_product;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {

      if (datos.length >=1) {
      $('#tabla_presentaciones').show();
      var table = $("#datos_secondary_pres").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let barcode = "<td>"+ datos[i]["barcode"] +"</td>"
        let cant = "<td>" + datos[i]["factor"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";
        let sale_price = "<td>" + datos[i]["sale_price"] + "</td>";
        let sale_price_suge = '';

        let precioSugerido = datos[i]["precio_presS"];

        if (precioSugerido == 'NULL' || precioSugerido == 'null' || precioSugerido ==  null ) {
          sale_price_suge = "<td>0.00</td>";  
        }else {
          sale_price_suge = "<td>" + datos[i]["precio_presS"] + "</td>";
        }
       
        
        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editPresentations(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='deletPresentations(" +
          id +
          ")'><i class='ni ni-fat-remove text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas += "<tr>" + barcode +  name + cant + sale_price_suge +  sale_price + btn + "</tr>";
      }
      $("#data_secondary_pres").append(filas);
      $("#datos_secondary_pres").DataTable({});

    }else{
      $('#tabla_presentaciones').hide();
    }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function clearFormPresentations() {
  $("#name_pres").val("");
  $("#id_pres").val("");
  $("#barcode_pres").val("");
  $("#precio_pres").val("");
  $("#factor_pres").val("");
  $("#precio_presS").val("");
}

/* Obtiene la data del modulo y es pintada en el modal para su edicion */
function editPresentations(id) {
  clearFormPresentations();
  let url = "&id=" + id + "&action=listDataPresentationsToId";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let name = datos[i]["name"];
        let barcode = datos[i]["barcode"];
        let factor = datos[i]["factor"];
        let sale_price = datos[i]["sale_price"];
        let precio_presS = datos[i]["precio_presS"];

        $("#name_pres").val(name);
        $("#id_pres").val(id);
        $("#barcode_pres").val(barcode)
        $("#precio_pres").val(sale_price);
        $("#factor_pres").val(factor);
        $("#precio_presS").val(precio_presS);
      }
      console.log(id);
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function deletPresentations(id) {
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
      deletPresentationsToId(id);
    } else {
      alert_top_mi("Se cancelo el proceso de eliminado", "warning");
    }
  });
}

function deletPresentationsToId(id) {
  let type = "&id=" + id + "&action=deletePresentations";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      console.log(r);
      if (r != "true" || r == "true") {
        console.log(r);
        alert_top_mi("Se ha eliminado el Laboratorio", "success");
        readPresentations();
      } else {
        alert_top_mi("Error al tratar eliminar los datos", "error");
        return false;
      }
    },
  });
  return false;
}

function addPresentacion(id) {
 /*  $("#modal_view_2").modal("show"); */
  $('#modal_view_2').modal({
    backdrop: 'static',
    keyboard: false
})
  document.getElementById("id_product_pres").value = id;
  readPresentations();
  clearFormPresentations();
}

/******************************************************************************************** */

/************************ FUNCIONES VARIAS  ************************/
/* Detecta eventos del teclado asi como las diferentes combinaciones del mismo */
$(document).keydown(function (e) {
  e = e || event;
  if (e.altKey & (String.fromCharCode(e.keyCode) == "N")) {
    mostrarModalGrupos();
  } else if (e.altKey & (String.fromCharCode(e.keyCode) == "R")) {
    readGroups();
  } else if (e.ctrlKey & (String.fromCharCode(e.keyCode) == "X")) {
    habilitarCampo();
  }else if (e.ctrlKey & e.shiftKey) {
    contarFilas();
  }else if(e.altKey & (String.fromCharCode(e.keyCode) == "V")){
    mostrarVentas();
  }
});

/* -----> Generalidades
  altKey: para la tecla alt.
  shiftKey: para la tecla shift (mayúsculas)
  ctrlKey: para la tecla Ctrl
  */

/* Limpia el buscador local, en la parte superior de la ventana */
function cancel_search() {
  console.log("hola");
}

/* Ejecuta el buscador local, en la parte superior de la ventana */
function search() {
  alert_top_mi("Buscando...", "info");
}

/* Lanza el modal para llenar los datos del grupo */
function mostrarModalGrupos() {
  $("#registro")[0].reset();
  mostrarModal();
  document.getElementById("codigo").readOnly = true;

  let campo = document.getElementById("table_name").value;

  if (campo == "produts") {
    list_rubs();
    list_status();
    list_vendors();
    list_laboratories();
    list_Presentations();
    generateCodProduct();
  } else {
    list_rubs();
    list_status();
    list_vendors();
    list_laboratories();
    list_locations();
    list_sub_locations();
    generateCodProduct();
    list_groups();
  }
}

function mostrarModalGruposEdit() {
  $("#registro")[0].reset();
  mostrarModal();
  document.getElementById("codigo").readOnly = true;

  let campo = document.getElementById("table_name").value;

  if (campo == "produts") {
    list_rubs();
    list_status();
    list_vendors();
    list_laboratories();
    list_Presentations();
  } else {
    list_rubs();
    list_status();
    list_vendors();
    list_laboratories();
    list_locations();
    list_sub_locations();
    list_groups();
  }
}

function habilitarCampoEditar() {
  document.getElementById("codigo").readOnly = false;
}

function habilitarCampo() {
  Swal.fire({
    title: "Estas seguros de esto?",
    text: "Solicitas editar el codigo interno, recuerda que debe de ser unico!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#222324",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Habilitar!",
  }).then((result) => {
    if (result.value) {
      habilitarCampoEditar();
    } else {
      alert_top_mi("Se cancelo el proceso", "warning");
    }
  });

  return false;
}

/* Cancela el evento enter de los campos para impedir enviar data mediante el enter default */
function valid_enter(e) {
  if (e.keyCode == 13) {
    return false;
  } else {
    return true;
  }
}


function valid_enter_final(e) {
  if (e.keyCode == 13) {
    $('#btnGrabarFinal').click();
    return false;

  } else {
    return true;
  }
  
}

/**Llena el combo de grupos en el modal de productos */
function list_groups() {
  if ($("#id_grupo").length) {
    let url = "&action=list_groups";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_grupo").innerHTML = "";
        var select = document.getElementById("id_grupo"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
        list_subgroupToGroup();
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

/**Llena el combo de grupos en el modal de productos */

function list_groupsToRub() {
  if ($("#id_grupo").length) {
    let id = document.getElementById("id_rub").value;
    let url = "&action=list_groupsToRub&id=" + id;
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_grupo").innerHTML = "";
        var select = document.getElementById("id_grupo"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
        list_subgroupToGroup();
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

/**Llena el combo de grupos en el modal de productos */
function list_subgroupToGroup() {
  if ($("#id_subgrupo").length) {
    let id_grupo = document.getElementById("id_grupo").value;
    let url = "&action=list_subgroupToGroup&id=" + id_grupo;
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_subgrupo").innerHTML = "";
        var select = document.getElementById("id_subgrupo"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

function list_rubs() {
  if ($("#id_rub").length) {
    let url = "&action=list_rubs";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_rub").innerHTML = "";
        var select = document.getElementById("id_rub"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
        list_groupsToRub();
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

function list_vendors() {
  if ($("#id_rub").length) {
    let url = "&action=list_vendors";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_proveedor").innerHTML = "";
        var select = document.getElementById("id_proveedor"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["tradename"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

/**Llena el combo de grupos en el modal de productos */
function list_status() {
  if ($("#state").length) {
    let url = "&action=list_status";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("state").innerHTML = "";
        var select = document.getElementById("state"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

/**Llena el combo de grupos en el modal de productos */
function list_laboratories() {
  if ($("#id_lab").length) {
    let url = "&action=list_laboratories";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_lab").innerHTML = "";
        var select = document.getElementById("id_lab"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

/**Llena el combo de grupos en el modal de productos */
function list_locations() {
  if ($("#id_ubicacion").length) {
    let url = "&action=list_locations";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_ubicacion").innerHTML = "";
        var select = document.getElementById("id_ubicacion"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}


/**Llena el combo de grupos en el modal de productos */
function list_sub_locations() {
  if ($("#id_ubicacion_2").length) {
    let url = "&action=list_sub_locations";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_ubicacion_2").innerHTML = "";
        var select = document.getElementById("id_ubicacion_2"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

/**Llena el combo de grupos en el modal de productos */
function list_moneybox() {
  if ($("#id_caja").length) {
    let url = "&action=list_moneybox";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_caja").innerHTML = "";
        var select = document.getElementById("id_caja"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

/**Llena el combo de grupos en el modal de productos */
function list_tipeof_pay() {
  if ($("#id_tpago").length) {
    let url = "&action=list_tipeof_pay";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_tpago").innerHTML = "";
        var select = document.getElementById("id_tpago"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(
            datos[i]["cod"] + "| " + datos[i]["name"],
            datos[i]["id"]
          );
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

/**Llena el combo de grupos en el modal de productos */
function list_documents(type) {
  if ($("#id_documento").length) {
    let url = "&action=list_documents&type=" + type;
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_documento").innerHTML = "";
        var select = document.getElementById("id_documento"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(
             datos[i]["name"],
            datos[i]["id"]
          );
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });

      obtenerDataDocument();
  } else {
    // no existe
  }


}

function mostrarVentas() {
  $("#totalizar_ventas").modal('show');
 mostrarVentasNormales();
 mostrarVentasBajo();
}



function mostrarVentasNormales() {
  let url = "&action=mostrarVentasNormales";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      document.getElementById('txt_normal').value = datos[0]["total"];
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function mostrarVentasBajo() {
  let url = "&action=mostrarVentasBajo";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos)
      document.getElementById('txt_bajo').value = datos[0]["total"];
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


/**Llena el combo de grupos en el modal de productos */
function list_clients() {
  if ($("#id_cliente").length) {
    let url = "&action=list_clients";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_cliente").innerHTML = "";
        var select = document.getElementById("id_cliente"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}




function list_proveedores() {
  if ($("#id_proveedor").length) {
    let url = "&action=list_proveedores";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_proveedor").innerHTML = "";
        var select = document.getElementById("id_proveedor"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }

 

}



function obtenerDataDocument_error() {
  if ($("#id_documento").length) {
    let doc = document.getElementById("id_documento").value;
    let url = "&action=obtenerDataDocument_error&id=" + doc;
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        console.log(datos);
        let num_document = datos[0]["correlativo"];
        let ser_document = datos[0]["rango"];
        let impuesto = datos[0]['impuesto'];

        if (num_document == "null" || data == null) {
          document.getElementById("numero").value = "0000001";
        } else {

          /* Eliminamos todo tipo de texto que venga con el */
          let code = num_document.replace(/\D/g, "");
          /* Pasamos el dato a entero para poder sumarle uno */
          let number = parseInt(code, 10);
          /* Una vez lo tenemos en entero y ya sumado, lo convertimos a texto */
          number = number.toString();
          /* Funcion padStart agrega caracteres a un string */
          if (doc == '1') {
            number = number.padStart(5, 0);
            document.getElementById("numero").value = number;
          }else if (doc == '2') {
            number = number.padStart(8, 0);
            document.getElementById("numero").value = number;
          }
          

          
        }

        document.getElementById("impuesto").value = impuesto;

        alert_top_mi("Se actualizado el numero de documento, intentelo nuevamente", "success")
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}






function obtenerDataDocument() {
  if ($("#id_documento").length) {
    let doc = document.getElementById("id_documento").value;
    let url = "&action=obtenerDataDocument&id=" + doc;
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        console.log(datos);
        let num_document = datos[0]["correlativo"];
        let ser_document = datos[0]["rango"];
        let impuesto = datos[0]['impuesto'];

        if (num_document == "null" || data == null) {
          document.getElementById("numero").value = "0000001";
        } else {

          /* Eliminamos todo tipo de texto que venga con el */
          let code = num_document.replace(/\D/g, "");
          /* Pasamos el dato a entero para poder sumarle uno */
          let number = parseInt(code, 10);
          /* Una vez lo tenemos en entero y ya sumado, lo convertimos a texto */
          number = number.toString();
          /* Funcion padStart agrega caracteres a un string */
          if (doc == 1) {
            number = number.padStart(5, 0);
          }else if (doc == 2) {
            number = number.padStart(8, 0);
          }else if (doc == 3 ){
            number = number.padStart(3, 0);
          }else if (doc == 4) {
            number = number.padStart(7, '0');
          }else if (doc == 4) {
            number = number.padStart(4, '0');
          }else if (doc == 6){
            number = number.padStart(9, 0);
          }else if (doc == 7) {
            number = number.padStart(10, '0');
          }else if (doc == 8){
            number = number.padStart(7, 0);
          }
          

          document.getElementById("numero").value = number;
        }

        document.getElementById("impuesto").value = impuesto;

        if (ser_document == "null" || data == null) {
          document.getElementById("serie").value = "0000001";
        } else {
          /* Eliminamos todo tipo de texto que venga con el */
          let code = ser_document.replace(/\D/g, "");
          /* Pasamos el dato a entero para poder sumarle uno */
          let number = parseInt(code, 10);
          /* Una vez lo tenemos en entero y ya sumado, lo convertimos a texto */
          number = number.toString();
          /* Funcion padStart agrega caracteres a un string */
          number = number.padStart(8, 0);

          document.getElementById("serie").value = number;
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

function fechaActual() {
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth() + 1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
  if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
  document.getElementById("fecha_trans").value = ano + "-" + mes + "-" + dia;
}

/* AREA DE VENTAS  */

function salirPantalla() {
  Swal.fire({
    title: "Estas seguros de esto?",
    text:
      "Una vez fuera de la pantalla perderas todo los datos que tengas hasta el momento!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Salir!",
  }).then((result) => {
    if (result.value) {
      window.location.href = "home.php";
    } else {
      alert_top_mi("Se cancelo el proceso de salida", "warning");
    }
  });
}

function cancelarTransaccion() {
  Swal.fire({
    title: "Estas seguros de esto?",
    text:
      "Una vez fuera echo esto perderas todo los datos que tengas hasta el momento!",
    icon: "error",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Cancelar!",
  }).then((result) => {
    if (result.value) {
      location.reload();
    } else {
      alert_top_mi("No se cancelo el proceso", "warning");
    }
  });
}

function nuevaTransaccion() {
  location.reload();
}

function initInvoice() {
  /* datos */
  list_cashier();

  list_moneybox();
  list_tipeof_pay();
  list_documents("POS-VTA");
  list_clients();
  list_moneybox();
  fechaActual();
  
  list_cashiers();
  clearCamposBusqueda();

  setTimeout(function () {
    crearTable();

  }, 300);

 
}


function initQuotes() {
  /* datos */
  list_cashier();
  list_tipeof_pay();
  list_documents("POS-CPRA");
  list_proveedores();
  fechaActualCompra();
 
  list_cashiers();
  clearCamposBusqueda();

  setTimeout(function () {
    crearTable();
    obtenerDataDocument()
  }, 300);





 
}

function addShopping(id, cod, name, presentation,factor, price, priceSug) {

  cerrarModales();
  let row = "";
  price = parseFloat(price);
  priceSug = parseFloat(priceSug);
  let totalDes = priceSug - price;
  let id_row = generateAutoincrement();

  if (cod == "1920" && id == "1920") {
    abrirModalEditable(id, cod, factor)
  }else{

  let rowId = "<td class='d-none'><input name='idProduct[]' id='idProduct' type='text' class='d-none' value='" + id + "'></td>"
  let rowCod ="<td ><input name='codProduct[]' id='codProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)' readonly   class='d-none' value='" +
    cod +
    "'><label>" +
    cod +
    "</label></td>";
  let rowName =
    "<td ><input name='nameProduct[]' id='nameProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)' readonly   class='d-none' value='" +
    name +
    "'><label>" +
    name +
    "</label></td>";
  let rowCant =
    "<td ><input name='cantProduct[]' id='cantProduct" +
    id_row +
    "' type='number' onchange='sumRow(" +
    id_row +
    ")'  onkeypress='return valid_enter(event)' onblur='restablecer_campo(" +
    id_row +
    ")'  onfocus='clearTar(" +
    id_row +
    ")'  class='form-control form-control-sm' value='" +
    1 +
    "'></td>";

    let rowFactor =
    "<td class='d-none'><input name='factorProduct[]' id='factorProduct" +
    id_row + "' type='text''  class='form-control form-control-sm' value='" + factor + "'></td>";

  let rowPres =
    "<td ><input name='presentationProduct[]' id='presentationProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none' value='" +
    presentation +
    "'><label>&nbsp;&nbsp;&nbsp;" +
    presentation +
    "</label></td>";
  let rowPric =
    "<td ><input name='priceProduct[]' id='priceProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none' value='" +
    price +
    "'><label>&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;$ " +
    price +
    "</label></td>";

  let rowPricSug =
    "<td><input name='priceSugProduct[]' id='priceSugProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none' value='" +
    priceSug +
    "'><label>&nbsp;&nbsp;&nbsp $ " +
    priceSug +
    "</label></td>";

  let rowTotalDes =
    "<td class='d-none'><input name='totalDescProduct[]' id='totalDescProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='form-control form-control-sm ttd_documento' value='" +
    totalDes +
    "'></td>";
  let rowTotal =
    "<td ><input name='totalPriceProduct[]' id='totalPriceProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none tt_documento' value='" +
    price +
    "'><label id='totalPriceProduct_tt" +
    id_row +
    "'>&nbsp;&nbsp;&nbsp $ " +
    price +
    "</label></td>";
  let btnDele =
    "<td >&nbsp;&nbsp;&nbsp<button type='button' class='btn btn-outline-danger btn-sm' onclick='deletRow(this)'><i class='fas fa-trash-alt text-outline-danger'></i><span class='nav-link-text'></span></button><td>";

  row +=
    "<tr class='table-sm' id='" +
    id_row +
    "'>" +
    rowId +
    rowCod +
    rowName +
    rowCant +
    rowPres +
    rowPricSug +
    rowPric +
    rowFactor +
    rowTotal +
    rowTotalDes +
    btnDele +
    "</tr>";
  $("#data").prepend(row);
  sumDocument();
  sumDocumentDesc();
  clearCamposBusqueda();
  alert_top_mi('Se ha agregado ' + name , 'success')
  }

  obtenerDataDocument();
}

function deletRow(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("datos").deleteRow(i);
  console.log(i);
  sumDocument();
  sumDocumentDesc();
  validar_monto()
}

function generateAutoincrement() {
  let idAutoincrement = document.getElementById("corr_id").value;
  idAutoincrement = parseInt(idAutoincrement) + 1;
  document.getElementById("corr_id").value = idAutoincrement;
  return idAutoincrement;
}

function restablecer_campo(id) {
  let campo = document.getElementById("cantProduct" + id).value;
  if (campo == "") {
    document.getElementById("cantProduct" + id).value = "1";
  } else {
  }
  sumDocument();
  sumDocumentDesc();
}

/* Limpiamos el campo de cantidad */
function clearTar(id) {
  var campo = document.getElementById("cantProduct" + id).value;

  if (campo == 1) {
    document.getElementById("cantProduct" + id).value = "";
  } else {
  }
}

/* Suma de la fila en el detalle de la orden */
function sumRow(row) {
  var price = parseFloat(document.getElementById("priceProduct" + row).value);
  var priceSug = parseFloat(
    document.getElementById("priceSugProduct" + row).value
  );
  var cant = parseFloat(document.getElementById("cantProduct" + row).value);

  if (cant >= 0) {
  } else {
    cant = 1;
  }

  let total_cantidad = price * cant;
  total = parseFloat(total_cantidad).toFixed(2);

  let total_price_sug = priceSug * cant;
  let total_desc = parseFloat(total_price_sug - total).toFixed(2);
  let camp = (document.getElementById("totalPriceProduct" + row).value = total);

  $("#totalPriceProduct_tt" + row).html(total);
  let descuen = (document.getElementById(
    "totalDescProduct" + row
  ).value = total_desc);

  sumDocument();
  sumDocumentDesc();
}

function sumDocumentDesc() {
  let type = document.getElementById("isAs").value;
  if (type == 'COMPRA') {

  }else{
    let desc = 0;
    $(".ttd_documento").each(function () {
      if (isNaN(parseFloat($(this).val()))) {
        desc += 0;
      } else {
        desc += parseFloat($(this).val());
      }
    });
    document.getElementById("tdocumentDescFinish").innerHTML = desc.toFixed(2);
    document.getElementById("tdocumentDescFinishINPUT").value = desc.toFixed(2);
  }
  
}

function sumDocument() {
  let total = 0;
  $(".tt_documento").each(function () {
    if (isNaN(parseFloat($(this).val()))) {
      total += 0;
    } else {
      total += parseFloat($(this).val());
    }
  });
  document.getElementById("tdocumentFinish").innerHTML = total.toFixed(2);
  document.getElementById("tdocumentFinishINPUT").value = total.toFixed(2);

  let type = document.getElementById("isAs").value;
  if (type == 'COMPRA') {
     validar_monto()
  }else{

  } 
}

function crearTable() {
  $(document).ready(function () {
    $("#datos").DataTable({
      scrollY: "450px",
      scrollCollapse: true,
      paging: false,
      searching: false,
      bInfo: false,
      lengthChange: false,
      oLanguage: {
        sEmptyTable: "____",
      },
    });
    $(".dataTables_length").addClass("bs-select");
  });
  clearCamposBusqueda();
  validar_dia_cierre();
}

function valid_enter_busqueda(e) {
  if (e.keyCode == 13) {
    let data = document.getElementById("")
    bar_code_search();
    return false;
  } else {
    return true;
  }
}



function valid_enter_busqueda_text(e) {
  if (e.keyCode == 13) {
    name_search();
    document.getElementById("name_search").value = "";
    return false;
  } else {
    return true;
  }
}

$(document).ready(function () {
  $(".select-activo").select2();
});

/**Llena el combo de grupos en el modal de productos */
function bar_code_search() {
  let bar_code = document.getElementById("codigo_barra").value;
  let url = "&action=listDataToBarCode&bar_code=" + bar_code;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos);
      if (datos.length >= 1) {
        let id = datos[0]["id"];
        let cod = datos[0]["cod"];
        let name = datos[0]["name"];
        let presentation = datos[0]["presentation"];
        let price = datos[0]["sale_price_1"];

        let priceSug = datos[0]["sale_price"];
        if (priceSug == '0' || priceSug == '0.0' || priceSug == '0.00' || priceSug == null || priceSug == 'null' || priceSug == 'NULL' ) {
          priceSug = price;
        }else{

        }

       

        if (presentation == "null" || presentation == null) {
          presentation = "UNI";
        } else {
        }
        validate_presentation_search(
          id,
          cod,
          name,
          presentation,
          price,
          priceSug
        );
        clearCamposBusqueda();
      } else {
        bar_code_search_press(bar_code);
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function bar_code_search_press(bar_code) {

  let url = "&action=listDataToBarCodePres&bar_code=" + bar_code;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos);
      if (datos.length >= 1) {
        let id_product = datos[0]["id_product"];
        let presentation = datos[0]["name"];
        let factor = datos[0]["factor"];
        let price = datos[0]["sale_price"];
        let price_sug = datos[0]["precio_presS"];

        if (precio_presS == '' || precio_presS == 'null' || precio_presS == '0' || precio_presS == '0.00') {
          price_sug_v = price;
        }else{
          price_sug_v = price_sug;
        }
        searchProductPres(id_product, presentation, factor, price, price_sug_v);
        
      } else {
        alert_top_mi("Error, No se encontro el producto", "error");
        clearCamposBusqueda();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}




function searchProductPres(id_product, presentation, factor, price, price_sug) {
  let url = "&action=searchProductName&id=" + id_product;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos);
      if (datos.length >= 1) {
        let id = datos[0]["id"];
        let cod = datos[0]["cod"];
        let name = datos[0]["name"];
    
      
      addShopping(id, cod, name, presentation,factor, price, price_sug, factor); 
      } else {
        alert_top_mi("Error, No se encontro el producto", "error");
        clearCamposBusqueda();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
  
}

function name_search() {
  let name = document.getElementById("name_search").value;
  if (name.length == 0) {
  } else {
    let url = "&action=listDataToName&name=" + name;
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        let total = datos.length;
        if (total == 0) {
          alert_top_mi("No se encontraron coincidencias", "warning");
        } else if (total == 1) {
          let id = datos[0]["id"];
          let cod = datos[0]["cod"];
          let name = datos[0]["name"];
          let presentation = datos[0]["presentation"];
          let price = datos[0]["sale_price_1"];
          let priceSug = datos[0]["sale_price"];

          if (presentation == "null" || presentation == null) {
            presentation = "UNI";
          } else {
          }
          validate_presentation_search(
            id,
            cod,
            name,
            presentation,
            price,
            priceSug
          );
          clearCamposBusqueda();
        } else {
          $('#modal_busqueda_productos').modal({
            backdrop: 'static',
            keyboard: false
        })
          

          let filas = "";
          for (let i = 0; i < datos.length; i++) {
            let id = datos[i]["id"];
            let cod = "<td>" + datos[i]["cod"] + "</td>";
            let name = "<td>" + datos[i]["name"] + "</td>";
            let description = "<td>" + datos[i]["description"] + "</td>";
            let presentation = "<td>" + datos[i]["presentation"] + "</td>";
            let sale_price = "<td> $ " + datos[i]["sale_price_1"] + "</td>";
            let priceSug = "<td> $ " + datos[i]["sale_price"] + "</td>";
            let laboratorie = "<td> " + datos[i]["laboratorie"] + "</td>";

            let id_shop = datos[i]["id"];
            let cod_shop = datos[i]["cod"];
            let name_shop = datos[i]["name"];
            let presentation_shop = datos[i]["presentation"];
            

            if (presentation_shop == "null" || presentation_shop == null) {
              presentation_shop = "UNI";
            } else {
            }
            let sale_price_shop = datos[i]["sale_price_1"];
            let sale_price_sug_shop = datos[i]["sale_price"];


 let existencias = datos[i]["current_existence"];
        let rowExisten = "";

        if (existencias === "" ||existencias === ' ' ||existencias === "null" || existencias === null || existencias === undefined || existencias <= 0) {
          rowExisten = "<td> 0 </td>";
        }else{
          rowExisten = "<td>"+ existencias +"</td>";
        }





            let btn =
              "<td><button type='button' class='btn btn-outline-dark'  onclick='generarBusqueda(" + '"' + cod_shop +'"'+  ");'>Agregar</button></td>";

            filas +=
              "<tr>" +
              cod +
              name +
              laboratorie +
              priceSug +
              sale_price +
              rowExisten +
              btn +
              "</tr>";
          }

          var table = $("#datos_terceary_results").DataTable().clear().draw();
          table.destroy();
          $("#data_terceary_results").append(filas);
          $("#datos_terceary_results").DataTable({});
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  }
}

function validate_presentation_search(
  id,
  cod,
  name,
  presentation,
  price,
  priceSug
) {
 
  $("#modal_busqueda_productos").modal("hide");
  let url = "&action=listDataToPresentation&id=" + id;

  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      let deti = 1;
      let total = parseInt(datos[0]["total"]);
      if (total >= 1) {
        listDataProductsPresentations(
          id,
          cod,
          name,
          presentation,
          price,
          priceSug
        );
      } else {
        addShopping(id, cod, name, presentation,deti, price, priceSug);
        cerrarModales();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function listDataProductsPresentations(
  id,
  codigo,
  name,
  press,
  price,
  priceSug
) {
 
  $('#modal_presentaciones').modal({
    backdrop: 'static',
    keyboard: false
})
  
  let url = "&action=listDataProductsPresentations&id=" + id;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      var table = $("#datos_terceary").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let precio = datos[i]["sale_price"];
        let precio_presS = datos[i]["precio_presS"];
        let presentation = datos[i]["presentation"];

        if (precio_presS == '0' || precio_presS == '0.0'  || precio_presS == '0.00' || precio_presS == null || precio_presS == 'null' || precio_presS == 'NULL' ) {
          precio_presS = precio;

          if (presentation == 'CAJA' || presentation == 'Caja' || presentation == 'caja' ) {
            precio_presS = priceSug;
          }else{

          }
        }else{

        }

        let ident = "<td>" + id + "</td>";
        let resName = "";
        let code = "<td><label>" + codigo + "</label></td>";
        let name_prod =
          "<td>" + name + " *** <strong>" + datos[i]["presentation"] + "</strong></td>";

        if (presentation == 'CAJA' || presentation == 'Caja' || presentation == 'caja' ) {
           resName = name;
        }else{
          let acortarNombre = name.split("|");
          resName = acortarNombre[0];
        }
       


        let sale_price = "<td> $ " + precio + "</td>";
        let sale_price_sug = "<td> $ " + precio_presS + "</td>";
        let factor = "<td> " + datos[i]["factor"] + "</td>";
        let factor_venta = datos[i]["factor"];



        if (i == 0) {
          var btn =
            "<td><button type='button' class='btn btn-outline-dark' onclick='addShopping(" +
            '"' +
            id +
            '",' +
            '"' +
            codigo +
            '",' +
            '"' +
            resName +
            '",' +
            '"' +
            presentation +
            '",' +
            '"' +
            factor_venta +
            '",' +
            '"' +
            precio +
            '",' +
            '"' +
            precio_presS +
            '"' +
            ");'>Agregar</button>";
        } else {
          var btn =
            "<td><button type='button' class='btn btn-outline-dark' onclick='addShopping(" +
            '"' +
            id +
            '",' +
            '"' +
            codigo +
            '",' +
            '"' +
            resName +
            '",' +
            '"' +
            presentation +
            '",' +
            '"' +
            factor_venta +
            '",' +
            '"' +
            precio +
            '",' +
            '"' +
            precio_presS+
            '"' +
            ");'>Agregar</button>";
        }

        filas +=
          "<tr>" + code + name_prod + factor +  sale_price_sug + sale_price + btn + "</tr>";
      }

      $("#data_terceary").append(filas);
      $("#datos_terceary").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function clearCamposBusqueda() {
  document.getElementById("codigo_barra").value = "";
  document.getElementById("codigo_barra").focus();
}



function list_cashiers() {
  if ($("#id_caja").length) {
    let url = "&action=list_cashiers";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_caja").innerHTML = "";
        var select = document.getElementById("id_caja"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

function list_cashier() {
  if ($("#id_vendedor").length) {
    let url = "&action=list_cashier";
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("id_vendedor").innerHTML = "";
        var select = document.getElementById("id_vendedor"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  } else {
    // no existe
  }
}

function contarFilas() {
  var nFilas = $(".tabla_invoice tr").length;
  var nColumnas = $(".tabla_invoice tr:last td").length;

  if (nFilas >= 4) {
    finishTransacction();
  } else {
    alert_top_mi("Debe de agregar items al detalle de la venta", "error");
  }
}

function finishTransacction() {
  $("#finish_invoice").modal('show');
  let total_pagar = document.getElementById("tdocumentFinishINPUT").value;

 document.getElementById("txt_total").value =  total_pagar;
 document.getElementById("txt_paga").value =  "";
 document.getElementById("txtCambio").value =  "";
 document.getElementById("txt_descuentoReceta").value = "";
 $("#descReceta").prop('checked', false); 

}


function finishTransacctionSale(valor){
  insertInvoiceHead(valor);
}

function cerrarModales() {
  if ($("#modal_busqueda_productos").hasClass("in")) {
    $("#modal_busqueda_productos").modal("hide");
  }else if ($("#modal_presentaciones").hasClass("in")) {
    $("#modal_presentaciones").modal("hide");
  }else {

  }

  
}


function total_entrega(val) {
  let total_pagar = parseFloat(document.getElementById("txt_total").value).toFixed(2);
  let cambio = val - total_pagar;
  document.getElementById("txtCambio").value = parseFloat(cambio).toFixed(2);
  $("#txt_paga").focus();
}


function aplicateDesc() {
  let total_pagar = parseFloat(document.getElementById("tdocumentFinishINPUT").value).toFixed(2);
  var checkbox = document.getElementById('descReceta');

  checkbox.addEventListener( 'change', function() {
      if(this.checked) {
        let desc  = total_pagar * 0.05;
        total_pagar = total_pagar - desc;
        document.getElementById("txt_total").value = parseFloat(total_pagar).toFixed(2);
        document.getElementById("txt_descuentoReceta").value = parseFloat(desc).toFixed(2);

      }else{
        let desc  = total_pagar * 0.05;
        total_pagar = total_pagar + desc;
        document.getElementById("txt_total").value = parseFloat(total_pagar).toFixed(2);
        document.getElementById("txt_descuentoReceta").value = "0";
      }
  });
  
}



function aplicateDescCompra() {
  let total_pagar = parseFloat(document.getElementById("tdocumentFinishINPUT").value).toFixed(2);
  var checkbox = document.getElementById('descCompra');

  checkbox.addEventListener( 'change', function() {
      if(this.checked) {
        let desc  = total_pagar * 0.03;
        total_pagar = total_pagar - desc;
        document.getElementById("txt_total").value = parseFloat(total_pagar).toFixed(2);
        document.getElementById("txt_descuentoCompra").value = parseFloat(desc).toFixed(2);

      }else{
        let desc  = total_pagar * 0.03;
        total_pagar = total_pagar + desc;
        document.getElementById("txt_total").value = parseFloat(total_pagar).toFixed(2);
        document.getElementById("txt_descuentoCompra").value = "0";
      }
  });
  
}


function insertCant(cant) {
  document.getElementById('txt_paga').value = cant;
  total_entrega(cant);
}

function deletCant() {
 
    document.getElementById('txt_paga').value = '';
    document.getElementById('txtCambio').value = '';

    document.getElementById('txt_paga').focus();
    

}

function insertInvoiceHead(tipo) {
  list_moneybox();
  let number_transacction = document.getElementById("numero").value;
  let id_document = document.getElementById("id_documento").value;
  let date = document.getElementById("fecha_trans").value;
  let id_client = document.getElementById("id_cliente").value;
  let id_seller = document.getElementById("id_vendedor").value;
  let id_casher = document.getElementById("id_caja").value;
  let id_tyofpay = document.getElementById("id_tpago").value;
  let state = document.getElementById("state_trans").value;
  let total_document = document.getElementById("tdocumentFinishINPUT").value;
  let total_documentDesc = document.getElementById("tdocumentDescFinishINPUT").value;
  let mount =  document.getElementById("txt_paga").value;
  let cash =  document.getElementById("txtCambio").value;
  let desc_receta = document.getElementById("txt_descuentoReceta").value;
  let desc_compras = document.getElementById("txt_descuentoCompra").value;
  let detalle = "#invoice_data";

   let data = "&action=insertInvoiceHead&number_transacction=" + number_transacction + "&id_document=" + id_document + "&date=" + date +"&id_client=" + id_client + "&id_seller=" + id_seller + "&id_casher=" + id_casher + "&id_tyofpay=" + id_tyofpay + "&state=" + state +"&total_document=" + total_document + "&total_documentDesc=" + total_documentDesc + "&mount=" + mount + "&cash=" + cash + "&desc_receta=" + desc_receta + "&desc_compras=" + desc_compras; 

    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      data:$(detalle).serialize() + data  ,
      dataType: "json",
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (respuesta) {
        if (!respuesta.error) {
          alert_top_mi("Se ha registra la transaccion con el numero " + respuesta.id, "success");

          if(tipo == "GRABAR"){
            window.setTimeout(location.reload(), 150);
          }else if(tipo == "GRABAR-OPEN"){
            abrirCaja()
          }else if(tipo == "IMPRESION"){
            alert_top_mi("Imprimiendo documento.... ","success");
            imprimirTicket(respuesta.id)
           
          }else if(tipo == "IMPRESION-OPEN"){
            alert_top_mi("Imprimiendo documento.... ","success");
            imprimirTicketOpen(respuesta.id)
           
          }
          
         } else {
           alert_top_mi(respuesta.msg, "error");
           obtenerDataDocument_error();
           return false;
         }
      })
      .fail(function (resp) {
       
      });
}


function abrirCaja() {
  let url = "&action=TicketVenta";
  $.ajax({
   type: "POST",
   url: "../out/tickets/abrir.php",
   data: url,
   dataType: "json",
   success: function(respuesta) {
     alert_top_mi("Finalizando Transaccion","success");
     window.setTimeout(location.reload(), 150);
    
   },
   error: function() {
     /* alert_top_mi("¡Error! No se logo imprimir el Ticket","error"); */
     alert_top_mi("Finalizando Transaccion","success");
     window.setTimeout(location.reload(), 500);
    
   }
 });
 
}

function imprimirTicketOpen(id_orden) {
  let url = "&action=TicketVenta&id_invoice=" + id_orden;
  $.ajax({
   type: "POST",
   url: "../out/tickets/ticket_open.php",
   data: url,
   dataType: "json",
   success: function(respuesta) {
     alert_top_mi("Finalizando Transaccion","success");
     window.setTimeout(location.reload(), 150);
    
   },
   error: function() {
     /* alert_top_mi("¡Error! No se logo imprimir el Ticket","error"); */
     alert_top_mi("Finalizando Transaccion","success");
     window.setTimeout(location.reload(), 150);
    
   }
 });
 
}




/* FUNCIONES DE REPORTES */
function imprimirReporteInventarios_v1() {
  window.open(
    "../out/report_products_det.php",
    "Reporte de Rubros de Productos",
    "width=600, height=600"
  );
}

function imprimirReporteInventarios_v2() {
  window.open(
    "../out/report_products_detv2.php",
    "Reporte de Rubros de Productos",
    "width=600, height=600"
  );
}

function imprimirReporteInventarios_v3() {
  window.open(
    "../out/report_products_detv3.php",
    "Reporte de Rubros de Productos",
    "width=600, height=600"
  );
}

function imprimirReporteInventarios_v4_Ubica() {
  window.open(
    "../out/report_products_det_ubica.php",
    "Reporte de Rubros de Productos",
    "width=600, height=600"
  );
}

function imprimirReporteInventarios_v5_Ubica() {
  window.open(
    "../out/report_products_det_ubica_existences.php",
    "Reporte de Rubros de Productos",
    "width=600, height=600"
  );
}


function imprimirReporteDNM() {
  window.open(
    "../out/report_products_dnm.php",
    "Reporte de Rubros de Productos",
    "width=600, height=600"
  );
}


function imprimirReporteDNMFASF() {
  window.open(
    "../out/report_fasf_dnm.php",
    "Reporte de Rubros de Productos",
    "width=600, height=600"
  );
}

function imprimirReporteExistencias(){
  window.open(
    "../out/report_products_existences.php",
    "Reporte de Existencias de Productos", 
    "width=600, height=600"
  );
}

function report_products_existences_lot(){
  window.open(
    "../out/report_products_existences_lot.php",
    "Reporte de Existencias de Productos + Lotes", 
    "width=600, height=600"
  );
}

function report_cortesZETAS(){
  window.open(
    "../out/corteZTS.php",
    "Reporte de Corte Z ", 
    "width=600, height=600"
  );
}







function back() {
  window.location.href = "../pages/";
}

function valid_enter_search(e) {
  if (e.keyCode == 13) {
    search_data();
    return false;

  } else {
    return true;
  }
}


function valid_enter_searchN(e) {
  if (e.keyCode == 13) {
    search_dataNormal();
    return false;

  } else {
    return true;
  }
}







function search_dataNormal() {
  let item_search = document.getElementById("search_database").value;
  if (item_search.length >= 1) {
    readProductsItem(item_search);
  }else {
    alert_top_mi("Debe de rellenar el campo para realizar la busqueda", "error")
  }
}


function search_data() {
  let item_search = document.getElementById("search_database").value;
  if (item_search.length >= 1) {
    readProductsDetInfo(item_search);
  }else {
    alert_top_mi("Debe de rellenar el campo para realizar la busqueda", "error")
  }
}

function readProductsDetInfo(data) {
  let url = "&action=listDataProductSearch&info=" + data;
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let barcode = "<td>" + datos[i]["bar_code"] + "</td>";
        let group = "<td>" + datos[i]["name_group"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";
        let description = "<td>" + datos[i]["description"] + "</td>";
        let sale_price = "<td> $ " + datos[i]["sale_price"] + "</td>";
        let sale_price_1 = "<td> $ " + datos[i]["sale_price_1"] + "</td>";
        let location = "";
        let laboratorie = "<td> " + datos[i]["laboratorie"] + "</td>";
        let set_location = datos[i]["location"];
        let sub_location = datos[i]["sub_location"];

       
        if (sub_location === "" ||sub_location === ' ' ||sub_location === "null" || sub_location === null || sub_location === undefined) {
          location = "<td>"+ set_location +"</td>";
        }else{
          location = "<td>"+ set_location + "<br><strong>  Otra ubicacion:</strong><br>"+ sub_location +"</td>";
        }


        let status_product =
          "<td><span class='badge badge-" +
          datos[i]["status_product_color"] +
          "'> " +
          datos[i]["status_product_name"] +
          "</span></td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editProduct(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='addPresentacion(" +
          id +
          ")'><i class='fas fa-box text-warning'></i> <span class='nav-link-text'>Presentaciones</span></button>" +
          "<button class='dropdown-item' onclick='addLote(" +
          id +
          ")'><i class='fas fa-poll-h text-info'></i> <span class='nav-link-text'>Lotes</span></button>" +
          "<button class='dropdown-item' onclick='deletProduct(" +
          id +
          ")'><i class='fas fa-trash-alt text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas +=
        "<tr>" + cod + barcode + group + name + sale_price + sale_price_1 + location + laboratorie +   btn + "</tr>";
      }

      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function readProductsItem(item) {
  let url = "&action=listDataProductItem&item=" + item;
  $.ajax({
    url: "../../controller/controller_products.php",
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
        let barcode = "<td>" + datos[i]["bar_code"] + "</td>";
        let group = "<td>" + datos[i]["name_group"] + "</td>";
        let name = "<td>" + datos[i]["name"] + "</td>";
        let description = "<td>" + datos[i]["description"] + "</td>";
        let sale_price = "<td> $ " + datos[i]["sale_price"] + "</td>";
        let sale_price_1 = "<td> $ " + datos[i]["sale_price_1"] + "</td>";
        let vendedor = "<td>" + datos[i]['proveedor'] + "</td>";
        let location = "";
        let laboratorie = "<td> " + datos[i]["laboratorie"] + "</td>";
        let set_location = datos[i]["location"];
        let sub_location = datos[i]["sub_location"];

        
        if (sub_location === "" ||sub_location === ' ' ||sub_location === "null" || sub_location === null || sub_location === undefined) {
          location = "<td>"+ set_location +"</td>";
        }else{
          location = "<td>"+ set_location + "<br><strong>  Otra ubicacion:</strong><br>"+ sub_location +"</td>";
        }

        let status_product =
          "<td><span class='badge badge-" +
          datos[i]["status_product_color"] +
          "'> " +
          datos[i]["status_product_name"] +
          "</span></td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='editProduct(" +
          id +
          ")'><i class='ni ni-ruler-pencil text-success'></i> <span class='nav-link-text'>Editar</span></button>" +
          "<button class='dropdown-item' onclick='addPresentacion(" +
          id +
          ")'><i class='fas fa-box text-warning'></i> <span class='nav-link-text'>Presentaciones</span></button>" +
          "<button class='dropdown-item' onclick='addLote(" +
          id +
          ")'><i class='fas fa-poll-h text-info'></i> <span class='nav-link-text'>Lotes</span></button>" +
          "<button class='dropdown-item' onclick='deletProduct(" +
          id +
          ")'><i class='fas fa-trash-alt text-danger'></i> <span class='nav-link-text'>Eliminar</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas +=
        "<tr>" + cod + barcode + name  + group + laboratorie + vendedor +  btn + "</tr>";
      }

      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}


function hacerSubmit() {
 $("#invoice_data").submit();
 return false; 
}


function grabarOrden() {
 
  var formulario = "#invoice_data";

 
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: $(formulario).serialize(),
    dataType: "json",
    success: function(respuesta) {
      console.log(respuesta);
    },
    error: function() {
      alert_top_mi("¡Error!","error");
      return false;
    }
  });
}


function imprimirTicket(id_orden) {
   let url = "&action=TicketVenta&id_invoice=" + id_orden;
   $.ajax({
    type: "POST",
    url: "../out/tickets/ticket.php",
    data: url,
    dataType: "json",
    success: function(respuesta) {
      alert_top_mi("Finalizando Transaccion","success");
       window.setTimeout(location.reload(), 150); 
     
    },
    error: function() {
      /* alert_top_mi("¡Error! No se logo imprimir el Ticket","error"); */
      alert_top_mi("Finalizando Transaccion","success");
      window.setTimeout(location.reload(), 150); 
     
    }
  });
  
}


function imprimirTicket_re(id_orden) {
  let url = "&action=TicketVenta&id_invoice=" + id_orden;
  $.ajax({
   type: "POST",
   url: "../out/tickets/ticket.php",
   data: url,
   dataType: "json",
   success: function(respuesta) {
     alert_top_mi("Imprimiendo documento","success");
   },
   error: function() {
     /* alert_top_mi("¡Error! No se logo imprimir el Ticket","error"); */
     alert_top_mi("Imprimiendo documento","success");
    
   }
 });
 
}




function mostraModalBusquedaCompleto() {
  $("#modal_busqueda_productos_completo").modal('show');
  readProductsDet_data();
}


function readProductsDet_data() {
  let url = "&action=listDataProduct";
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      var table = $("#datos_busqueda").DataTable().clear().draw();
      table.destroy();
      let filas = "";
      for (let i = 0; i < datos.length; i++) {
        let id = datos[i]["id"];
        let code =  '"' + datos[i]["cod"] + '"';
        let barcode = "<td>" + datos[i]["bar_code"] + "</td>";
        let group = "<td>" + datos[i]["name_group"] + "</td>";
        let name = " <td onclick='generarBusqueda(" + code +")'>" + datos[i]["name"] + "</td>";
        let description = "<td>" + datos[i]["description"] + "</td>";
        let sale_price = "<td> $ " + datos[i]["sale_price"] + "</td>";
        let sale_price_1 = "<td> $ " + datos[i]["sale_price_1"] + "</td>";
        
        let laboratorie = "<td> " + datos[i]["laboratorie"] + "</td>";
        let location = "";
        let set_location = datos[i]["location"];
        let sub_location = datos[i]["sub_location"];
         let existencias = datos[i]["current_existence"];
        let rowExisten = "";


       
        if (sub_location === "" ||sub_location === ' ' ||sub_location === 'SIN UBICACION' ||sub_location === "null" || sub_location === null || sub_location === undefined) {
          location = "<td>"+ set_location +"</td>";
        }else{
          location = "<td>"+ set_location + "<br><strong>  Otra ubicacion:</strong><br> <label class='text-sm'>"+ sub_location +"</label></td>";
        }


        if (existencias === "" ||existencias === ' ' ||existencias === "null" || existencias === null || existencias === undefined || existencias <= 0) {
          rowExisten = "<td> 0 </td>";
        }else{
          rowExisten = "<td>"+ existencias +"</td>";
        }


        let status_product =
          "<td><span class='badge badge-" +
          datos[i]["status_product_color"] +
          "'> " +
          datos[i]["status_product_name"] +
          "</span></td>";

        var btn =
          "<td>" +
          "<div class='dropdown'>" +
          "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
          "<i class='fas fa-ellipsis-v'></i>" +
          "</a>" +
          "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
          "<button class='dropdown-item' onclick='addPresentacion(" +
          id +
          ")'><i class='fas fa-box text-warning'></i> <span class='nav-link-text'>Presentaciones</span></button>" +
          "</div>" +
          "</div>" +
          "</td>";

        filas +=
        "<tr>" + barcode + group + name + sale_price + sale_price_1 + location + laboratorie + rowExisten  + "</tr>";
      }

      $("#data_busqueda").append(filas);
      $("#datos_busqueda").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}




/* function imprimirTicket(id_ordem) {
  window.open(
    "../out/ticket.php",
    "Reporte de Rubros de Productos",
    "width=600, height=600"
  );
}
 */



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





  function discount_inventory(id, factor) {
    let url = "&action=discount_inventory&id_prod=" + id + "&factor=" + factor;
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
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

function abrirModalEditable(id, cod, facto) {
  $("#modal_producto_person").modal("show");
  document.getElementById("id_product").value = id;
  document.getElementById("cod_product").value = cod;
  document.getElementById("factor_product").value = facto;

}



function agregarProductoGenerico() {
  let id = document.getElementById("id_product").value ;
  let cod = document.getElementById("cod_product").value;
  let factor = document.getElementById("factor_product").value;
  let name = document.getElementById("name_product").value;
  let price = document.getElementById("precio_producto").value;
  let priceSug = document.getElementById("precio_producto_sug").value;
  let presentation = document.getElementById("presentacion_producto").value;

  cerrarModales();
  let row = "";
  price = parseFloat(price);
  priceSug = parseFloat(priceSug);
  let totalDes = priceSug - price;
  let id_row = generateAutoincrement();


  let rowId = "<td class='d-none'><input name='idProduct[]' id='idProduct' type='text' class='d-none' value='" + id + "'></td>"
  let rowCod ="<td ><input name='codProduct[]' id='codProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)' readonly   class='d-none' value='" +
    cod +
    "'><label>" +
    cod +
    "</label></td>";
  let rowName =
    "<td ><input name='nameProduct[]' id='nameProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)' readonly   class='d-none' value='" +
    name +
    "'><label>" +
    name +
    "</label></td>";
  let rowCant =
    "<td ><input name='cantProduct[]' id='cantProduct" +
    id_row +
    "' type='number' onchange='sumRow(" +
    id_row +
    ")'  onkeypress='return valid_enter(event)' onblur='restablecer_campo(" +
    id_row +
    ")'  onfocus='clearTar(" +
    id_row +
    ")'  class='form-control form-control-sm' value='" +
    1 +
    "'></td>";

    let rowFactor =
    "<td class='d-none'><input name='factorProduct[]' id='factorProduct" +
    id_row + "' type='text''  class='form-control form-control-sm' value='" + factor + "'></td>";

  let rowPres =
    "<td ><input name='presentationProduct[]' id='presentationProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none' value='" +
    presentation +
    "'><label>&nbsp;&nbsp;&nbsp;" +
    presentation +
    "</label></td>";
  let rowPric =
    "<td ><input name='priceProduct[]' id='priceProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none' value='" +
    price +
    "'><label>&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;$ " +
    price +
    "</label></td>";

  let rowPricSug =
    "<td><input name='priceSugProduct[]' id='priceSugProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none' value='" +
    priceSug +
    "'><label>&nbsp;&nbsp;&nbsp $ " +
    priceSug +
    "</label></td>";

  let rowTotalDes =
    "<td class='d-none'><input name='totalDescProduct[]' id='totalDescProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='form-control form-control-sm ttd_documento' value='" +
    totalDes +
    "'></td>";
  let rowTotal =
    "<td ><input name='totalPriceProduct[]' id='totalPriceProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none tt_documento' value='" +
    price +
    "'><label id='totalPriceProduct_tt" +
    id_row +
    "'>&nbsp;&nbsp;&nbsp $ " +
    price +
    "</label></td>";
  let btnDele =
    "<td >&nbsp;&nbsp;&nbsp<button type='button' class='btn btn-outline-danger btn-sm' onclick='deletRow(this)'><i class='fas fa-trash-alt text-outline-danger'></i><span class='nav-link-text'></span></button><td>";

  row +=
    "<tr class='table-sm' id='" +
    id_row +
    "'>" +
    rowId +
    rowCod +
    rowName +
    rowCant +
    rowPres +
    rowPricSug +
    rowPric +
    rowFactor +
    rowTotal +
    rowTotalDes +
    btnDele +
    "</tr>";
  $("#data").prepend(row);
  sumDocument();
  sumDocumentDesc();
  clearCamposBusqueda();
  alert_top_mi('Se ha agregado ' + name , 'success')

  limpiarPersonalizado();

}


function limpiarPersonalizado() {
  document.getElementById("id_product").value  = "";
  document.getElementById("cod_product").value = "";
  document.getElementById("factor_product").value = "";
  document.getElementById("name_product").value = "";
  document.getElementById("precio_producto").value = "";
  document.getElementById("precio_producto_sug").value = "";
  document.getElementById("presentacion_producto").value = "";
  $("#modal_producto_person").modal("hide");
}






/******************************************************************************************************************************************************/
/******************************************************************************************************************************************************/



/* FUIONES DE COMPRAS */

function valid_enter_busqueda_compra(e) {
  if (e.keyCode == 13) {
    let data = document.getElementById("")
    bar_code_search_compra();
    return false;
  } else {
    return true;
  }
}


function valid_enter_busqueda_text_compra(e) {
  if (e.keyCode == 13) {
    name_search_compra();
    document.getElementById("name_search").value = "";
    return false;
  } else {
    return true;
  }
}

$(document).ready(function () {
  $(".select-activo").select2();
});

/**Llena el combo de grupos en el modal de productos */
function bar_code_search_compra() {
  let bar_code = document.getElementById("codigo_barra").value;
  let url = "&action=listDataToBarCode&bar_code=" + bar_code;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos);
      if (datos.length >= 1) {
        let id = datos[0]["id"];
        let cod = datos[0]["cod"];
        let name = datos[0]["name"];
        let presentation = datos[0]["presentation"];
        let price = datos[0]["sale_price_1"];
        let cost = datos[0]["cost"];

        let priceSug = datos[0]["sale_price"];
        if (priceSug == '0' || priceSug == '0.0' || priceSug == '0.00' || priceSug == null || priceSug == 'null' || priceSug == 'NULL' ) {
          priceSug = price;
        }else{

        }

       

        if (presentation == "null" || presentation == null) {
          presentation = "UNI";
        } else {
        }
        valid_press_compra(
          id,
          cod,
          name,
          presentation,
          cost,
          price,
          priceSug
        );
        clearCamposBusqueda();
      } else {
        bar_code_search_press(bar_code);
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function bar_code_search_press(bar_code) {

  let url = "&action=listDataToBarCodePres&bar_code=" + bar_code;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos);
      if (datos.length >= 1) {
        let id_product = datos[0]["id_product"];
        let presentation = datos[0]["name"];
        let factor = datos[0]["factor"];
        let price = datos[0]["sale_price"];
        let price_sug = datos[0]["precio_presS"];

        if (precio_presS == '' || precio_presS == 'null' || precio_presS == '0' || precio_presS == '0.00') {
          price_sug_v = price;
        }else{
          price_sug_v = price_sug;
        }
        searchProductPres(id_product, presentation, factor, price, price_sug);
        
      } else {
        alert_top_mi("Error, No se encontro el producto", "error");
        clearCamposBusqueda();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}




function searchProductPres(id_product, presentation, factor, price, price_sug) {
  let url = "&action=searchProductName&id=" + id_product;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      console.log(datos);
      if (datos.length >= 1) {
        let id = datos[0]["id"];
        let cod = datos[0]["cod"];
        let name = datos[0]["name"];
    
      
      addShopping(id, cod, name, presentation,factor, price, price_sug, factor); 
      } else {
        alert_top_mi("Error, No se encontro el producto", "error");
        clearCamposBusqueda();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
  
}

function name_search_compra() {
  let name = document.getElementById("name_search").value;
  if (name.length == 0) {
  } else {
    let url = "&action=listDataToName&name=" + name;
    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        let total = datos.length;
        if (total == 0) {
          alert_top_mi("No se encontraron coincidencias", "warning");
        } else if (total == 1) {
          let id = datos[0]["id"];
          let cod = datos[0]["cod"];
          let name = datos[0]["name"];
          let presentation = datos[0]["presentation"];
          let price = datos[0]["sale_price_1"];
          let priceSug = datos[0]["sale_price"];
          let cost = datos[0]["cost"];

          if (presentation == "null" || presentation == null) {
            presentation = "UNI";
          } else {
          }
          valid_press_compra(
            id,
            cod,
            name,
            presentation,
            cost,
            price,
            priceSug
          );
          clearCamposBusqueda();
        } else {
          $('#modal_busqueda_productos').modal({
            backdrop: 'static',
            keyboard: false
        })
          

          let filas = "";
          for (let i = 0; i < datos.length; i++) {
            let id = datos[i]["id"];
            let cod = "<td>" + datos[i]["cod"] + "</td>";
            let name = "<td>" + datos[i]["name"] + "</td>";
            let description = "<td>" + datos[i]["description"] + "</td>";
            let presentation = "<td>" + datos[i]["presentation"] + "</td>";
            let sale_price = "<td> $ " + datos[i]["sale_price_1"] + "</td>";
            let priceSug = "<td> $ " + datos[i]["sale_price"] + "</td>";
            let laboratorie = "<td> " + datos[i]["laboratorie"] + "</td>";

            let id_shop = datos[i]["id"];
            let cod_shop = datos[i]["cod"];
            let name_shop = datos[i]["name"];
            let cost = datos[i]["cost"];
            let presentation_shop = datos[i]["presentation"];

            if (presentation_shop == "null" || presentation_shop == null) {
              presentation_shop = "UNI";
            } else {
            }
            let sale_price_shop = datos[i]["sale_price_1"];
            let sale_price_sug_shop = datos[i]["sale_price"];

            let btn =
              "<td><button type='button' class='btn btn-outline-dark'  onclick='valid_press_compra(" +
              '"' +
              id_shop +
              '",' +
              '"' +
              cod_shop +
              '",' +
              '"' +
              name_shop +
              '",' +
              '"' +
              presentation_shop +
              '",' +
              '"' +
              cost +
              '",' +
              '"' +
              sale_price_shop +
              '",' +
              '"' +
              sale_price_sug_shop +
              '"' +
              ");'>Agregar</button></td>";

            filas +=
              "<tr>" +
              cod +
              name +
              laboratorie +
              priceSug +
              sale_price +
              btn +
              "</tr>";
          }

          var table = $("#datos_terceary_results").DataTable().clear().draw();
          table.destroy();
          $("#data_terceary_results").append(filas);
          $("#datos_terceary_results").DataTable({});
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
  }
}

function valid_press_compra(
  id,
  cod,
  name,
  presentation,
  cost,
  price,
  priceSug
) {
 
  $("#modal_busqueda_productos").modal("hide");
  let url = "&action=listDataToPresentation&id=" + id;

  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    //Obtenemos la respuesta del servidor
    .done(function (datos) {
      let deti = 1;
      let total = parseInt(datos[0]["total"]);
      if (total >= 1) {
        listDataProductsPresentationscompra(
          id,
          cod,
          name,
          cost,
          presentation,
          price,
          priceSug
        );
      } else {
        addShopping_COMRA(id, cod, name, presentation,deti,cost,  price, priceSug);
      
        cerrarModales();
      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function listDataProductsPresentationscompra(
  id,
  codigo,
  name,
  cost,
  press,
  price,
  priceSug
) {
 
 
  let url = "&action=listDataProductsPresentations&id=" + id;
  $.ajax({
    url: "../../controller/controller_products.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {

      for (let i = 0; i < datos.length; i++) {
        let precio = datos[i]["sale_price"];
        let precio_presS = datos[i]["precio_presS"];
        let factor_nuevo = datos[i]["factor"];
        let presentation = datos[i]["presentation"];

        if (precio_presS == '0' || precio_presS == '0.0'  || precio_presS == '0.00' || precio_presS == null || precio_presS == 'null' || precio_presS == 'NULL' ) {
          precio_presS = precio;

          if (presentation == 'CAJA' || presentation == 'Caja' || presentation == 'caja' ) {
            precio_presS = priceSug;
          }else{

          }
        }else{

        }

        let resName = "";
        if (presentation == 'CAJA' || presentation == 'Caja' || presentation == 'caja' ) {
           resName = name;
        }else{
          let acortarNombre = name.split("|");
          resName = acortarNombre[0];
        }
       
        if (presentation == 'CAJA' || presentation == 'Caja' || presentation == 'caja' ) {
          addShopping_COMRA(id, codigo, name, presentation,factor_nuevo,cost, price, priceSug)
        } else {
         
        }


      }
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}






function addShopping_COMRA(id, cod, name, presentation,factor,cost, price, priceSug) {

  cerrarModales();
  let row = "";
  price = parseFloat(price);
  priceSug = parseFloat(priceSug);
  let totalDes = priceSug - price;
  let id_row = generateAutoincrement();

  if (cod == "1851" && id == "1851") {
    abrirModalEditable(id, cod, factor)
  }else{

  let rowId = "<td class='d-none'><input name='idProduct[]' id='idProduct' type='text' class='d-none' value='" + id + "'></td>"
  let rowCod ="<td ><input name='codProduct[]' id='codProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)' readonly   class='d-none' value='" +
    cod +
    "'><label>" +
    cod +
    "</label></td>";


  let rowName =
    "<td ><input name='nameProduct[]' id='nameProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)'  readonly   class='d-none' value='" +
    name +
    "'><label onclick='addPresentacion("+id+")'>" +
    name +
    "</label></td>";
  let rowCost =
    "<td ><input name='costProduct[]' id='costProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)' value='" +
    cost +
    "' class='form-control' onchange='cambiarCostoProducto("+ id +","+ cost+", "+ id_row+");'><input name='costDBProduct[]' id='costDBProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)' value='" +
    cost +
    "' class='d-none'></td>";
  let rowCant =
    "<td ><input name='cantProduct[]' id='cantProduct" +
    id_row +
    "' type='number' onchange='sumRow_COMPRA(" +
    id_row +
    ")'  onkeypress='return valid_enter(event)' onblur='restablecer_campo(" +
    id_row +
    ")'  onfocus='clearTar(" +
    id_row +
    ")'  class='form-control form-control-sm' value='" +
    1 +
    "'></td>";

    let rowFactor =
    "<td class='d-none'><input name='factorProduct[]' id='factorProduct" +
    id_row + "' type='text''  class='form-control form-control-sm' value='" + factor + "'></td>";

  let rowPres =
    "<td ><input name='presentationProduct[]' id='presentationProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none' value='" +
    presentation +
    "'><label>&nbsp;&nbsp;&nbsp;" +
    presentation +
    " <strong>** " + factor + "</strong> </label></td>";


  let rowPric =
    "<td ><input name='priceProduct[]' id='priceProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' onchange='cambiarPreVentaProducto("+ id +","+ price+", "+ id_row+")'  class='form-control text-warning' value='" +
    price +
    "'</td>";

  let rowPricSug =
    "<td><input name='priceSugProduct[]' id='priceSugProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)'  value='" +
    priceSug +
    "' class='form-control' onchange='cambiarPrecioSugProducto("+ id +","+ priceSug+", "+ id_row+");'><input name='priceSugDBProduct[]' id='priceSugDBProduct" +
    id_row +
    "' type='text' onkeypress='return valid_enter(event)' value='" +
    priceSug +
    "' class='d-none'></td>";



  let rowTotalDes =
    "<td class='d-none'><input name='totalDescProduct[]' id='totalDescProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='form-control form-control-sm ttd_documento' value='" +
    totalDes +
    "'></td>";
  let rowTotal =
    "<td ><input name='totalPriceProduct[]' id='totalPriceProduct" +
    id_row +
    "' type='text'  onkeypress='return valid_enter(event)' readonly  class='d-none tt_documento' value='" +
    cost +
    "'><label id='totalPriceProduct_tt" +
    id_row +
    "'>&nbsp;&nbsp;&nbsp $ " +
    cost +
    "</label></td>";
  let btnDele =
    "<td >&nbsp;&nbsp;&nbsp<button type='button' class='btn btn-outline-danger btn-sm' onclick='deletRow(this)'><i class='fas fa-trash-alt text-outline-danger'></i><span class='nav-link-text'></span></button><td>";
  
  row +=
    "<tr class='table-sm' id='" +
    id_row +
    "'>" +
    rowId +
    rowCod +
    rowName +
    rowCant +
    rowPres +
    rowCost +
    rowPricSug +
    rowPric +
    rowFactor +
    rowTotal +
    rowTotalDes +
    btnDele +
    "</tr>";
  $("#data").prepend(row);
  sumDocument();
  validar_monto();
  clearCamposBusqueda();
  alert_top_mi('Se ha agregado ' + name , 'success')
  }

  obtenerDataDocument();
}



function sumRow_COMPRA(row) {
  var price = parseFloat(document.getElementById("costProduct" + row).value);
  var cant = parseFloat(document.getElementById("cantProduct" + row).value);

  if (cant >= 0) {
  } else {
    cant = 1;
  }

  let total_cantidad = price * cant;
  total = parseFloat(total_cantidad).toFixed(2);

  let camp = (document.getElementById("totalPriceProduct" + row).value = total);
  $("#totalPriceProduct_tt" + row).html(total);
 
  sumDocument();

}



function validar_monto() {
  let iva_total = 0;
  let total_pagar = 0;
  var iva = document.getElementById("impuesto").value;

  if (isNaN(parseFloat(iva))) {
    iva = 0;
  } else {
   
  }
  var total_doc = parseFloat(document.getElementById("tdocumentFinishINPUT").value);

  iva_total = total_doc * iva;
  total_pagar = total_doc + iva_total;

  document.getElementById("tdocumentFinishF").innerHTML = total_pagar.toFixed(2);
  document.getElementById("tdocumentFinishINPUT").value = total_pagar.toFixed(2);
}



function insertQuotesHead() {
  let number_transacction = document.getElementById("numero").value;
  let numero = document.getElementById("correlativo").value;
  let id_document = document.getElementById("id_documento").value;
  let date = document.getElementById("fecha_trans").value;
  let final_date = document.getElementById("fecha_trans_pag").value;
  let id_seller = document.getElementById("id_vendedor").value;
  let id_tyofpay = document.getElementById("id_tpago").value;
  let state = document.getElementById("state_trans").value;
  let total_document = document.getElementById("tdocumentFinishINPUT").value;


  let detalle = "#invoice_data";

   let data = "&action=insertQuotesHead&number_transacction=" + number_transacction + "&number_of_document=" + numero + "&id_document=" + id_document + "&date=" + date + "&final_date=" + final_date + "&id_seller=" + id_seller + "&id_tyofpay=" + id_tyofpay + "&state=" + state +"&total_document=" + total_document ; 

    $.ajax({
      url: "../../controller/controller_products.php",
      type: "POST",
      data:$(detalle).serialize() + data  ,
      dataType: "json",
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (respuesta) {
        if (!respuesta.error) {
          alert_top_mi("Se ha registra la transaccion con el numero " + respuesta.id, "success");
          location.reload();
         } else {
           alert_top_mi(respuesta.msg, "error");
           return false;
         }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
}

function contarFilas_compra() {
  var nFilas = $(".tabla_invoice tr").length;
  var nColumnas = $(".tabla_invoice tr:last td").length;

  if (nFilas >= 4) {

    insertQuotesHead();
  } else {
    alert_top_mi("Debe de agregar items al detalle de la venta", "error");
  }
}


function fechaActualCompra() {
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth() + 1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
  if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
  document.getElementById("fecha_trans").value = ano + "-" + mes + "-" + dia;
  document.getElementById("fecha_trans_pag").value = ano + "-" + mes + "-" + dia;
}


function sumDocumentCompra() {
  let total = 0;
  $(".tt_documento").each(function () {
    if (isNaN(parseFloat($(this).val()))) {
      total += 0;
    } else {
      total += parseFloat($(this).val());
    }
  });
  document.getElementById("tdocumentFinish").innerHTML = total.toFixed(2);
  document.getElementById("tdocumentFinishINPUT").value = total.toFixed(2);

  let type = document.getElementById("isAs").value;
  if (type == 'COMPRA') {
     validar_monto()
  }else{

  } 
}


function cambiarCostoProducto(id_product, cost_db, posicion) {
  Swal.fire({
    title: "Estas a punto de cambiar el costo del producto?",
    text: "Una vez realizado esto, no habra vuelta atras!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Modificar!",
  }).then((result) => {
    if (result.value) {
      updateCostProduct(id_product, cost_db, posicion);
    } else {
      alert_top_mi("Se cancelo el proceso de actualizacion", "warning");
      document.getElementById("costProduct" + posicion).value = cost_db;
    }
  });
 
}

function updateCostProduct(id_product, cost_db, posicion) {
  let costo_new = document.getElementById("costProduct" + posicion).value;
  let type = "&action=updateCostProduct&id=" + id_product + "&cost=" + costo_new;
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      if (r == 1) {
        alert_top_mi("Se modifico el costo del producto", "success");
        sumRow_COMPRA(posicion)
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        document.getElementById("costProduct" + posicion).value = cost_db;
        return false;
      }
    },
  });
  return false;
}


function cambiarPreVentaProducto(id_product, precio_db, posicion) {
  Swal.fire({
    title: "Estas a punto de cambiar el precio de venta del producto?",
    text: "Una vez realizado esto, no habra vuelta atras!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Modificar!",
  }).then((result) => {
    if (result.value) {
      updatePrecioProduct(id_product, precio_db, posicion);
    } else {
      alert_top_mi("Se cancelo el proceso de actualizacion", "warning");
      document.getElementById("priceProduct" + posicion).value = precio_db;
    }
  });
 
}


function cambiarPrecioSugProducto(id_product, precio_db, posicion) {
  Swal.fire({
    title: "Estas a punto de cambiar el precio sugerido del producto?",
    text: "Una vez realizado esto, no habra vuelta atras!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Modificar!",
  }).then((result) => {
    if (result.value) {
      updatePrecioSugProduct(id_product, precio_db, posicion);
    } else {
      alert_top_mi("Se cancelo el proceso de actualizacion", "warning");
      document.getElementById("priceProduct" + posicion).value = precio_db;
    }
  });
 
}

function updatePrecioProduct(id_product, precio_db, posicion) {
  let precio = document.getElementById("priceProduct" + posicion).value;
  let type = "&action=updatePrecioProduct&id=" + id_product + "&precio=" + precio;
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      if (r == 1) {
        alert_top_mi("Se modifico el precio del producto", "success");
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        document.getElementById("priceProduct" + posicion).value = precio_db;
        return false;
      }
    },
  });
  return false;
}



function updatePrecioSugProduct(id_product, precio_db, posicion) {
  let precio = document.getElementById("priceSugProduct" + posicion).value;
  let type = "&action=updatePrecioSugProduct&id=" + id_product + "&precio=" + precio;
  $.ajax({
    type: "POST",
    url: "../../controller/controller_products.php",
    data: type,
    success: function (r) {
      if (r == 1) {
        alert_top_mi("Se modifico el precio sugerido del producto", "success");
      } else {
        alert_top_mi("Error al tratar registrar los datos", "error");
        document.getElementById("priceSugProduct" + posicion).value = precio_db;
        return false;
      }
    },
  });
  return false;
}







function generarBusqueda(codigo) {
  document.getElementById("codigo_barra").value = codigo;
  $("#modal_busqueda_productos_completo").modal('hide');
  bar_code_search(); 
}
