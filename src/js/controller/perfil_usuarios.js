function validar_datos_reset() {
    let ant_passw = document.getElementById("ant_password");
    let new_passw = document.getElementById("new_password");
    let rep_passw = document.getElementById("rep_password");

    if (ant_passw.value.length === 0) {
        ant_passw.focus();
        alert_error("¡Alerta!", "Debe de ingresar su actual contraseña");
    }else if (new_passw.value.length === 0) {
        new_passw.focus();
        alert_error("¡Alerta!", "Debe de ingresar su nueva contraseña");
    }else if (rep_passw.value.length === 0) {
        rep_passw.focus();
        alert_error("¡Alerta!", "Debe de repetir su nueva contraseña");
    }else if(new_passw.value != rep_passw.value){
        rep_passw.focus();
        alert_warning("¡Alerta!", "Las nuevas contraseñas no coinciden");
    }else{
        validar_contra(ant_passw.value, new_passw.value, rep_passw.value);
    }
    
}


function validar_contra(ant_passw, new_passw, rep_passw) {
    let datos = "&passw=" + ant_passw + "&accion=verificar_credencial";
    $.ajax({
        url: "../../controller/controller_user.php",
        type: "POST",
        dataType: "json",
        data: datos,
        beforeSend: function() {}
      })
    
    //Obtenemos la respuesta del servidor
    .done(function(respuesta) {
        if (!respuesta.error) {
            cambiar_credenciales(new_passw);
        } else {
            alert_error("Error", respuesta.msg);
            document.getElementById("ant_password").value = "";
            document.getElementById("ant_password").focus();
        }
    })
    
    .fail(function(resp) {
        console.log(resp.responseText);
    })
}


function cambiar_credenciales(new_passw) {
    alert("La nueva contraseña sera:" + new_passw);
}