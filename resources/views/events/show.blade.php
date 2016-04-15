@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        @if (Auth::user()->admin)
          @include('layouts.admins.edit-delete-buttons', [
            'resource' => 'events',
            'id' => $event->id
          ])
        @endif

        <h1>
          {{ $event->name }}
        </h1>

        <h2>
          Perteneciente al
          {{ link_to_route('institutes.show', $event->institute->name, $event->institute->id) }}
        </h2>

        <h3>
          {{ Date::parse($event->date)->format('l j F \d\e Y') }}.
          {{ Date::parse($event->date)->diffForHumans() }}.
          {{ $event->hours }}
          {{ $event->hours === 1 ? 'Hora' : 'Horas' }} de duración
        </h3>

        <hr>

        <a href="{{ route('events.createProfessors', $event->id) }}"
           class="btn btn-default">
          <i class="fa fa-btn fa-plus"></i>Asignar Profesores
        </a>

        <hr>

        <h3>Contenido:</h3>
        {!! $event->content !!}
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <h2>Profesores involucrados</h2>
        <table
          id="tabla"
          data-toggle="table"
          data-search="false"
          data-pagination="true"
          data-page-list="[10, 25, 50, 100]"
          data-show-toggle="true"
          data-show-columns="true"
          data-click-to-select="true"
          data-maintain-selected="true"
          data-sort-name="first_name"
        >
          <thead>
          <th data-field="operate" data-formatter="operateFormatter"
              data-events="operateEvents">Ver
          </th>
          <th data-field="resource" data-sortable="true" data-switchable="true">
            Seudónimo
          </th>
          <th data-field="email" data-sortable="true" data-switchable="true">
            Correo Electrónico
          </th>
          <th data-field="first_name" data-sortable="true"
              data-switchable="false">
            Primer Nombre
          </th>
          <th data-field="first_surname" data-sortable="true"
              data-switchable="false">
            Primer Apellido
          </th>
          <th data-field="title" data-sortable="true"
              data-switchable="false">
            Título
          </th>
          </thead>
          <tbody>
          @foreach ($event->professors as $professor)
            <tr>
              <td></td>
              <td>
                {{ $professor->personalDetails->user->name }}
              </td>
              <td>
                {{ $professor->personalDetails->user->email }}
              </td>
              <td>
                {{ $professor->personalDetails->first_name }}
              </td>
              <td>
                {{ $professor->personalDetails->first_surname }}
              </td>
              <td>
                {{ $professor->title->desc }}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <h2>Participantes</h2>
        <table
          id="tabla"
          data-toggle="table"
          data-search="true"
          data-pagination="true"
          data-page-list="[10, 25, 50, 100]"
          data-show-toggle="true"
          data-show-columns="true"
          data-click-to-select="true"
          data-maintain-selected="true"
          data-sort-name="first_name"
        >
          <thead>
          <th data-field="operate" data-formatter="operateFormatter"
              data-events="operateEvents">Ver
          </th>
          <th data-field="resource" data-sortable="true" data-switchable="true">
            Seudónimo
          </th>
          <th data-field="email" data-sortable="true" data-switchable="true">
            Correo Electrónico
          </th>
          <th data-field="first_name" data-sortable="true"
              data-switchable="false">
            Primer Nombre
          </th>
          <th data-field="first_surname" data-sortable="true"
              data-switchable="false">
            Primer Apellido
          </th>
          </thead>
          <tbody>
          @foreach ($event->attendants as $attendant)
            <tr>
              <td></td>
              <td>
                {{ $attendant->user->name }}
              </td>
              <td>
                {{ $attendant->user->email }}
              </td>
              <td>
                {{ $attendant->first_name }}
              </td>
              <td>
                {{ $attendant->first_surname }}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop

@section('css')
  <link rel="stylesheet" type="text/css"
        href="{!! asset('css/bootstrap-table.css') !!}">
@stop

@section('js')
  <script src="{!! asset('js/bootstrap-table.js') !!}"></script>
  <script src="{!! asset('js/bootstrap-table-es-CR.js') !!}"></script>
  <script src="{!! asset('js/initBootstrapTable.js') !!}"></script>
  <script type="text/javascript">
    initBootstrapTable("{!! route('users.show', 'no-data') !!}")
  </script>
@stop