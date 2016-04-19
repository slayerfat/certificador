<hr>

@if (Auth::user()->personalDetails)
  @if (!Auth::user()->personalDetails->events()->where('id', $event->id)->first())
    <a href="{{ route('events.createAttendantFromSelf', $event->id) }}"
       class="btn btn-default">
      <i class="fa fa-btn fa-plus"></i>Solicitar Participación
    </a>
  @else
    @if (Auth::user()->personalDetails->events()->where('id', $event->id)->first()->pivot->approved)
      <h2 class="text-success">Ud. esta participando en este evento.</h2>
      <a
        class="btn btn-default"
        href="{{ route('events.showPdf', [Auth::user()->personalDetails->id, $event->id]) }}"
        title="Ver Certificado">
        <i class="fa fa-btn fa-file-pdf-o"></i>Generar Certificado
      </a>
    @else
      <h2 class="text-warning">
        Ud. esta participando en este evento, pero no ha sido aun aprobado.
      </h2>
    @endif
  @endif
@endif

@if (Auth::user()->admin)
  <a href="{{ route('events.createProfessors', $event->id) }}"
     class="btn btn-default">
    <i class="fa fa-btn fa-plus"></i>Asignar Profesores
  </a>

  <a href="{{ route('events.createAttendants', $event->id) }}"
     class="btn btn-default">
    <i class="fa fa-btn fa-plus"></i>Asignar Participantes
  </a>
@endif