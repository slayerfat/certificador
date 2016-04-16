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