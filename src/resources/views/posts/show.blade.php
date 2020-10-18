@extends('layouts.app')
@section('title', '詳細')

@section('content')

<div class="container">
  {{ $post -> text }}
  {{ $post -> user -> name }}
  @include('partials.editDelete')
</div>

@endsection
