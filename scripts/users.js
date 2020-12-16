function post_data() {
    let user = document.getElementById("username");
    let password = document.getElementById("password");
    let check = document.getElementById("customCheck");

    if (user.value.length == 0) {
        alert_top_mi('Error, debe de ingresar un usuario', 'error');
        user.focus();
    } else if (password.value.length == 0) {
        alert_top_mi('Error, debe de ingresar una contraseña', 'error');
        password.focus();
    } else {
        validate_data(user.value, password.value);
    }
}



function validate_data(user, password) {
    getCompanyInfoProfile();
    let url = "&email=" + user + "&password=" + password + "&action=validate_login";
    $.ajax({
        url: "../../controller/controller_user.php",
        type: "POST",
        dataType: "json",
        data: url,
        beforeSend: function () { }
    })
        //Obtenemos la respuesta del servidor
        .done(function (respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                let timerInterval
                Swal.fire({
                    title: 'BIENVENIDO DE NUEVO  ' + respuesta.name,
                    html: 'Espere un momento, mientras cargamos los datos de sesion',
                    timer: 2000,
                    icon: 'success',
                    timerProgressBar: true,
                    willOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {
                            const content = Swal.getContent()
                            if (content) {
                                const b = content.querySelector('b')
                                if (b) {
                                    b.textContent = Swal.getTimerLeft()
                                }
                            }
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('Iniciando')
                        location.href = "home.php";
                    }
                })
                /* location.href = "home.php"; */
            } else {
                alert_top_mi(respuesta.msg, 'error');
                document.getElementById("password").value = "";
                document.getElementById("password").focus();
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
}


function getCompanyInfoProfile() {
    let url = "&action=getCompanyInfoProfile";
    $.ajax(
        {
            url: "../../controller/controller_admin.php",
            type: "POST",
            dataType: "json",
            data: url,
            beforeSend: function () { }
        }
    ).done(datos => {

    }).fail(resp => { console.log(resp.responseText) });
}


function get_users() {
    let url = "&action=getUsers";
    $.ajax({
        url: "../../controller/controller_user.php",
        type: "POST",
        dataType: "json",
        data: url,
        beforeSend: function () { }
    })
        //Obtenemos la respuesta del servidor
        .done(function (datos) {
            console.log(datos);
            let filas = "";
            for (let i = 0; i < datos.length; i++) {
                let idUser = datos[i]['id'];

                let id = "<td>" + datos[i]['id'] + "</td>";
                let email = "<td>" + datos[i]['email'] + "</td>";
                let username = "<td>" + datos[i]['username'] + "</td>";
                let level_name = "<td>" + datos[i]['level_name'] + "</td>";
                let status = datos[i]['state'];

                var btn = "<td>" +
                    "<div class='btn-group'>" +
                    "<button type='button' class='btn btn-sm btn-primary  dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Acciones </button>" +
                    "<div class='dropdown-menu'>" +
                    "<a class='dropdown-item btn btn-success' href='#' onclick='edit_user_modal(" + idUser + ");'>Editar</a>" +
                    "<a class='dropdown-item btn btn-danger' href='#' onclick='delet_user(" + idUser + ");'>Eliminar</a>" +
                    "</div>" +
                    "</div>" +
                    "</td>";

                let state = "";

                if (status == 1) {
                    state = "<td><span class='badge badge-success'>Activo</span></td>";
                } else if (status == 2) {
                    state = "<td><span class='badge badge-warning'>Inactivo</span></td>";
                } else if (status == 3) {
                    state = "<td><span class='badge badge-danger'>Bloqueado</span></td>";
                } else {
                    state = "<td><span class='badge badge-dark'>S/E</span></td>";
                }

                filas += "<tr>" +
                    id +
                    email +
                    username +
                    level_name +
                    state +
                    btn +
                    "</tr>";
            }

            $("#data").append(filas);
            $('#datos').DataTable({
            });
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
}

function verify_username(value) {
    console.log(value);
    let url = "action=verifyUsername&value=" + value;
    $.ajax({
        url: "../../controller/controller_user.php",
        type: "POST",
        dataType: "json",
        data: url,
    }).done(datos => {
        let username;
        let usr;
        var label;
        var tip;
        if (datos.length > 0) {
            console.log("Got data!");
            username = datos[0]['username'];
        }
        usr = document.getElementById('usrName').value;
        label = document.getElementById('usrAvailable');
        tip = document.getElementById('tipIcon');
        if (username != usr) {
            if (!label.classList.contains('badge-success')) { label.style.color = null; label.classList.add('badge-success'); }
            label.classList.replace('badge-danger', 'badge-success');
            tip.classList.replace('ni-fat-remove', 'ni-check-bold');
            $('#usrAvailable').tooltip('hide').attr('data-original-title', "Nombre de usuario valido.").tooltip('show');
            username = "";
        } else if (username == "") {
            label.classList.replace('badge-success', 'badge-danger');
            tip.classList.replace('ni-check-bold', 'ni-fat-remove');
            // label.title = "Nombre de usuario actualmente en uso!";
            $('#usrAvailable').tooltip('hide').attr('data-original-title', "Ingrese un nombre de usuario!").tooltip('show');
            username = "";
        } else {
            label.classList.replace('badge-success', 'badge-danger');
            tip.classList.replace('ni-check-bold', 'ni-fat-remove');
            // label.title = "Nombre de usuario actualmente en uso!";
            $('#usrAvailable').tooltip('hide').attr('data-original-title', "Nombre de usuario en uso!").tooltip('show');
            username = "";
        }
    });
}

function load_user_levels() {
    let url = "action=getLevelUsers";
    $.ajax({
        url: "../../controller/controller_user.php",
        type: "POST",
        dataType: "json",
        data: url
    }).done(datos => {
        let select = document.getElementById('usrLevel');
        for (i = 0; i < datos.length; i++) {
            select.options[i] = new Option(datos[i]['name'], datos[i]['id']);
        }
    }).fail(resp => {
        console.log(resp.responseText);
    });
}

function load_user_statuses() {

    let url = "action=getUserStatuses";
    $.ajax({
        url: "../../controller/controller_user.php",
        type: "POST",
        dataType: "json",
        data: url
    }).done(datos => {
        let select = document.getElementById('usrStatus');
        for (i = 0; i < datos.length; i++) {
            select.options[i] = new Option(datos[i]['name'], datos[i]['id']);
        }
    }).fail(resp => {
        console.log(resp.responseText);
    });
}

function create_user() {
    let action = "&action=createUser";
    let inputPass = document.getElementById('usrPass');
    let pass = inputPass.value;
    let inputConfPass = document.getElementById('usrConfPass');
    let confPass = inputConfPass.value;
    if (pass != confPass) {
        inputPass.classList.add('is-invalid');
        inputConfPass.classList.add('is-invalid');
        inputConfPass.focus();
        return false;
    }

    if (inputPass.value.length > 0 && inputConfPass.value.length > 0) {
        $.ajax({
            url: "../../controller/controller_user.php",
            type: "POST",
            dataType: "json",
            data: $('#add_user').serialize() + action,
            success: function (r) {
                if (r == 1) {
                    console.log(r);
                    alert_top_mi("Se han actualizado los datos exitosamente.", "success");
                    $('#add_user').trigger('reset');
                    $("#add_user").modal('hide');
                    get_users();
                } else {
                    alert_top_mi("Error al tratar actualizar los datos.", "error");
                    return false;
                }
            }
        });
    } else {
        alert_top_mi('Error, debe de agregar una contraseña', 'error')
    }
}

function confirm_password(input) {
    let inputPass = document.getElementById('usrPass');
    let pass = inputPass.value;
    if (pass != input.value) {
        input.classList.add('is-invalid');
        inputPass.classList.remove('is-valid');
    } else {
        input.classList.replace('is-invalid', 'is-valid');
        inputPass.classList.add('is-valid');
    }
}

function show_new_user_modal() {
    $('#add_user_modal').modal('show');
    $('#add_user').trigger('reset');

    let inputPass = document.getElementById('usrPass');
    let inputConfPass = document.getElementById('usrConfPass');
    let label = document.getElementById('usrAvailable');

    inputPass.classList.remove('is-invalid');
    inputPass.classList.remove('is-valid');
    inputConfPass.classList.remove('is-invalid');
    inputConfPass.classList.remove('is-valid');
    label.classList.remove('badge-success');
    label.classList.remove('badge-danger');
    label.style.color = "white";


    let modal = document.getElementById('add_user_modal');
    modal.children.style = "revert";
    load_user_levels();
    load_user_statuses();
}

function edit_user_modal(id) {
    $('#add_user_modal').modal('show');
    load_user_levels();
    load_user_statuses();
    let url = "&id=" + id + "&action=getUser";
    $.ajax({
        url: "../../controller/controller_user.php",
        type: "POST",
        dataType: "json",
        data: url,
        beforeSend: function () { },
    })
        .done(function (datos) {
            document.getElementById("usrEmail").value = datos[0]["email"];
            document.getElementById("usrName").value = datos[0]["username"];
            document.getElementById("id").value = datos[0]["id"]
            $("#usrStatus option[value=" + datos[0]["state"] + "]").attr("selected", true);
            $("#usrLevel option[value=" + datos[0]["id_level"] + "]").attr("selected", true);
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        });

}


function valid_enter(e) {
    if (e.keyCode == 13) {
        post_data();
    }
}



function delet_user(id) {
    alert('Eliminar ya ')
}



