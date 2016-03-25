@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Actualizar Título</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::model(
              $title,
              [
                'route' => ['titles.update', $title->id],
                'method' => 'patch',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('titles.forms.body', ['submitBtn' => 'Actualizar Título'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop