@extends('layouts.pdf.master')

@section('content')
  @include('layouts.pdf.headers.CUFM-header')

  @include('events.pdf.user')
  @include('events.pdf.auth')
  @include('layouts.pdf.footers.CUFM-footer')

  <div class="page-break"></div>

  @include('events.pdf.CUFM-details')
@stop