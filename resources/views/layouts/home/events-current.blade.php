@if ($user->personalDetails->events()->active()->get()->isEmpty() && $user->personalDetails->professor->events()->active()->get()->isEmpty())
  Ud. no esta relacionado a ningún evento por venir.
@else
  @unless ($user->personalDetails->professor->events()->active()->get()->isEmpty())
    Eventos relacionados en los que Ud. participa como Profesor/Ponente u otro:
    @foreach ($user->personalDetails->professor->events()->active()->get() as $event)
      <p>
        {{ link_to_route('events.show', $event->name, $event->id) }},
        {{ Date::parse($event->date)->format('l j F \d\e Y') }},
        {{ Date::parse($event->date)->diffForHumans() }}.
        relacionado con
        {{ link_to_route('events.show', $event->institute->name, $event->institute->id) }}
        .
      </p>
    @endforeach
  @endunless

  @unless ($user->personalDetails->events()->active()->get()->isEmpty())
    Eventos en los que Ud. esta relacionado como participante:
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
  @endunless
@endif