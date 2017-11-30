@extends('layouts.new.card')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('sucursal.index') }}">Sucursales</a>
    </li>
    <li class="breadcrumb-item active">Nueva Sucursal</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span>Nueva Sucursal</span>
@endsection

@section('body')
{!! Form::open(['route' => 'sucursal.store', 'method' => 'POST']) !!}
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'require', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@endsection
