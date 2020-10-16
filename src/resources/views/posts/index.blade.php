{{--
@extends('layouts.app')

@section('content')
<div class="container">
  @foreach ( $posts as $post )
    <h2>{{ $post -> user -> name }}</h2>
    <p>{{ $post -> text }}</p>
    <p>{{ $post -> spot }}</p>

    @foreach ( $post -> tags as $tag )
      <span class="alert alert-warning alert-dismissible fade show">{{ $tag -> name }}</span>
      <span>{{$tag -> created_at}}</span>
    @endforeach
    <hr>
  @endforeach
</div>
@endsection
--}}
