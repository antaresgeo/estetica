@extends('layouts.new.card')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('user.index') }}">Usuarios</a>
    </li>
    <li class="breadcrumb-item active">Nuevo Usuario</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span>Nuevo Usuario</span>
@endsection

@section('body')
{!! Form::open(['route' => 'user.store', 'method' => 'POST']) !!}
<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'require', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Correo electrinico') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'require', 'placeholder' => 'ejemplo@gmail.com']) !!}
</div>
<div class="form-group">
    {!! Form::label('password', 'Contraseña') !!}
    {!! Form::password('password', ['class' => 'form-control', 'require' , 'placeholder' => '****']) !!}
</div>
<div class="form-group">
    {!! Form::label('type', 'Tipo de Usuario') !!}
    {!! Form::select('type', ['admin' => 'Administrador', 'regular' => 'Regular'], null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
</div>
<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@endsection
