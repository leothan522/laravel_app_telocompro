document.addEventListener('DOMContentLoaded', function () {
    var btn_galeria_imagen = document.getElementById('btn_galeria_imagen');
    var galeria_imagen = document.getElementById('galeria_imagen');
    btn_galeria_imagen.addEventListener('click', function (e) {
        e.preventDefault();
        galeria_imagen.click();
    });
    galeria_imagen.addEventListener('change', function () {
        Swal.fire({
            title: '¡Subiendo Archivo!',
            didOpen: () => {
                Swal.showLoading()
            },
            allowOutsideClick: false,
            showConfirmButton: false,
        });
        document.getElementById('formGaleria').submit();
    });
});
