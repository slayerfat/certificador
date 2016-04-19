<?php
if ($user->personalDetails && $user->personalDetails->events) {
  $isPersonalEmpty = $user
    ->personalDetails
    ->events()
    ->active()
    ->get()
    ->isEmpty();

  if ($user->personalDetails->professor) {
    $isProfessorEmpty = $user
      ->personalDetails
      ->professor
      ->events()
      ->active()
      ->get()
      ->isEmpty();
  } else {
    $isProfessorEmpty = true;
  }
} else {
  $isProfessorEmpty = $isPersonalEmpty = true;
}
?>
@if ($isPersonalEmpty && $isProfessorEmpty)
  Ud. no esta relacionado a ningún evento por venir.
@else
  @unless ($isProfessorEmpty)
    Eventos relacionados en los que Ud. participa como Profesor/Ponente u otro:
    @foreach ($user->personalDetails->professor->events()->active()->get() as $event)
      @include('layouts.home.event-partial', ['event' => $event])
    @endforeach
  @endunless

  @unless ($isPersonalEmpty)
    Eventos en los que Ud. esta relacionado como participante:
    @foreach ($user->personalDetails->events()->active()->get() as $event)
      <p>
        @include('layouts.home.event-partial', ['event' => $event, 'approved' => true])
      </p>
    @endforeach
  @endunless
@endif