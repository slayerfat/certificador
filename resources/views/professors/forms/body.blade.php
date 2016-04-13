<div class="form-group">
  {!! Form::label('title_id', 'Título:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::select('title_id', $titles, null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-12">
    {!! Form::submit($submitBtn, ['class' => 'form-control btn btn-primary']) !!}
  </div>
</div>