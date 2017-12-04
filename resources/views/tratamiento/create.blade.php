@extends('layouts.new.card')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('tratamiento.index') }}">Tratamientos</a>
    </li>
    <li class="breadcrumb-item active">Nuevo Tratamiento</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span>Nuevo Tratamiento</span>
@endsection

@section('body')
{!! Form::open(['route' => 'tratamiento.store', 'method' => 'POST']) !!}
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'require', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('cantidad', 'Cantidad de sesiones') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control', 'require', 'placeholder' => 'Cantidad de sesiones']) !!}
</div>
<div class="form-group">
    {!! Form::label('precio', 'Precio') !!}
    {!! Form::number('precio', null, ['class' => 'form-control', 'require', 'placeholder' => 'Precio']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@endsection
