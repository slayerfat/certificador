@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            Añadir Profesores a {{ $event->name }}
          </div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::open(
              [
                'route' => ['events.storeProfessors', $event->id],
                'method' => 'post',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('events.forms.bodyProfessors', ['submitBtn' => 'Añadir Profesores'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop