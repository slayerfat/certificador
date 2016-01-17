@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Registrarse en el sistema</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
              {!! csrf_field() !!}

              <div
                class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" for="name">Seudónimo</label>

                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name"
                    value="{{ old('name') }}">

                  @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div
                class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" for="email">Correo electrónico</label>

                <div class="col-md-6">
                  <input
                    type="email"
                    class="form-control"
                    name="email" id="email"
                    value="{{ old('email') }}">

                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" for="password">Contraseña</label>

                <div class="col-md-6">
                  <input type="password" class="form-control" name="password" id="password">

                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" for="password_confirmation">Confirmar Contraseña</label>

                <div class="col-md-6">
                  <input
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    id="password_confirmation">

                  @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" for="captcha">{!! Captcha::img() !!}</label>

                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    name="captcha"
                    id="captcha">

                  @if ($errors->has('captcha'))
                    <span class="help-block">
                      <strong>{{ $errors->first('captcha') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-user"></i>Registrarse
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
