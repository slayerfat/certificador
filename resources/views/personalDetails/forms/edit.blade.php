@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Actualizar Información Personal</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::model(
              $details,
              [
                'route' => ['personalDetails.update', $details->id],
                'method' => 'patch',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('personalDetails.forms.body', ['submitBtn' => 'Actualizar Información Personal'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop