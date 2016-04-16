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

    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Información de administrador</div>
          <div class="panel-body">
            Existen actualmente
            {{
            $activeEvents->count() == 1 ?
            '1 Evento:' : $activeEvents->count() == 0 ?
            'cero Eventos que requieran su atención.' : $activeEvents->count() . " Eventos:"
            }}
            @foreach ($activeEvents as $event)
              @include('layouts.home.event-partial', ['event' => $event])
              <p>
                Este evento tiene
                {{ $event->attendants->count() }}
                Participantes y
                {{ $event->professors->count() }}
                Profesores/Ponentes u otros relacionados.
              </p>
              <?php $toApprove = $event->attendants()
                                       ->where('approved', false)
                                       ->get(); ?>
              @if ($toApprove)
                Existen
                {{ $toApprove->count() }}
                Participates que requieren su atención, para ser o no aprobados.
                @foreach ($toApprove as $personalDetails)
                  {{ link_to_route('users.show', $personalDetails->formattedNames(), $personalDetails->user->name) }}
                @endforeach
              @endif

              <hr>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
