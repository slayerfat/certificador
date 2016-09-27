@push('css')
  <link
    rel="stylesheet"
    type="text/css"
    href="{!! asset('css/bootstrap-table.css') !!}"
  >
@endpush

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
  <tr>
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
  </tr>
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

@push('js')
  <script src="{!! asset('js/bootstrap-table.js') !!}"></script>
  <script src="{!! asset('js/bootstrap-table-es-CR.js') !!}"></script>
  <script src="{!! asset('js/initBootstrapTable.js') !!}"></script>
  <script type="text/javascript">
    initBootstrapTable("{!! route('events.show', 'no-data') !!}");
  </script>
@endpush