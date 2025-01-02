@extends('back.layouts.app')

@section('content')

<user-index
    :users="{{ $users }}"
    :roles="{{ $roles }}"
></user-index>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        table = $("#dt_users").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": true,
            "ordering": false,
            "language": {
                "zeroRecords": "No se encontraron resultados",
                "search": "Buscar:",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                // "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                // "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "info": "",
                "infoEmpty": "",
            }

            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
