@extends('layouts.new.card')

@section('title', 'Editar tratatamiento ')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('tratamiento.index') }}">Tratamientos</a>
    </li>
    <li class="breadcrumb-item active"></li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span></span>
@endsection

@section('body')
{!! Form::open(['route' => ['reserva.update', null], 'method' => 'PUT']) !!}
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('cantidad', 'Cantidad de sesiones') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control', 'required', 'placeholder' => 'Cantidad de sesiones']) !!}
</div>
<div class="form-group">
    {!! Form::label('precio', 'Precio') !!}
    {!! Form::number('precio', null, ['class' => 'form-control', 'required', 'placeholder' => 'Precio', 'min' => 0]) !!}
</div>
<div class="form-group">
    {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@endsection

@section('footer')
Ultima edicion
@endsection
