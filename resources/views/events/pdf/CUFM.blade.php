@extends('layouts.pdf.master')

@section('content')
  <div>
    <div class="img-background">
      <img src="{{ asset('images/cufm-logos-ajustado.jpg') }}" class="background">
    </div>
    <div class="text" style="position: absolute; top: 0;">
      {{--Usuario Beneficiado--}}
      @include('events.pdf.user')
      @include('events.pdf.event-details')

      {{--Autoridades--}}
      @include('events.pdf.auth')
      @include('layouts.pdf.footers.CUFM-footer')
    </div>
  </div>

  <div class="page-break"></div>

  @include('events.pdf.CUFM-details')
@stop