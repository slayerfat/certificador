@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @if (Auth::user()->admin)
        @include('layouts.admins.edit-delete-buttons', [
          'resource' => 'users',
          'id' => $user->id
        ])
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
          {{ Date::now()->format('l j F \d\e Y') }}
        </h2>

        <h1>C.I. {{ $user->personalDetails->ci }}</h1>

        <h2>
          {{$user->personalDetails->formattedNames(true)}}
        </h2>

        <h3>
          Teléfonos: <br/>

          {{$phoneParser->parseNumber($user->personalDetails->phone)}}

          <br/>

          {{$phoneParser->parseNumber($user->personalDetails->cellphone)}}
        </h3>

          @can('update', $user)
          <a href="{{ route("users.edit", $user->personalDetails->id) }}"
             class="btn btn-default">
            <i class="fa fa-btn fa-edit"></i>Editar Información Personal
          </a>
          @endcan
      @endif

      @include('layouts.admins.basic-audit', ['model' => $user])
    </div>
  </div>
@stop