@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <code>{{ $user }}</code>
      {{-- user info --}}
      <h1>
        {{$user->name}}

        <small>
          {{ $user->admin ? 'Administrador' : 'Usuario' }}
          {!! Html::mailto($user->email) !!}
        </small>
      </h1>

      @if ($user->personalDetails)
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
      @endif

      @include('layouts.admins.basic-audit', ['model' => $user])
    </div>
  </div>
@stop