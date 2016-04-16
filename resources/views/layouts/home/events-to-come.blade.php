<?php $count = $events->count(); ?>
@if ($count > 0)
  Actualmente
  {{ $count == 1 ? 'existe' : 'existen' }}
  {{ $count }}
  {{ $count == 1 ? 'Evento' : 'Eventos' }}
  que le
  {{ $count == 1 ? 'puede' : 'pueden' }}
  interesar.

  @foreach ($events as $event)
    @include('layouts.home.event-partial', ['event' => $event])
  @endforeach
@else
  Actualmente no hay eventos disponibles.
@endif