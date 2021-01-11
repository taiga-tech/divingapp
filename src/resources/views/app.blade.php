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

  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta name="theme-color" content="#1a202c">

  <!-- PWA -->
  <link rel="icon" type="image/png" sizes="192x192" href="/vue.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/vue.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/vue.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/vue.png">
  <link rel="apple-touch-icon" sizes="57x57" href="/vue.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/vue.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/vue.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/vue.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/vue.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/vue.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/vue.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/vue.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/vue.png">

  <link rel="manifest" href="/manifest.json">
</head>
<body>
<div id="app"></div>
</body>
</html>
