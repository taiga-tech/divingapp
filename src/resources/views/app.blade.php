<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  {{-- <title>@yield('title')</title> --}}
  <meta name="description" content="テキスト、画像、位置情報が共有できるアプリです！">

  <link rel="shortcut icon" href="{{ asset('/vue-icon.ico') }}">

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link rel="manifest" href="/manifest.json">
</head>
<body>
<div id="app"></div>
</body>
</html>
