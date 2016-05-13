<div class="form-group">
  {!! Form::label('name', 'Seudónimo:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre único que Ud. desea para ser identificado(a) en el sistema.']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('email', 'Correo Electrónico:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'El Correo electrónico a asociar.']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('password', 'Contraseña:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Trate que su contraseña tenga una combinación de letras, números y caracteres especiales, junto a mayúsculas.']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('password_confirmation', 'Confirmar Contraseña:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => 'Por favor confirme la contraseña.']) !!}
  </div>
</div>

@if(Auth::user() and Auth::user()->admin)
  <div class="form-group">
    {!! Form::label('admin', 'Administrador:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
      {!! Form::checkbox('admin', null, null, ['class' => 'form-control']) !!}
    </div>
  </div>
@endif

<div class="form-group">
  <div class="col-md-12">
    {!! Form::submit($submitBtn, ['class' => 'form-control btn btn-primary']) !!}
  </div>
</div>
