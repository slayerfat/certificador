@if(Auth::user()->admin && $user->personalDetails && !$user->personalDetails->professor)
  <a href="{{ route('professors.create', $user->personalDetails->id) }}"
     class="btn btn-default"
  >
    <i class="fa fa-btn fa-plus"></i>Crear información Profesoral
  </a>
@endif

@if ($user->personalDetails && $user->personalDetails->professor)
  @if (Auth::user()->isOwnerOrAdmin($user->id))
    <a href="{{ route("professors.edit", $user->personalDetails->professor->id) }}"
       class="btn btn-default">
      <i class="fa fa-btn fa-edit"></i>Editar información Profesoral
    </a>
    <a href="#"
       onclick="deleteResourceFromAnchor({{ $user->personalDetails->professor->id }})"
       class="btn btn-danger">
      <i class="fa fa-btn fa-times"></i>Eliminar información Profesoral
    </a>
  @endif

  @foreach ($user->personalDetails->professor->institutes as $institute)
    <h2>
      {{ $institute->pivot->leads ? 'Encargado' : 'Miembro' }} de:
      <a href="{{ route('institutes.show', $institute->id) }}">
        {{ $institute->name }}
      </a>

      <br>

      {{ $institute->pivot->position }}
    </h2>
  @endforeach

  @if (Auth::user()->admin)
    <a
      href="{{ route("institutesProfessors.createLeadFromProfToInst", $user->personalDetails->professor->id) }}"
      class="btn btn-default">
      <i class="fa fa-btn fa-plus"></i>Asignar como líder a Institución
    </a>
    <a
      href="{{ route("institutesProfessors.createNoLeadFromProfToInst", $user->personalDetails->professor->id) }}"
      class="btn btn-default">
      <i class="fa fa-btn fa-plus"></i>Asignar a Institución
    </a>
  @endif
@endif

@if ($user->personalDetails && $user->personalDetails->professor)
  {!! Form::open(['route' => ["professors.destroy", $user->personalDetails->professor->id], 'method' => 'DELETE', 'id' => $user->personalDetails->professor->id]) !!}

  {!! Form::close() !!}
@endif