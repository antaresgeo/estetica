@extends('layouts.new.table')

@section('title', 'Usuarios')

@section('theader', 'Tabla de Usuarios')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Usuarios</li>
</ol>
@endsection

@section('pre-card')
<div class="d-flex">
    <div class="mr-auto p-2"></div>
    <a href="{{ route('user.create') }}" class="btn btn-primary p-2">Nuevo Usuario</a>
</div>
<br>
@endsection

@section('thead')
<tr>
    {{-- <th>id</th> --}}
    <th>Nombre</th>
    <th>Correo Electronico</th>
    <th >Tipo de Usuario </th>
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
        ajax: '{!! route('user.list') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'type', name: 'type', render: function ( data, type, row, meta ) {
                if(data == 'admin'){
                    return '<button class="btn btn-success">Administrador</button>';
                }else{
                    return '<button class="btn btn-info">Regular</button>';
                }
            }},
            { data: 'id', name: 'id', searchable: false, orderable: false, render: function ( data, type, row, meta ) {
                var edit = '{{ route('user.edit', ':id')}}'.replace(':id', data);
                var destroy = '{{ route('user.destroy', ':id') }}'.replace(':id', data);
                return '<a href="'+ edit +'" class="btn btn-warning" style="margin-right: 7px;"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="'+destroy+'" class="btn btn-danger" style="margin-right: 7px;"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }}
        ]
    });
});
</script>
@endpush
{{-- @section('tbody')
@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
        @if ( $user->type == 'admin')
        <button class="btn btn-success">Administrador</button>
        @else
        <button class="btn btn-info">Regular</button>
        @endif
    </td>
    <td>
        <a href="{{ route('user.edit', $user->id)}}" class="btn btn-warning">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
        <a href="{{ route('user.destroy', $user->id) }}" class="btn btn-danger">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>
@endforeach
@endsection

@section('footer')
{{ $users->links() }}
@endsection --}}
