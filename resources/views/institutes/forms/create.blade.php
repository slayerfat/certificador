@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Crear nuevo Instituto</div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::open(
              [
                'route' => 'institutes.store',
                'method' => 'post',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('institutes.forms.body', ['submitBtn' => 'Crear Instituto'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop