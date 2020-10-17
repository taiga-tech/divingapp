@extends('layouts.app')
@section('title', 'index')
@section('content')

<div class="container">
<button class="btn"><a href="{{route('posts.create')}}">新規作成</a></button>
  @foreach ( $posts as $post )
    <h2>{{ $post -> user -> name }}</h2>
    <p>{{ $post -> text }}</p>
    <p>{{ $post -> spot }}</p>

    @foreach ( $post -> tags as $tag )
      <span class="alert alert-warning alert-dismissible fade show">{{ $tag -> name }}</span>
      <span>{{$tag -> created_at}}</span>
    @endforeach
    <a href="{{route('posts.edit', [$post->id])}}">編集</a>
    <form action="{{ route('posts.destroy', [$post->id]) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('delete') }}
      {{-- <a href="#" data-id="{{ $post->id }}" onclick="deletePost(this);">削除</a> --}}
      <input type="submit" class="delete btn" value="削除">
    </form>
    <hr>
  @endforeach
</div>
@endsection
