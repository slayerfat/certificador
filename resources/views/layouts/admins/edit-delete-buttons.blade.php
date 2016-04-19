@if(Auth::user()->admin)
  <span style="float: right">
    <a href="{{ route("{$resource}.edit", $id) }}" class="btn btn-default">
      <i class="fa fa-btn fa-edit"></i>Editar
    </a>
    <a href="#"
       class="btn btn-default btn-danger"
       onclick="deleteResourceFromAnchor({{ $id }})"
       id="model-delete-{{ $id }}">
      <i class="fa fa-btn fa-trash"></i>Eliminar
    </a>
  </span>

  {!! Form::open(['route' => ["{$resource}.destroy", $id], 'method' => 'DELETE', 'id' => $id]) !!}

  {!! Form::close() !!}
@endif