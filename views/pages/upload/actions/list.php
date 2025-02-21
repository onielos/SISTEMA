<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a class="btn bg-navy" href="/upload/new">Nuevo Archivo</a>
        </h3>
    </div>
    <div class="card-body">
        <table id="tablaArchivos" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre Archivo</th>
                    <th>Usuario</th>
                    <th>Fecha de subida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos se insertarán aquí mediante AJAX -->
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
   var table = $('#tablaArchivos').DataTable({
        "ajax": "/ajax/datatable-files.ajax.php",
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
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
        "columns": [
            { "data": 0 },
            { "data": 1 },
            { "data": 2 },
            { "data": 3 },
            { "data": 4}
        ]
    });
    
    $('#tablaArchivos tbody').on('click', 'button.btnEliminarArchivo', function() {
        var idArchivo = $(this).attr('idArchivo');
    
        ToastLib.showConfirm(
            '¿Estás seguro de que deseas eliminar este archivo?',
            () => {
                $.ajax({
                    url: '/ajax/delete-files.ajax.php',  
                    type: 'POST',
                    data: { id_archivo: idArchivo },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload();
                            ToastLib.showToast('success', response['message'] || 'Archivo eliminado con éxito');
                        } else {
                            ToastLib.showToast('error', 'Error al eliminar el archivo.');
                        }
                    },
                    error: function() {
                        ToastLib.showToast('error', 'Hubo un error con la solicitud.');
                    }
                });
            },
            () => {
                ToastLib.showToast('error', 'Acción cancelada');
            }
        );
    });
});
</script>
