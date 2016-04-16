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