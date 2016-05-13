@extends('layouts.app')

@section('css')
  <link
    rel="stylesheet"
    type="text/css"
    href="{!! asset('css/bootstrap-table.css') !!}"
  >
@stop

@section('content')
  <div class="container">
    <h1>Eventos en el sistema</h1>

    @if (Auth::user()->admin)
      <a href="{{ route('events.create') }}" class="btn btn-default">
        <i class="fa fa-btn fa-plus"></i>Crear Evento
      </a>
    @endif

    <hr/>

    <div class="row">
      <div class="col-sm-12">
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
          <th data-field="resource" data-sortable="true" data-switchable="true" data-visible="false">
            Id
          </th>
          <th data-field="name" data-sortable="true" data-switchable="true">
            Nombre
          </th>
          <th data-field="hours" data-sortable="true" data-switchable="true">
            Horas
          </th>
          <th data-field="date" data-sortable="true" data-switchable="true">
            Fecha
          </th>
          </thead>
          <tbody>
          @foreach ($events as $event)
            <tr>
              <td></td>
              <td>
                {{ $event->id }}
              </td>
              <td>
                {!! link_to_route('events.show', $event->name, $event->id) !!}
              </td>
              <td>
                {{ $event->hours }}
              </td>
              <td>
                {{ Date::parse($event->date)->format('l j F \d\e Y') }}.
                {{ Date::parse($event->date)->diffForHumans() }}.
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop

@section('js')
  <script src="{!! asset('js/bootstrap-table.js') !!}"></script>
  <script src="{!! asset('js/bootstrap-table-es-CR.js') !!}"></script>
  <script src="{!! asset('js/initBootstrapTable.js') !!}"></script>
  <script type="text/javascript">
    initBootstrapTable("{!! route('events.show', 'no-data') !!}")
  </script>
@stop

