@extends('layouts.pdf.master')

@section('content')
  <div class="pdf-body"
       style="background-image: url('{{asset("images/francisco_miranda.jpeg")}}')">
    {{--Usuario Beneficiado--}}
    @include('events.pdf.user')
    @include('events.pdf.event-details')

    {{--Autoridades--}}
    @include('events.pdf.auth')
    @include('layouts.pdf.footers.CUFM-footer')
  </div>

  <div class="page-break"></div>

  @include('events.pdf.CUFM-details')
@stop