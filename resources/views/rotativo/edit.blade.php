@extends('layouts.new.card')

@section('title','Editar Asignación')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('rotativo.index') }}">Tratamientos Rotativos</a>
    </li>
    <li class="breadcrumb-item active">{{ $rotativo->sucursal->nombre }} - {{$rotativo->tratamiento->nombre}} - {{$rotativo->profesional}}</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span>Nueva Asignación de Tratamientos Rotativos</span>
@endsection

@section('body')
{!! Form::open(['route' => ['rotativo.update', $rotativo], 'method' => 'PUT']) !!}
<div class="form-group">
    {!! Form::label('sucursal_id', 'Sucursal') !!}
    {!! Form::select('sucursal_id', $sucursales, $rotativo->sucursal_id, ['class' => 'form-control', 'placeholder' => '----']) !!}
</div>
<div class="form-group">
    {!! Form::label('tratamiento_id', 'Tratamiento') !!}
    {!! Form::select('tratamiento_id', $tratamientos, $rotativo->tratamiento_id, ['class' => 'form-control', 'placeholder' => '----']) !!}
</div>
<div class="form-group">
    {!! Form::label('profesional', 'Profesional') !!}
    {!! Form::text('profesional', $rotativo->profesional,['class' => 'form-control', 'required' , 'placeholder' => 'nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('lunes', 'Lunes') !!}
    {!! Form::checkbox('lunes', 'yes', $rotativo->lunes) !!}
    <span style="margin-right:7px;"></span>
    {!! Form::label('martes', 'Martes') !!}
    {!! Form::checkbox('martes', 'yes', $rotativo->martes) !!}
    <span style="margin-right:7px;"></span>
    {!! Form::label('miercoles', 'Miercoles') !!}
    {!! Form::checkbox('miercoles', 'yes', $rotativo->miercoles) !!}
    <span style="margin-right:7px;"></span>
    {!! Form::label('jueves', 'Jueves') !!}
    {!! Form::checkbox('jueves', 'yes', $rotativo->jueves) !!}
    <span style="margin-right:7px;"></span>
    {!! Form::label('viernes', 'Viernes') !!}
    {!! Form::checkbox('viernes', 'yes', $rotativo->viernes) !!}
    <span style="margin-right:7px;"></span>
    {!! Form::label('sabado', 'Sabado') !!}
    {!! Form::checkbox('sabado', 'yes', $rotativo->sabado) !!}
    <span style="margin-right:7px;"></span>
    {!! Form::label('domingo', 'Domingo') !!}
    {!! Form::checkbox('domingo', 'yes', $rotativo->domingo) !!}
</div>
<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cliente.index') }}" class="btn btn-primary">Cancelar</a>
</div>
{!! Form::close() !!}
@endsection
