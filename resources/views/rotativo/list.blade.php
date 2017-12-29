@extends('layouts.new.table')

@section('title', 'Tratamientos Rotativos')

@section('theader', 'Tratamientos Rotativos')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Tratamientos Rotativos</li>
</ol>
@endsection

@section('pre-card')
<div class="d-flex">
    <div class="mr-auto p-2"></div>
    <a href="{{ route('rotativo.create') }}" class="btn btn-primary p-2">Nueva Asignación</a>
</div>
<br>
@endsection

@section('thead')
<tr>
    <th>Sucursal</th>
    <th>Tratamiento</th>
    <th>Profesional</th>
    <th>Fechas</th>
    <th>Acción</th>
</tr>
@endsection

@push('scripts')
<script>
$(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        language: {
            url: '{{ asset('js/Spanish.json') }}'
        },
        ajax: '{!! route('rotativo.list') !!}',
        columns: [
            { data: 'sucursal_id', name: 'sucursal_id', render: function ( data, type, row, meta ) {
                return row.sucursal_nombre;
            }},
            { data: 'tratamiento_id', name: 'tratamiento_id', render: function ( data, type, row, meta ) {
                return row.tratatamiento_nombre;
            }},
            { data: 'profesional', name: 'profesional' },
            { data:'fechas', searchable: false, orderable: false},
            { data: 'id', name: 'id', searchable: false, orderable: false, render: function ( data, type, row, meta ) {
                var edit = '{{ route('rotativo.edit', ':id')}}'.replace(':id', data);
                var destroy = '{{ route('rotativo.destroy', ':id') }}'.replace(':id', data);
                console.log(destroy);
                return '<a href="'+ edit +'" class="btn btn-warning" style="margin-right: 7px;"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="'+destroy+'" class="btn btn-danger" style="margin-right: 7px;"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }}
        ]
    });
});
function renderbool( data, type, row, meta ) {
    return data===0?'No':'Si';
}
</script>
@endpush
