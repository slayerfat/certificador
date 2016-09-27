@if ($user->personalDetails)
  <hr>

  <h2>
    Fecha de nacimiento:
    {{ Date::parse($user->personalDetails->birthday)->format('l j F \d\e Y') }}
  </h2>

  <h1>C.I. {{ $user->personalDetails->ci }}</h1>

  <h2>
    @if ($user->personalDetails && $user->personalDetails->professor)
      {{ $user->personalDetails->professor->title->desc }}
    @else
      {{ $user->personalDetails->title->desc }}
    @endif
    {{$user->personalDetails->formattedNames(true)}}
  </h2>

  <h3>
    Teléfonos: <br/>

    {{$phoneParser->parseNumber($user->personalDetails->phone)}}

    <br/>

    {{$phoneParser->parseNumber($user->personalDetails->cellphone)}}
  </h3>

  @can('update', $user)
    <a href="{{ route("personalDetails.edit", $user->personalDetails->id) }}"
       class="btn btn-default">
      <i class="fa fa-btn fa-edit"></i>Editar Información Personal
    </a>
  @endcan
@endif

@if (!$user->personalDetails)
  <a href="{{ route("personalDetails.create", $user->id) }}"
     class="btn btn-default">
    <i class="fa fa-btn fa-plus"></i>Añadir Información Personal
  </a>
@endif