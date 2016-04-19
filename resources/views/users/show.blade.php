@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @if (Auth::user()->admin)
        @include('layouts.admins.edit-delete-buttons', [
          'resource' => 'users',
          'id' => $user->id
        ])
      @elseif (Auth::user()->isOwnerOrAdmin($user->id))
        <a href="{{ route("users.edit", $user->id) }}" class="btn btn-default">
          <i class="fa fa-btn fa-edit"></i>Editar
        </a>
      @endif

      {{-- user info --}}
      <h1>
        {{$user->name}}

        <small>
          {{ $user->admin ? 'Administrador' : 'Usuario' }}
          {!! Html::mailto($user->email) !!}
        </small>
      </h1>

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
        <a
          href="{{ route("personalDetails.edit", $user->personalDetails->id) }}"
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

      @if(Auth::user()->admin && $user->personalDetails && !$user->personalDetails->professor)
        <a href="{{ route('professors.create', $user->personalDetails->id) }}"
           class="btn btn-default"
        >
          <i class="fa fa-btn fa-plus"></i>Crear información Profesoral
        </a>
      @endif

      @if ($user->personalDetails && $user->personalDetails->professor)
          @if (Auth::user()->isOwnerOrAdmin($user->id))
            <a
              href="{{ route("professors.edit", $user->personalDetails->professor->id) }}"
              class="btn btn-default">
              <i class="fa fa-btn fa-edit"></i>Editar información Profesoral
            </a>
            <a
              href="#"
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

      @include('layouts.admins.basic-audit', [
        'model'   => $user,
        'created' => 'Usuario creado',
        'updated' => 'Usuario actualizado',
      ])
    </div>
  </div>
@stop