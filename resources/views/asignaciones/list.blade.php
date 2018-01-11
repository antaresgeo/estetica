@extends('layouts.new.table')

@section('title', 'Tratamientos Asignados')

@section('theader', 'Tabla de Tratamientos Asignados')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Tratamientos Asignados</li>
</ol>
@endsection

@section('thead')
<tr>
    {{-- <th>id</th> --}}
    <th>Cliente</th>
    <th>Tratamiento</th>
    <th>Fecha de Creación</th>
    <th>Borrar</th>
</tr>
@endsection

@push('scripts')
<script>
$(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        language: {
            "url": "{{ asset('js/Spanish.json') }}"
        },
        ajax: '{!! route('asignacion.list') !!}',
        columns: [
            { data: 'cliente_nombre', name: 'cliente.nombre' },
            { data: 'tratamiento_nombre', name: 'tratamiento.nombre' },
            { data: 'created_at', name: 'created_at'},
            { data: 'id', name: 'id', searchable: false, orderable: false, render: function ( data, type, row, meta ) {
                var destroy = '{{ route('asignacion.destroy', ':id') }}'.replace(':id', data);
                return '<a  href="'+destroy+'" class="asignacion btn btn-danger" style="margin-right: 7px;"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }}
        ],
        drawCallback: function(settings) {
            $('.asignacion').click(function(event) {
                return confirm("Al borrar esta asignación se borrará toda la información relacionada con esta, incluyendo reservas y saldos, está seguro de borrar esta asignación?");
            });
        }
    });

});
</script>
@endpush
