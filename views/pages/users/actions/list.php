<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a class="btn bg-navy" href="/users/new">Nuevo Usuario</a>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="tablaUsuarios" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Último Login</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos se insertarán aquí mediante AJAX -->
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
$(document).ready(function() {
   var table = $('#tablaUsuarios').DataTable({
        "ajax": "/ajax/datatable-users.ajax.php",
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "processing": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
        "columns": [
            { "data": 0 }, // Índice o número de fila
            { "data": 1 }, // Foto
            { "data": 2 }, // Nombre
            { "data": 3 }, // Usuario
            { "data": 4 }, // Contraseña
            { "data": 5 }, // Rol
            { "data": 6 }, // Estado
            { "data": 7 }  // Acciones
        ]
    });
    // eliminar usuario
    $('#tablaUsuarios tbody').on('click', 'button.btnEliminarUsuario', function() {
    var idUser = $(this).attr('idUsuario');
    
    ToastLib.showConfirm(
        '¿Estás seguro de que deseas eliminar este usuario?',
        () => {
            
            $.ajax({
                url: '/ajax/delete-users.ajax.php',  
                type: 'POST',
                data: { id_user: idUser },
                success: function(response) {
                    if (response.success) {
                        table.ajax.reload();  // Recargar la tabla con la nueva información
                        ToastLib.showToast('success', response['message'] || 'Plan eliminado con éxito');
                    } else {
                        ToastLib.showToast('error', 'Error al eliminar el plan.');
                    }
                },
                error: function() {
                    ToastLib.showToast('error', 'Hubo un error con la solicitud.');
                }
            });
        },
        () => {
            // Acción en caso de que el usuario cancele la operación
            ToastLib.showToast('error', 'Acción cancelada');
        }
    );
});
});
</script>
