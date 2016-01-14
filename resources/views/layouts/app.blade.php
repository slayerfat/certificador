<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Mini-app Jornadas</title>

  <!-- Styles -->
  <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

  <style>
    .fa-btn {
      margin-right: 6px;
    }
  </style>
</head>
<body id="app-layout">
@include('layouts.navbar')

<div class="container">
  @include('flash::message')
</div>

@yield('content')

<script src="{{ elixir('js/all.js') }}"></script>
</body>
</html>
