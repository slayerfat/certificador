@extends('layouts.pdf.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p style="font-size: 2rem">
          Listado General de usuarios del evento
          {{ $event->name }}
        </p>

        <hr>

        <table style="font-size: 1.5rem">
          <tr>
            <th></th>
            <th>Nº</th>
            <th>Nombres</th>
            <th>C.I</th>
            <th>Firma</th>
          </tr>

          @for ($i = 0; $i < $attendants->count(); $i++)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $attendants[$i]->formattedNames() }}</td>
              <td>{{ $attendants[$i]->ci }}</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
          @endfor
        </table>
      </div>
    </div>
  </div>
@stop