@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css"
        href="{!! asset('css/bootstrap-table.css') !!}">
@stop

@section('content')
  <div class="container">
    <h1>Usuarios en el sistema</h1>
    <a href="{{ route('users.create') }}" class="btn btn-default">
      <i class="fa fa-btn fa-plus"></i>Crear Usuario
    </a>
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
          <th data-field="admin" data-sortable="true" data-switchable="true">
            Admin
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
          <th data-field="phone" data-sortable="true" data-switchable="true">
            Teléfono
          </th>
          <th data-field="cellphone" data-sortable="true"
              data-switchable="true">
            Celular
          </th>
          </thead>
          <tbody>
          @foreach ($users as $user)
            <tr>
              <td></td>
              <td>
                {{ $user->name }}
              </td>
              <td>
                {{ $user->email }}
              </td>
              <td>
                {{ $user->admin ? 'Si' : 'No' }}
              </td>
              @if($user->personalDetails)
                <td>
                  {{ $user->personalDetails->ci }}
                </td>
                <td>
                  {{ $user->personalDetails->first_name }}
                </td>
                <td>
                  {{ $user->personalDetails->first_surname }}
                </td>
                <td>
                  {{ $user->personalDetails->phone }}
                </td>
                <td>
                  {{ $user->personalDetails->cellphone }}
                </td>
              @endif
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

