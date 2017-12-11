@extends('layouts.new.card')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('reserva.index') }}">Reservas</a>
    </li>
    <li class="breadcrumb-item active">Nueva Reserva</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span>Nueva Reserva</span>
@endsection

@section('body')
{!! Form::open(['route' => 'reserva.store', 'method' => 'POST']) !!}
<div class="form-group">
    {!! Form::label('hora', 'Hora') !!}
    <input type="hidden" name="cliente_tratamiento_id" value="">
    {!! Form::date('hora', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('sucursal_id', 'Sucursal') !!}
    {!! Form::select('sucursal_id', $sucursales, null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
</div>
<div class="form-group">
    {!! Form::label('user_id', 'Profecional') !!}
    {!! Form::select('user_id', $profecionales, null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
</div>
<div class="form-group">
    {!! Form::label('cliente_id', 'Profecional') !!}
    {!! Form::select('cliente_id', $profecionales, null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
</div>
<div class="form-group">
    {!! Form::label('estado', 'Estado') !!}
    {!! Form::select('estado', ['pendiente' => 'Pendiente', 'realizada' => 'Realizada', 'cancelada' => 'Cancelada'], null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
</div>
<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@endsection
