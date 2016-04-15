<div class="form-group">
  {!! Form::label('name', 'Nombre:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('info', 'Información adicional:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('info', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('institute_id', 'Instituto Relacionado:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::select('institute_id', $institutes, null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('hours', 'Horas:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::input('number', 'hours', null, ['class' => 'form-control']) !!}
  </div>

  {!! Form::label('date', 'Fecha:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::input('text', 'date', null, ['class' => 'form-control', 'data-date-format' => 'yyyy-mm-dd']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('location', 'Locación:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::text('location', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('content', 'Contenido:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-12">
    {!! Form::submit($submitBtn, ['class' => 'form-control btn btn-primary']) !!}
  </div>
</div>

@section('css')
  <link href="{!! asset('css/bootstrap3-wysihtml5.min.css') !!}"
        rel="stylesheet">
  <link href="{!! asset('css/bootstrap-datepicker3.min.css') !!}"
        rel="stylesheet">
@endsection

@section('js')
  <script type="text/javascript"
          src="{!! asset('js/bootstrap-datepicker.min.js') !!}"></script>
  <script type="text/javascript"
          src="{!! asset('js/bootstrap-datepicker.es.min.js') !!}"></script>
  <script type="text/javascript"
          src="{!! asset('js/bootstrap3-wysihtml5.all.min.js') !!}"></script>
  <script type="text/javascript"
          src="{!! asset('js/bootstrap-wysihtml5.es-ES.js') !!}"></script>

  <script type="text/javascript">
    $('#date').datepicker({
      language: 'es',
      format: 'yyyy-mm-dd'
    });
    $('#content').wysihtml5({
      locale: "es-ES",
      toolbar: {
        "font-styles": false,
        "link": false,
        "image": false,
        "fa": true
      }
    });
  </script>
@stop