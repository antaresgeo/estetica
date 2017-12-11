@extends('layouts.new.auth')

@section('content')
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Inico</div>
        <div class="card-body">
            <form  method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="exampleInputEmail1">Correo electronico</label>
                    <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Correo" requiredd autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Contraseña" requiredd>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox">
                            Remember Password
                        </label>
                    </div>
                </div> -->
                <button class="btn btn-primary btn-block" type="submit">Iniciar</button>
            </form>
            <div class="text-center">
                <!-- <a class="d-block small mt-3" href="register.html">Register an Account</a> -->
                <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
            </div>
        </div>
    </div>
</div>
