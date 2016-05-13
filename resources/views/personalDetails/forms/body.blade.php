<div class="form-group">
  {!! Form::label('first_name', 'Primer Nombre:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('last_name', 'Segundo Nombre:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('first_surname', 'Primer Apellido:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('first_surname', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('last_surname', 'Segundo Apellido:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('last_surname', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('ci', 'Cédula de identidad:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('ci', null, ['class' => 'form-control', 'placeholder' => 'Sin puntos, guiones, solo números.']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('title_id', 'Título:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::select('title_id', $titles, null, ['class' => 'form-control']) !!}
  </div>

  {!! Form::label('sex', 'Sexo:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::select('sex', ['m' => 'Masculino', 'f' => 'Femenino'], null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('phone', 'Teléfono:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::input('tel', 'phone', null, ['class' => 'form-control', 'pattern' => '[0-9]*', 'placeholder' => 'Sin puntos, guiones, solo números.']) !!}
  </div>

  {!! Form::label('cellphone', 'Teléfono celular:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::input('tel', 'cellphone', null, ['class' => 'form-control', 'pattern' => '[0-9]*', 'placeholder' => 'Sin puntos, guiones, solo números.']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('birthday', 'Fecha de nacimiento:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::input('text', 'birthday', null, ['class' => 'form-control', 'data-date-format' => 'yyyy-mm-dd']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-12">
    {!! Form::submit($submitBtn, ['class' => 'form-control btn btn-primary']) !!}
  </div>
</div>

@section('css')
  <link href="{!! asset('css/bootstrap-datepicker3.min.css') !!}"
        rel="stylesheet">
@endsection

@section('js')
  <script type="text/javascript"
          src="{!! asset('js/bootstrap-datepicker.min.js') !!}"></script>
  <script type="text/javascript"
          src="{!! asset('js/bootstrap-datepicker.es.min.js') !!}"></script>
  <script type="text/javascript">
    $('#birthday').datepicker({
      language: 'es',
      endDate: '-18y',
      format: 'yyyy-mm-dd'
    });
  </script>
@stop
