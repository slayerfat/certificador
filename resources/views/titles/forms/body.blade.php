<div class="form-group">
  {!! Form::label('desc', 'Descripción:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('desc', null, ['class' => 'form-control', 'placeholder' => 'Descripción textual, debe ser única en el sistema.']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-12">
    {!! Form::submit($submitBtn, ['class' => 'form-control btn btn-primary']) !!}
  </div>
</div>
