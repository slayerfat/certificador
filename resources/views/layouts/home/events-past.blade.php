@if ($user->personalDetails && $user->personalDetails->events)
  @if ($user->personalDetails->events()->inactive()->get()->isEmpty())
    Ud. no esta relacionado a ningún evento pasado en nuestros
    registros.
  @else
    Ud. participó en los siguientes eventos:
    @foreach ($user->personalDetails->events()->inactive()->get() as $event)
      @include('layouts.home.event-partial', ['event' => $event])
    @endforeach
  @endif
@else
  Ud. no esta relacionado a ningún evento pasado en nuestros registros.
@endif