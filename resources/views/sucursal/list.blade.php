@extends('layouts.new.table')

@section('title', 'Sucursales')

@section('theader', 'Tabla de Sucursales')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Sucursales</li>
</ol>
@endsection

@section('pre-card')
<div class="d-flex">
    <div class="mr-auto p-2"></div>
    <a href="{{ route('sucursal.create') }}" class="btn btn-primary p-2">Nueva Sucursal</a>
</div>
<br>
@endsection

@section('thead')
<tr>
    {{-- <th>id</th> --}}
    <th>Nombre</th>
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
        ajax: '{!! route('sucursal.list') !!}',
        columns: [
            { data: 'nombre', name: 'nombre' },
            { data: 'id', name: 'id', searchable: false, orderable: false, render: function ( data, type, row, meta ) {
                var edit = '{{ route('sucursal.edit', ':id')}}'.replace(':id', data);
                var destroy = '{{ route('sucursal.destroy', ':id') }}'.replace(':id', data);
                return '<a href="'+ edit +'" class="btn btn-warning" style="margin-right: 7px;"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="'+destroy+'" class="btn btn-danger" style="margin-right: 7px;"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }}
        ]
    });
});
</script>
@endpush

{{-- @section('tbody')
@foreach ($sucursales as $sucursal)
<tr>
    <td>{{ $sucursal->id }}</td>
    <td>{{ $sucursal->nombre }}</td>
    <td>
        <a href="{{ route('sucursal.edit', $sucursal->id)}}" class="btn btn-warning">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
        <a href="{{ route('sucursal.destroy', $sucursal->id) }}" class="btn btn-danger">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>
@endforeach
@endsection --}}

{{-- @section('footer')
{{ $sucursales->links() }}
@endsection --}}
