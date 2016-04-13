@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            Añadir a Institución
          </div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::open(
              [
                'route' => ['institutesProfessors.storeNoLeadFromProfToInst', $professor->id],
                'method' => 'post',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('institutesProfessors.forms.bodyLeadProfessor', ['submitBtn' => 'Añadir a Institución'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop