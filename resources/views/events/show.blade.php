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
          <a href="{{ route('events.indexPdf', $event->id) }}" class="btn btn-default" id="event-pdf">
            <i class="fa fa-btn fa-file-pdf-o"></i>Generar PDFs
          </a>
        @endif

        <h1>
          {{ $event->name }}
        </h1>

        <h2>{{ $event->info }}</h2>

        <h2>
          Perteneciente al
          {{ link_to_route('institutes.show', $event->institute->name, $event->institute->id) }}
        </h2>

        <h3>
          {{ $event->location }}
        </h3>

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

        <a href="{{ route('events.createAttendants', $event->id) }}"
           class="btn btn-default">
          <i class="fa fa-btn fa-plus"></i>Asignar Participantes
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
          <th data-field="actions" data-sortable="false"
              data-switchable="true">
            Acciones
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
              <td>
                <a href="#" title="Eliminar" class="professor-action-delete"
                   data-id="{{ $professor->id }}">
                  <i class="fa fa-times text-danger"></i>
                </a>
                {!! Form::open(['route' => ['events.destroyProfessor', $professor->id, $event->id], 'method' => 'DELETE', 'id' => "professor-delete-$professor->id"]) !!}
                {!! Form::close() !!}
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
          <th data-field="actions" data-sortable="false"
              data-switchable="true">
            Acciones
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
              <td>
                <a
                  href="{{ route('events.showPdf', [$attendant->id, $event->id]) }}"
                  title="Ver Certificado">
                  <i class="fa fa-file-pdf-o"></i>
                </a>
                <a href="#" title="Eliminar" class="attendant-action-delete"
                   data-id="{{ $attendant->id }}">
                  <i class="fa fa-times text-danger"></i>
                </a>
                {!! Form::open(['route' => ['events.destroyAttendant', $attendant->id, $event->id], 'method' => 'DELETE', 'id' => "attendant-delete-$attendant->id"]) !!}
                {!! Form::close() !!}
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

  <script>
    $('document').ready(function () {
      $('.professor-action-delete').click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');

        if (confirm('¿Está seguro que desea eliminar a este Profesor?')) {
          $('#professor-delete-' + id).submit();
        }
      });

      $('.attendant-action-delete').click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');

        if (confirm('¿Está seguro que desea eliminar a este Participante?')) {
          $('#attendant-delete-' + id).submit();
        }
      });

      $('#event-pdf').click(function(event){
        if(!confirm('Esta acción puede tardar varios minutos, ¿desea continuar?')) {
          event.preventDefault();
        }
      });
    });
  </script>
@stop