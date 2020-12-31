<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Title</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        Start creating your amazing application!
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->


@section('script')
    <!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    <script>

        jQuery(function ($) {
            $('.table').footable();
        });

        function cambiar(){
            var pdrs = document.getElementById('customFileLang').files[0].name;
            document.getElementById('info').innerHTML = pdrs;
        }

        function readImage (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result); // Renderizamos la imagen
                    //$('#blah').attr('class', 'img-thumbnail');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileLang").change(function () {
            // Código a ejecutar cuando se detecta un cambio de archivO
            readImage(this);
        });
    </script>
@endsection

<div class="form-group">
    <label for="exampleInputEmail1">Imagen</label>
    <div class="attachment-block clearfix">
        <img id="blah" class="attachment-img" src="{{ asset('img/img-placeholder-320x320.png') }}" alt="Attachment Image">
        <div class="attachment-pushed">
            <div class="attachment-text">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" name="imagen" class="custom-file-input" id="customFileLang" onchange='cambiar()' lang="es" accept="image/jpeg, image/png" required>
                        <label class="custom-file-label" for="customFileLang" data-browse="Elegir" id="info">Seleccionar Archivo</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



{!! Form::open(['route' => ['categorias.destroy', $categoria->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$categoria->id]) !!}
<div class="btn-group">
    @if (leerJson(Auth::user()->permisos, 'categorias.update') || Auth::user()->role == 100)
        {{--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $categoria->id }}">
            <i class="fas fa-edit"></i>
        </button>--}}
        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
    @endif
    @if (leerJson(Auth::user()->permisos, 'categorias.destroy') || Auth::user()->role == 100)
        <button type="button" class="btn btn-info show-alert-{{ $categoria->id }}"><i class="fas fa-trash"></i></button>
        <script>
            $(document).on("click", ".show-alert-{{ $categoria->id }}", function(e) {
                bootbox.confirm({
                    size: "small",
                    message: "¿Esta seguro que desea Eliminar?",
                    buttons: {
                        confirm: {
                            label: 'Si',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function(result){
                        /* result is a boolean; true = OK, false = Cancel*/
                        if (result){
                            document.getElementById('form_delete_{{ $categoria->id }}').submit();
                        }
                    }
                });
            });
        </script>
            <script>
                $(document).on("click", ".show-alert-{{ $categoria->id }}", function(e) {
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
                            document.getElementById('form_delete_{{ $categoria->id }}').submit();
                        }
                    })
                });
            </script>
    @endif
</div>
{!! Form::close() !!}
