@extends('layouts.new.card')

@section('title', 'Editar usuario '. $user->name)

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('user.index') }}">Usuarios</a>
    </li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span> {{ $user->name }}</span>
@endsection

@section('body')
{!! Form::open(['route' => ['user.update', $user], 'method' => 'PUT']) !!}
<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', $user->name, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Correo electrónico') !!}
    {!! Form::email('email', $user->email, ['class' => 'form-control', 'required', 'placeholder' => 'ejemplo@gmail.com']) !!}
</div>
<div class="form-group">
    {!! Form::label('type', 'Tipo de Usuario') !!}
    {!! Form::select('type', ['admin' => 'Administrador', 'regular' => 'Regular'], $user->type, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
</div>
<div class="form-group">
    {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('user.index') }}" class="btn btn-primary">Cancelar</a>
</div>
{!! Form::close() !!}
@endsection

@section('footer')
Ultima edicion {{ $user->updated_at }}
@endsection
