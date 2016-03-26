@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Actualizar Evento</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::model(
              $event,
              [
                'route' => ['events.update', $event->id],
                'method' => 'patch',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('events.forms.body', ['submitBtn' => 'Actualizar Evento'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop