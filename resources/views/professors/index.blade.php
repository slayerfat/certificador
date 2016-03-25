@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css"
        href="{!! asset('css/bootstrap-table.css') !!}">
@stop

@section('content')
  <div class="container">
    <h1>Profesores en el sistema</h1>
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
          <th data-field="resource" data-sortable="true" data-switchable="true">
            Seudónimo
          </th>
          <th data-field="email" data-sortable="true" data-switchable="true">
            Correo Electrónico
          </th>
          <th data-field="position" data-sortable="true" data-switchable="true">
            Posición
          </th>
          <th data-field="ci" data-sortable="true" data-switchable="false">
            Cédula
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
          @foreach ($professors as $professor)
            <tr>
              <td></td>
              <td>
                {{ $professor->personalDetails->user->name }}
              </td>
              <td>
                {{ $professor->personalDetails->user->email }}
              </td>
              <td>
                {{ $professor->position }}
              </td>
              <td>
                {{ $professor->personalDetails->ci }}
              </td>
              <td>
                {{ $professor->personalDetails->first_name }}
              </td>
              <td>
                {{ $professor->personalDetails->first_surname }}
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
    initBootstrapTable("{!! route('users.show', 'no-data') !!}")
  </script>
@stop

