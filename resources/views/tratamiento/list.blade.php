@extends('layouts.new.table')

@section('title', 'Tratamientos')

@section('theader', 'Tabla de Tratamientos')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Tratamientos</li>
</ol>
@endsection

@section('pre-card')
<div class="d-flex">
    <div class="mr-auto p-2"></div>
    <a href="{{ route('tratamiento.create') }}" class="btn btn-primary p-2">Nuevo Tratamiento</a>
</div>
<br>
@endsection

@section('thead')
<tr>
    {{-- <th>id</th> --}}
    <th>Nombre</th>
    <th>Cantidad de Sesiones</th>
    <th>Precio</th>
    <th>Duración</th>
    {{-- <th>Rotativo</th> --}}
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
            "url": "{{ asset('js/Spanish.json') }}"
        },
        ajax: '{!! route('tratamiento.list') !!}',
        columns: [
            { data: 'nombre', name: 'nombre' },
            { data: 'cantidad', name: 'cantidad' },
            { data: 'precio', name: 'precio' },
            { data: 'duracion', name: 'duracion'},
            { data: 'id', name: 'id', searchable: false, orderable: false, render: function ( data, type, row, meta ) {
                var edit = '{{ route('tratamiento.edit', ':id')}}'.replace(':id', data);
                var destroy = '{{ route('tratamiento.destroy', ':id') }}'.replace(':id', data);
                return '<a href="'+ edit +'" class="btn btn-warning" style="margin-right: 7px;"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="'+destroy+'" class="btn btn-danger" style="margin-right: 7px;"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }}
        ]
    });
});
</script>
@endpush

{{-- @section('tbody')
@foreach ($tratamientoes as $tratamiento)
<tr>
    <td>{{ $tratamiento->id }}</td>
    <td>{{ $tratamiento->nombre }}</td>
    <td>
        <a href="{{ route('tratamiento.edit', $tratamiento->id)}}" class="btn btn-warning">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
        <a href="{{ route('tratamiento.destroy', $tratamiento->id) }}" class="btn btn-danger">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>
@endforeach
@endsection --}}

{{-- @section('footer')
{{ $tratamientoes->links() }}
@endsection --}}
