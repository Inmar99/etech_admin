function alert_sussess(title, text) {
    Swal.fire({
        icon: 'success',
        title: title,
        text: text
      })
}


function alert_warning(title, text) {
    Swal.fire({
        icon: 'warning',
        title: title,
        text: text
      })
}

function alert_error(title, text) {
    Swal.fire({
        icon: 'error',
        title: title,
        text: text
      })
}

function alert_error_time(title, text) {
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: title,
        text: text,
        showConfirmButton: false,
        timer: 1500
      })
}

function mostrarModal() {
  $('#modal_view').modal({
    backdrop: 'static',
    keyboard: false
})
}

function mostrarModal_Sec() {

  $('#modal_view_sec').modal({
    backdrop: 'static',
    keyboard: false
})
}

function cerrarModal() {
  $("#modal_view").modal('hide');
}

function cerrarModal_Sec() {
  $("#modal_view_sec").modal('hide');
}




  
  



