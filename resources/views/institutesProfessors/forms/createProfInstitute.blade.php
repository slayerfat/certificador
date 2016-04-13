@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            Añadir Profesor a la institución {{ $institute->name }}
          </div>
          <div class="panel-body">
            @include('errors.bag')
            {!! Form::open(
              [
                'route' => ['institutesProfessors.storeProfInst', $institute->id],
                'method' => 'post',
                'class'  => 'form-horizontal',
              ]
            ) !!}
            @include('institutesProfessors.forms.bodyLeadInstitute', [
              'submitBtn' => 'Añadir Profesor a la institución'
            ])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop