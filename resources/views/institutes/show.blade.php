@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        @if (Auth::user()->admin)
          @include('layouts.admins.edit-delete-buttons', [
            'resource' => 'institutes',
            'id' => $institute->id
          ])
        @endif

        <h1>
          {{ $institute->name }}
        </h1>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <h2>Información relacionada</h2>
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
          <th data-field="title" data-sortable="true"
              data-switchable="false">
            Título
          </th>
          </thead>
          <tbody>
          @foreach ($institute->professors as $professor)
            <tr>
              <td></td>
              <td>{{ $professor->personalDetails->user->name }}</td>
              <td>{{ $professor->personalDetails->user->email }}</td>
              <td>{{ $professor->personalDetails->first_name }}</td>
              <td>{{ $professor->personalDetails->first_surname }}</td>
              <td>{{ $professor->title->desc }}</td>
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