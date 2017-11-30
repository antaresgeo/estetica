@extends('layouts.new.card')

@section('header')
<i class="fa fa-table" aria-hidden="true"></i>
<span>@yield('theader')</span>
@endsection

@section('body')
<div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-light">
            @yield('thead')
        </thead>
        <tbody>
            @yield('tbody')
        </tbody>
    </table>
</div>
@endsection
