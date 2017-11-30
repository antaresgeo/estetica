@extends('layouts.new.card')

@section('title', 'Editar Cliente '. $cliente->nombre)

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('cliente.index') }}">Clientes</a>
    </li>
    <li class="breadcrumb-item active">{{ $cliente->nombre }}</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span> {{ $cliente->nombre }}</span>
@endsection

@section('body')
{!! Form::open(['route' => ['cliente.update', $cliente], 'method' => 'PUT']) !!}
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', $cliente->nombre, ['class' => 'form-control', 'require', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono', 'Numero Telefonico') !!}
    {!! Form::text('telefono', $cliente->telefono, ['class' => 'form-control', 'require', 'placeholder' => '111xxx']) !!}
</div>
<div class="form-group">
    {!! Form::label('identificacion', 'Identificacion') !!}
    {!! Form::text('identificacion', $cliente->identificacion,  ['class' => 'form-control', 'require' , 'placeholder' => '111xxx']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@endsection

@section('footer')
Ultima edicion {{ $cliente->updated_at }}
@endsection
