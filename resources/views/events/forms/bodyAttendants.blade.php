<div class="form-group">
  {!! Form::label('attendants', 'Participantes:', ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    {!! Form::select('attendants[]', $attendants, null, [
      'class' => 'form-control',
      'id' => 'professors',
      'multiple' => 'multiple'
    ]) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-12">
    {!! Form::submit($submitBtn, ['class' => 'form-control btn btn-primary']) !!}
  </div>
</div>

@section('css')
  <link rel="stylesheet" type="text/css"
        href="{!! asset('css/select2.min.css') !!}">
@stop

@section('js')
  <script src="{!! asset('js/select2.min.js') !!}"></script>
  <script src="{!! asset('js/select2-es.js') !!}"></script>
  <script type="text/javascript">
    $('document').ready(function () {
      $('#professors').select2();
    });
  </script>
@stop