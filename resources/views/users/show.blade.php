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

      @include('layouts.admins.basic-audit', ['model' => $user])
    </div>
  </div>
@stop