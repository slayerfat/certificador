<p>
  {{ link_to_route('events.show', $event->name, $event->id) }},
  {{ Date::parse($event->date)->format('l j F \d\e Y') }},
  {{ Date::parse($event->date)->diffForHumans() }}.
  relacionado con
  {{ link_to_route('institutes.show', $event->institute->name, $event->institute->id) }}
  .
  @if (isset($approved))
    @if ($event->pivot->approved)
      <span class="text-danger">Ud. no esta aprobado para este evento</span>
    @endif
  @endif
</p>