@extends('layouts.new.table')

@section('title', 'Clientes')

@section('theader', 'Tabla de Clientes')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Clientes</li>
</ol>
@endsection

@section('pre-card')
<div class="d-flex">
    <div class="mr-auto p-2"></div>
    <a href="{{ route('cliente.create') }}" class="btn btn-primary p-2">Nuevo Cliente</a>
</div>
<br>
@endsection

@section('thead')
<tr>
    {{-- <th>id</th> --}}
    <th>Nombre</th>
    <th>Telefono</th>
    <th>DNI</th>
    <th>Correo electrónico</th>
    {{-- <th>Localidad</th> --}}
    <th>Fecha de nacimiento</th>
    {{-- <th>Ocupación</th> --}}
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
        ajax: '{!! route('cliente.list') !!}',
        columns: [
            { data: 'nombre', name: 'nombre' },
            { data: 'telefono', name: 'telefono' },
            { data: 'identificacion', name: 'identificacion' },
            { data: 'email', name: 'email'},
            // { data: 'localidad', name: 'localidad'},
            { data: 'fecha_nacimiento', name: 'fecha_nacimiento'},
            // { data: 'ocupacion', name: 'ocupacion'},
            { data: 'id', name: 'id', searchable: false, orderable: false, render: function ( data, type, row, meta ) {
                var edit = '{{ route('cliente.edit', ':id')}}'.replace(':id', data);
                var destroy = '{{ route('cliente.destroy', ':id') }}'.replace(':id', data);
                return '<a href="'+ edit +'" class="btn btn-warning" style="margin-right: 7px;"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="'+destroy+'" class="btn btn-danger" style="margin-right: 7px;"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }}
        ]
    });
});
</script>
@endpush

{{-- @section('tbody')
@foreach ($clientes as $cliente)
<tr>
    <td>{{ $cliente->id }}</td>
    <td>{{ $cliente->nombre }}</td>
    <td>{{ $cliente->telefono }}</td>
    <td>{{ $cliente->identificacion }}</td>
    <td>
        <a href="{{ route('cliente.edit', $cliente->id)}}" class="btn btn-warning">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
        <a href="{{ route('cliente.destroy', $cliente->id) }}" class="btn btn-danger">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>
@endforeach
@endsection --}}

{{-- @section('footer')
{{ $clientes->links() }}
@endsection --}}
