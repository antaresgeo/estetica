@extends('layouts.new.base')

@section('content')
@yield('pre-card')
<div class="card mb-3">
    <div class="card-header">
        @yield('header')
    </div>
    <div class="card-body">
        @yield('body')
    </div>
    <div class="card-footer small">
        @yield('footer')
    </div>
</div>
@endsection
