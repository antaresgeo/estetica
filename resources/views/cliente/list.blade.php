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
    <th>Identificacion</th>
    <th>Acción</th>
</tr>
@endsection

@section('tbody')
@foreach ($clientes as $cliente)
<tr>
    {{-- <td>{{ $cliente->id }}</td> --}}
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
@endsection

@section('footer')
{{ $clientes->links() }}
@endsection
