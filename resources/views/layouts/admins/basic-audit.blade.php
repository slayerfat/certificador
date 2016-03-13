@if(Auth::user() && Auth::user()->admin)
  <hr/>

  <h4>
    {{$created or 'Recurso creado'}}
    {{ Date::parse($model->created_at)->diffForHumans() }}

    @if ($model->created_by)
      <?php $createdBy = App\User::find($model->created_by) ?>
      <small>
        por
        <a href="{{route("users.show", $model->created_by)}}">
          {{ $createdBy }}
        </a>
      </small>
    @endif
  </h4>

  <h4>
    {{$updated or 'Recurso actualizado'}}
    {{ Date::parse($model->updated_at)->diffForHumans() }}

    @if ($model->updated_by)
      <?php $updatedBy = App\User::find($model->updated_by) ?>
      <small>
        por
        <a href="{{route("users.show", $model->updated_by)}}">
          {{ $updatedBy }}
        </a>
      </small>
    @endif
  </h4>
@endif