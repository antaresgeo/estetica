@extends('layouts.new.card')

@section('title', 'Editar tratatamiento '. $tratamiento->nombre)

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('tratamiento.index') }}">Tratamientos</a>
    </li>
    <li class="breadcrumb-item active">{{ $tratamiento->nombre }}</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span> {{ $tratamiento->nombre }}</span>
@endsection

@section('body')
{!! Form::open(['route' => ['tratamiento.update', $tratamiento], 'method' => 'PUT']) !!}
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', $tratamiento->nombre, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('cantidad', 'Cantidad de sesiones') !!}
    {!! Form::number('cantidad', $tratamiento->cantidad, ['class' => 'form-control', 'required', 'placeholder' => 'Cantidad de sesiones', 'min' => 0]) !!}
</div>
<div class="form-group">
    {!! Form::label('precio', 'Precio') !!}
    {!! Form::number('precio', $tratamiento->precio, ['class' => 'form-control', 'required', 'placeholder' => 'Precio', 'min'=> 0]) !!}
</div>
<div class="form-group">
    {!! Form::label('duracion', 'Duración (minutos)') !!}
    {!! Form::number('duracion', $tratamiento->duracion, ['class' => 'form-control', 'required', 'placeholder' => 'Duración en minutos', 'min' => 0]) !!}
</div>
<div class="form-group">
    {!! Form::label('rotativo', 'Rotativo') !!}
    {!! Form::checkbox('rotativo',  1, $tratamiento->rotativo) !!}
</div>
<div class="form-group">
    {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tratamiento.index') }}" class="btn btn-primary">Cancelar</a>
</div>
{!! Form::close() !!}
@endsection

@section('footer')
Ultima edicion {{ $tratamiento->updated_at }}
@endsection
