@extends('layouts.app')
@section('title', config('app.name'))

@section('content')

<div class="overflow-auto" style="height: calc(100vh - 103px);">
  @foreach ( $posts as $post )
    <a class="item d-block p-2 border-bottom" href="{{ route('posts.show', [$post->id]) }}">
      <h4>{{ $post->user->userid }}</h4>
      <p>{{ $post->text }}</p>
      <p>{{ $post->spot }}</p>
      <p>{{ $post->created_at }}</p>
    </a>
  @endforeach
</div>
@endsection
