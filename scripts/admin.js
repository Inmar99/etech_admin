/* **************** SECCION DE ADMINISTRACION DE LOS DATOS DE LA EMPRESA **************** */

class CompanyProfile {
  id;
  name;
  legalName;
  mainTurn;
  slogan;
  legalRepresentative;
  postalCode;
  address;
  country;
  state;
  municipality;
  city;
  telephone;
  fax;
  email;
  nit;
  nrc;

  constructor(id, name, legalName, mainTurn, slogan, legalRepresentative, postalCode, address, country, state, municipality, city, telephone, fax, email, nit, nrc) {
    this.id = id;
    this.name = name;
    this.legalName = legalName;
    this.mainTurn = mainTurn;
    this.slogan = slogan;
    this.legalRepresentative = legalRepresentative;
    this.postalCode = postalCode;
    this.address = address;
    this.country = country;
    this.state = state;
    this.municipality = municipality;
    this.city = city;
    this.telephone = telephone;
    this.fax = fax;
    this.email = email;
    this.nit = nit;
    this.nrc = nrc;
  }
}

var company;

function initCompany() {
  getCompanyInfo();
}





function getCompanyInfo() {
  let url = "&action=getCompanyInfo";
  $.ajax(
    {
      url: "../../controller/controller_admin.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {}
    }
  ).done(datos => {
    company = new CompanyProfile();
    company.id = datos[0]["id"];
    company.name = datos[0]["company_name"];
    company.legalName = datos[0]["company_comercial_name"];
    company.mainTurn = datos[0]["company_turn"];
    company.slogan = datos[0]["company_slogan"];
    company.legalRepresentative = datos[0]["legal_representative"];
    company.postalCode = datos[0]["postal_code"];
    company.country = datos[0]["country"];
    company.address = datos[0]["address"];
    company.state = datos[0]["state"];
    company.municipality = datos[0]["municipality"];
    company.city = datos[0]["city"];
    company.telephone = datos[0]["telephone"];
    company.fax = datos[0]["fax"];
    company.email = datos[0]["email"];
    company.nit = datos[0]["nit"];
    company.nrc = datos[0]["nrc"];

    // Setting the Company Info Section.
    document.getElementById("companyName").innerHTML = company.name;
    document.getElementById("companyEmail").innerHTML = company.email;
    document.getElementById("companySlogan").innerHTML = company.slogan;
    // Setting the Company Legal Info Section
    document.getElementById("companyLegalName").innerHTML = company.legalName;
    document.getElementById("companyTurn").innerHTML = company.mainTurn;
    document.getElementById("companyNIT").innerHTML = company.nit;
    document.getElementById("companyNRC").innerHTML = company.nrc;
    document.getElementById("companyLegalRepresentative").innerHTML = company.legalRepresentative;
    // Setting the Company Contact and Location Info
    document.getElementById("companyAddress").innerHTML = company.address;
    document.getElementById("companyCountry").innerHTML = company.country;
    document.getElementById("companyState").innerHTML = company.state;
    document.getElementById("companyPostalCode").innerHTML = company.postalCode;
    document.getElementById("companyMunicipality").innerHTML = company.municipality;
    document.getElementById("companyCity").innerHTML = company.city;
    document.getElementById("companyTelephone").innerHTML = company.telephone;
    document.getElementById("companyFAX").innerHTML = company.fax;
  }).fail(resp => { console.log(resp.responseText) });
}

/* Lanza el modal para llenar los datos del grupo */
function mostrarModalGeneral() {
  $("#modify_comp").modal('show');
  // Setting the Company Info Section.
  document.getElementById("id").value = company.id;
  document.getElementById("cmpName").value = company.name;
  document.getElementById("cmpEmail").value = company.email;
  document.getElementById("cmpSlogan").value = company.slogan;

  // Setting the Company Legal Info Section
  document.getElementById("cmpLegalName").value = company.legalName;
  document.getElementById("cmpTurn").value = company.mainTurn;
  document.getElementById("cmpNIT").value = company.nit;
  document.getElementById("cmpNRC").value = company.nrc;
  document.getElementById("cmpLegalRep").value = company.legalRepresentative;

  // Setting the Company Contact and Location Info
  document.getElementById("cmpAddress").value = company.address;
  document.getElementById("cmpCountry").value = company.country;
  document.getElementById("cmpState").value = company.state;
  document.getElementById("cmpPostalCode").value = company.postalCode;
  document.getElementById("cmpMunicipality").value = company.municipality;
  document.getElementById("cmpCity").value = company.city;
  document.getElementById("cmpTelephone").value = company.telephone;
  document.getElementById("cmpFAX").value = company.fax;
  
}

/* Envía los datos para actualizar la información de la compañía */
function updateCompanyInfo() {
  // let cmp = new CompanyProfile();
  // // Getting and Setting the Company Info Section.
  // cmp.name = document.getElementById("cmpName").value;
  // cmp.email = document.getElementById("cmpEmail").value;
  // cmp.slogan = document.getElementById("cmpSlogan").value;

  // // Getting and Setting the Company Legal Info Section
  // cmp.legalName = document.getElementById("cmpLegalName").value;
  // cmp.mainTurn = document.getElementById("cmpTurn").value;
  // cmp.nit = document.getElementById("cmpNIT").value;
  // cmp.nrc = document.getElementById("cmpNRC").value;
  // cmp.legalRepresentative = document.getElementById("cmpLegalRep").value;

  // // Getting and Setting the Company Contact and Location Info
  // cmp.address = document.getElementById("cmpAddress").value;
  // cmp.state = document.getElementById("cmpState").value;
  // cmp.postalCode = document.getElementById("cmpPostalCode").value;
  // cmp.municipality = document.getElementById("cmpMunicipality").value;
  // cmp.city = document.getElementById("cmpCity").value;
  // cmp.telephone = document.getElementById("cmpTelephone").value;
  // cmp.fax = document.getElementById("cmpFAX").value;

  // // console.log(document.getElementById("id").value);

  // var json = JSON.stringify(cmp);
  // console.log("Este es mi objeto json: " + json);

  let action = "&action=updateCompany";
  $.ajax(
    { 
      type: "POST",
      url: "../../controller/controller_admin.php",
      data: $("#updateCmp").serialize() + action,
      success: function (r) {
        if (r == 1) {
          console.log(r);
          alert_top_mi("Se han actualizado los datos exitosamente.", "success");
        } else {
          alert_top_mi("Error al tratar actualizar los datos.", "error");
          return false;
        }
      } 
      
    
    }
  );
  $("#modify_comp").modal('hide');
  getCompanyInfo();
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


function mostrarModalOculto() {
  $("#modal_oculto").modal('show');
}

/************************ FUNCIONES VARIAS  ************************/
/* Detecta eventos del teclado asi como las diferentes combinaciones del mismo */
$(document).keydown(function (e) {
  e = e || event;
  if (e.altKey & (String.fromCharCode(e.keyCode) == "N")) {
    mostrarModalGeneral();
  } else if (e.altKey & e.ctrlKey & (String.fromCharCode(e.keyCode) == "Z")) {
    mostrarModalOculto();
  } else if (e.altKey & (String.fromCharCode(e.keyCode) == "R")) {
    readGroups();
  }
});


function createMovements() {

  let type = "&action=insertMovements";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_admin.php",
    data: $("#registro").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro")[0].reset();
        alert_top_mi("Se ha ingresado correctamente el movimiento", "success");
        readMovements();
        clearFormMovements();
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


function createManagement() {
  let tipo = document.getElementById("type").value;
  let type = "&action=createManagement";
  $.ajax({
    type: "POST",
    url: "../../controller/controller_admin.php",
    data: $("#registro_sec").serialize() + type,
    success: function (r) {
      if (r == 1) {
        console.log(r);
        $("#registro_sec")[0].reset();
        alert_top_mi("Se han ingresado los datos", "success");
        $('#modal_view_2').modal('hide');

        if (tipo == 'CIERRE') {
          generarCorteZ();
        }else{

        }
        
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


function generarCorteZ() {
  let url = "&action=TicketVenta";
  $.ajax({
   type: "POST",
   url: "../../view/out/tickets/corteZ.php",
   data: url,
   dataType: "json",
   success: function(respuesta) {
     alert_top_mi("GENERANDO CORTE Z","success");
     window.setTimeout(location.reload(), 150);
    
   },
   error: function() {
     /* alert_top_mi("¡Error! No se logo imprimir el Ticket","error"); */
     alert_top_mi("GENERANDO CORTE Z","success");
     window.setTimeout(location.reload(), 150);
    
   }
 });
 
}


$(document).keydown(function (e) {
  e = e || event;
  if (e.altKey & (String.fromCharCode(e.keyCode) == "C")) {
    generarReporteCorteZ();
  } else if (e.ctrlKey & (String.fromCharCode(e.keyCode) == "X")) {
    /* habilitarCampo(); */
  }
});

function generarReporteCorteZ() {
  let url = "&action=TicketVenta";
  $.ajax({
   type: "POST",
   url: "../../view/out/tickets/report_corteZ.php",
   data: url,
   dataType: "json",
   success: function(respuesta) {
     alert_top_mi("GENERANDO REPORTE CORTE Z","success");
     window.setTimeout(location.reload(), 150);
    
   },
   error: function() {
     /* alert_top_mi("¡Error! No se logo imprimir el Ticket","error"); */
     alert_top_mi("GENERANDO REPORTE CORTE Z","success");
     window.setTimeout(location.reload(), 150);
    
   }
 });
 
}



function generarReportesCortesZTS() {
  let url = "&action=TicketVenta";
  $.ajax({
   type: "POST",
   url: "../../view/out/tickets/corteZTS.php",
   data: url,
   dataType: "json",
   success: function(respuesta) {
     alert_top_mi("GENERANDO REPORTE CORTE Z","success");
    
    
   },
   error: function() {
     /* alert_top_mi("¡Error! No se logo imprimir el Ticket","error"); */
     alert_top_mi("GENERANDO REPORTE CORTE Z","success");
     
    
   }
 });
 
}





function OpenManagement() {
   /*  $("#modal_view_2").modal("show"); */
   $('#modal_view_2').modal({
    backdrop: 'static',
    keyboard: false
})
 clearFormManagement();
}

function clearFormManagement() {
  document.getElementById('type').value = '';
  document.getElementById('mount').value = '';
  valid_management();
}

function valid_management() {
  let url = "&action=valid_management";
  $.ajax({
    url: "../../controller/controller_admin.php",
    type: "POST",
    dataType: "json",
    data: url,
    beforeSend: function () {},
  })
    .done(function (datos) {
      if (datos.length >= 1) {
        document.getElementById('type').value = 'CIERRE';
      }else{
        document.getElementById('type').value = 'APERTURA';

      }
     
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}

function OpenMovemetsAdd() {
    /*  $("#modal_view_2").modal("show"); */
     $('#modal_view').modal({
       backdrop: 'static',
       keyboard: false
   })
    clearFormMovements();
   
}

function clearFormMovements(){
  document.getElementById('codigo').value = '';
  document.getElementById('monto').value = '';
  document.getElementById('descripcion').value = '';

  document.getElementById("codigo").value  = Math.floor(Math.random() * 999999) + 1;
  list_typesMovements();
}


function init_cachiers_movements(){
  readMovements();
} 


function readMovements() {
  let url = "&action=listDataMovements";
  $.ajax({
    url: "../../controller/controller_admin.php",
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


        let cod = "<td>" + datos[i]["cod"] + "</td>";
        let date = "<td>" + datos[i]["date"] + "</td>";
        let type = "<td>" + datos[i]["type"] + "</td>";
        let types = "<td>" + datos[i]["name"] + "</td>";
        let mount = "<td>" + datos[i]["mount"] + "</td>";
        let description = "<td>" + datos[i]["description"] + "</td>";
      

        filas +=
        "<tr>" + cod  + type +  types  + mount + description + "</tr>";
      }

      $("#data").append(filas);
      $("#datos").DataTable({});
    })
    .fail(function (resp) {
      console.log(resp.responseText);
    });
}




function list_typesMovements() {
    let url = "&action=list_movementsTypes";
    $.ajax({
      url: "../../controller/controller_admin.php",
      type: "POST",
      dataType: "json",
      data: url,
      beforeSend: function () {},
    })
      //Obtenemos la respuesta del servidor
      .done(function (datos) {
        document.getElementById("type_movement").innerHTML = "";
        var select = document.getElementById("type_movement"); //Seleccionamos el select
        for (var i = 0; i < datos.length; i++) {
          select.options[i] = new Option(datos[i]["name"], datos[i]["id"]);
        }
      })
      .fail(function (resp) {
        console.log(resp.responseText);
      });
}


function valid_enter_caja(e) {
  if (e.keyCode == 13) {
    return false;
  } else {
    return true;
  }
}



function moviCajas() {
  document.getElementById("mount").value = "";
  let b100 = document.getElementById("billete100").value;
  let b50 = document.getElementById("billete50").value;
  let b20 = document.getElementById("billete20").value;
  let b10 = document.getElementById("billete10").value;
  let b5 = document.getElementById("billete5").value;
  let b1 = document.getElementById("billete1").value;

  let moneda1 = document.getElementById("moneda1").value;
  let moneda25 = document.getElementById("moneda25").value;
  let moneda10 = document.getElementById("moneda10").value;
  let moneda5 = document.getElementById("moneda5").value;
  let moneda01 = document.getElementById("moneda01").value;
 

  let total_x100 = b100 * 100;
  let total_x50 = b50 * 50;
  let total_x20 = b20 * 20;
  let total_x10 = b10 * 10;
  let total_x5 = b5 * 5;
  let total_x1 = b1 * 1;

  let total_c1 = moneda1 * 1;
  let total_c25 = moneda25 * 0.25;
  let total_c10 = moneda10 * 0.10;
  let total_c5 = moneda5 * 0.05;
  let total_c01 = moneda01 * 0.01;



  let suma_billetes = total_x100 + total_x50 + total_x20 + total_x10 + total_x5 + total_x1;
  let suma_monedas = total_c1 + total_c25 + total_c10 + total_c5 + total_c01;
 

  let total = suma_billetes + suma_monedas;
  document.getElementById("mount").value = total;
} 


$('.soloNumeros').keyup(function(){
  var val = $(this).val();
  if(isNaN(val)){
       val = val.replace(/[^0-9\.]/g,'');
       if(val.split('.').length>2) 
           val =val.replace(/\.+$/,"");
  }
  $(this).val(val); 
});



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




