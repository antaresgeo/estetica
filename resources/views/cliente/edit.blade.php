@extends('layouts.new.card')

@section('title', 'Editar Cliente '. $cliente->nombre)

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('cliente.index') }}">Clientes</a>
    </li>
    <li class="breadcrumb-item active">{{ $cliente->nombre }}</li>
</ol>
@endsection

@section('header')
<i class="fa fa-pencil" aria-hidden="true"></i>
<span> {{ $cliente->nombre }}</span>
@endsection

@section('body')
{!! Form::open(['route' => ['cliente.update', $cliente], 'method' => 'PUT']) !!}
<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', $cliente->nombre, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono', 'Número Telefónico') !!}
    {!! Form::text('telefono', $cliente->telefono, ['class' => 'form-control', 'required', 'placeholder' => '111xxx']) !!}
</div>
<div class="form-group">
    {!! Form::label('identificacion', 'DNI') !!}
    {!! Form::text('identificacion', $cliente->identificacion,  ['class' => 'form-control', 'required' , 'placeholder' => '111xxx']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Correo electrónico') !!}
    {!! Form::email('email', $cliente->email, ['class' => 'form-control', 'required', 'placeholder' => 'ejemplo@gmail.com']) !!}
</div>
<div class="form-group">
    {!! Form::label('localidad', 'Localidad') !!}
    {!! Form::text('localidad', $cliente->localidad,['class' => 'form-control', 'required' , 'placeholder' => 'localidad']) !!}
</div>
<div class="form-group">
    {!! Form::label('facha_nacimiento', 'Fecha de nacimiento') !!}
    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
        <span class="input-group-addon" data-target="#datetimepicker1" data-toggle="datetimepicker">
            <span class="fa fa-calendar"></span>
        </span>
        {!! Form::text('facha_nacimiento', $cliente->facha_nacimiento,['class' => 'form-control  datetimepicker-input', 'required' , 'data-target' => '#datetimepicker1']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('ocupacion', 'Ocupación') !!}
    {!! Form::text('ocupacion', $cliente->ocupacion,['class' => 'form-control', 'required' , 'placeholder' => 'ocupación']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cliente.index') }}" class="btn btn-primary">Cancelar</a>
</div>
{!! Form::close() !!}
@endsection

@section('footer')
Ultima edicion {{ $cliente->updated_at }}
@endsection

@push('scripts')
<script>
$(function() {
    $('#datetimepicker1').datetimepicker({
        format:'YYYY-MM-DD',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
});
</script>
@endpush
