@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Información</div>

          <div class="panel-body">
            @if ($events->count() > 0)
              Actualmente
              {{ $events->count() == 1 ? 'existe' : 'existen' }}
              {{ $events->count() }}
              {{ $events->count() == 1 ? 'Evento' : 'Eventos' }}
              que le
              {{ $events->count() == 1 ? 'puede' : 'pueden' }}
              interesar.

              @foreach ($events as $event)
                <p>
                  {{ link_to_route('events.show', $event->name, $event->id) }},
                  {{ Date::parse($event->date)->format('l j F \d\e Y') }},
                  {{ Date::parse($event->date)->diffForHumans() }}.
                  relacionado con
                  {{ link_to_route('events.show', $event->institute->name, $event->institute->id) }}
                  .
                </p>
              @endforeach
            @else
              Actualmente no hay eventos disponibles.
            @endif

            <hr>

            @if ($user->personalDetails->events()->active()->get()->isEmpty())
              Ud. no esta relacionado a ningún evento por venir.
            @else
              Eventos en los que Ud. esta relacionado:
              @foreach ($user->personalDetails->events()->active()->get() as $event)
                <p>
                  {{ link_to_route('events.show', $event->name, $event->id) }},
                  {{ Date::parse($event->date)->format('l j F \d\e Y') }},
                  {{ Date::parse($event->date)->diffForHumans() }}.
                  relacionado con
                  {{ link_to_route('events.show', $event->institute->name, $event->institute->id) }}
                  .
                  @if ($event->pivot->approved)
                    <span class="text-danger">Ud. no esta aprobado para este evento</span>
                  @endif
                </p>
              @endforeach
            @endif

            <hr>

            @if ($user->personalDetails->events()->inactive()->get()->isEmpty())
              Ud. no esta relacionado a ningún evento pasado en nuestros
              registros.
            @else
              Ud. participó en los siguientes eventos:
              @foreach ($user->personalDetails->events()->inactive()->get() as $event)
                <p>
                  {{ link_to_route('events.show', $event->name, $event->id) }},
                  {{ Date::parse($event->date)->format('l j F \d\e Y') }},
                  {{ Date::parse($event->date)->diffForHumans() }}.
                  relacionado con
                  {{ link_to_route('events.show', $event->institute->name, $event->institute->id) }}
                  .
                </p>
              @endforeach
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
