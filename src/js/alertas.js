function alert_top(title, type) {
  Swal.fire({
    position: 'top-end',
    icon: type,
    title: title,
    showConfirmButton: false,
    timer: 1500
  })
}


function alert_top_mi(title, type) {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: type,
    title: title
  })
}

