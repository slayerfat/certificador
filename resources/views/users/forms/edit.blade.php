@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Actualizar Usuario</div>
          <div class="panel-body">
            {!! Form::model(
              $user,
              [
                'route' => ['users.edit', $user->id],
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