@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Información de eventos</div>
          <div class="panel-body">
            @include('layouts.home.events-to-come')
            <hr>
            @include('layouts.home.events-current')
            <hr>
            @include('layouts.home.events-past')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
