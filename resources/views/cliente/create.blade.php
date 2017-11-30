@extends('layouts.new.card')

@section('title', 'Nuevo Cliente ')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('cliente.index') }}">Clientes</a>
    </li>
    <li class="breadcrumb-item active">Nuevo Cliente</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span>Nuevo Cliente</span>
@endsection

@section('body')
{!! Form::open(['route' => 'cliente.store', 'method' => 'POST']) !!}
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'require', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono', 'Numero Telefonico') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control', 'require', 'placeholder' => '111xxx']) !!}
</div>
<div class="form-group">
    {!! Form::label('identificacion', 'Identificacion') !!}
    {!! Form::text('identificacion', null,['class' => 'form-control', 'require' , 'placeholder' => '111xxx']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@endsection
