@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Añadir Información Personal</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::open(
              [
                'route' => ['personalDetails.store', $user->id],
                'method' => 'post',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('personalDetails.forms.body', ['submitBtn' => 'Añadir Información Personal'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop