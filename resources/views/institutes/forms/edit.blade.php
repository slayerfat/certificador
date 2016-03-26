@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Actualizar Instituto</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::model(
              $institute,
              [
                'route' => ['institutes.update', $institute->id],
                'method' => 'patch',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('institutes.forms.body', ['submitBtn' => 'Actualizar Instituto'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop