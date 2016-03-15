@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Crear nuevo Usuario</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::open(
              [
                'route' => 'users.store',
                'method' => 'post',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('users.forms.body', ['submitBtn' => 'Crear Usuario'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop