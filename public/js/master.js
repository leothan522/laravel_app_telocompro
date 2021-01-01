var route = document.getElementsByName('routeName')[0].getAttribute('content');
document.addEventListener('DOMContentLoaded', function () {
    //MODULO ACTIVO
    route_active = document.getElementsByClassName('lko-'+route)[0].classList.add('menu-open');
    route_active = document.getElementsByClassName('lkm-'+route)[0].classList.add('active');
    route_active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');

});

function alertaBorrar(form_id = "form_delete", url = null){
    Swal.fire({
        title: '¿Estas seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        if (result.isConfirmed) {
            if (!url){
                document.getElementById(form_id).submit();
            }else {
                window.location.href = url
            }

        }
    })
}
