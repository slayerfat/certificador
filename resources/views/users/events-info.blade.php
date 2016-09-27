@if($user->personalDetails && $user->personalDetails->events)
  <hr>

  <h1>Eventos asociados</h1>

  @include('events.table', ['events' => $user->personalDetails->events])
@endif
