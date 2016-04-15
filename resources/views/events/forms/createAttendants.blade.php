@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            Añadir Participantes a {{ $event->name }}
          </div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::open(
              [
                'route' => ['events.storeAttendants', $event->id],
                'method' => 'post',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('events.forms.bodyAttendants', ['submitBtn' => 'Añadir Participantes'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop