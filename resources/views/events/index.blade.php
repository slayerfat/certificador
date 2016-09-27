@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Eventos en el sistema</h1>

    @if (Auth::user()->admin)
      <a href="{{ route('events.create') }}" class="btn btn-default">
        <i class="fa fa-btn fa-plus"></i>Crear Evento
      </a>
    @endif

    <hr/>

    <div class="row">
      <div class="col-sm-12">
        @include('events.table')
      </div>
    </div>
  </div>
@stop
