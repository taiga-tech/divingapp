@extends('layouts.app')
@section('title', '一覧')

@section('content')

<div class="container">
  <div>
    <a href="{{ route('posts.create') }}">新規作成</a>
  </div>
  <hr>
  @foreach ( $posts as $post )
  <a href="{{ route('posts.show', [$post->id]) }}" style="color:black;">
    <div>
      <h4>{{ $post -> user -> name }}</h4>
      <p>{{ $post -> text }}</p>
      <p>{{ $post -> spot }}</p>

      @foreach ( $post -> tags as $tag )
        <span class="alert alert-warning alert-dismissible fade show">{{ $tag -> name }}</span>
        <span>{{ $tag -> created_at }}</span>
      @endforeach
      @include('partials.editDelete')

      <hr>
    @endforeach
    </div>
  </a>
</div>

@endsection
