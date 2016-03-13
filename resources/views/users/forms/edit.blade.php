@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Actualizar Usuario</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::model(
              $user,
              [
                'route' => ['users.update', $user->id],
                'method' => 'patch',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('users.forms.body', ['submitBtn' => 'Actualizar Usuario'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop