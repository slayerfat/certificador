@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Crear nuevo Título Descriptivo</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::open(
              [
                'route' => 'titles.store',
                'method' => 'post',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('titles.forms.body', ['submitBtn' => 'Crear Título Descriptivo'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop