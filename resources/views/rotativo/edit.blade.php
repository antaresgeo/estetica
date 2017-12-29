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
    {!! Form::label('datetimepicker10', 'Fecha de nacimiento') !!}
    <div class="input-group date">
        <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
        </span>
        {!! Form::text('fechas', $rotativo->val_fechas,['class' => 'form-control', 'required', 'readonly', 'id' => 'datetimepicker10']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cliente.index') }}" class="btn btn-primary">Cancelar</a>
</div>
{!! Form::close() !!}
@endsection

@push('scripts')
<script>
    $(function() {
        $('#datetimepicker10').datepicker({
            startDate: new Date(),
            multidate: true,
            format: 'yyyy-mm-dd',
            language:  'es'
        });
    });
</script>
@endpush
