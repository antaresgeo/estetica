@extends('layouts.new.base')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="/estetica/public/reserva/create" class="btn btn-primary p-2">Nueva reserva</a>
            </div>
            <br>  
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div id="calendar"></div>
    </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.min.css') }}">
@endpush
@push('scripts')
<script type="text/javascript" src="{{ asset('fullcalendar/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/fullcalendar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/locale-all.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/calendario.js') }}"></script>
@endpush
