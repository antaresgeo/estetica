@extends('layouts.new.card')

@section('title', 'Editar usuario '. $sucursal->nombre)

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('sucursal.index') }}">Sucursales</a>
    </li>
    <li class="breadcrumb-item active">{{ $sucursal->nombre }}</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span> {{ $sucursal->nombre }}</span>
@endsection

@section('body')
{!! Form::open(['route' => ['sucursal.update', $sucursal], 'method' => 'PUT']) !!}
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', $sucursal->nombre, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sucursal.index') }}" class="btn btn-primary">Cancelar</a>
</div>
{!! Form::close() !!}
@endsection

@section('footer')
Ultima edicion {{ $sucursal->updated_at }}
@endsection
