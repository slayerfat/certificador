@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Actualizar Información Profesoral</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::model(
              $professor,
              [
                'route' => ['professors.update', $professor->id],
                'method' => 'patch',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('professors.forms.body', ['submitBtn' => 'Actualizar Información Profesoral'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop