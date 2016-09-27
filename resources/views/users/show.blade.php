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

      @include('users.personal-details')
      @include('users.professor-info')
      @include('users.events-info')

      @include('layouts.admins.basic-audit', [
        'model'   => $user,
        'created' => 'Usuario creado',
        'updated' => 'Usuario actualizado',
      ])
    </div>
  </div>
@stop
