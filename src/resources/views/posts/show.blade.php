@extends('layouts.app')
@section('title', '詳細')

@section('content')

<div class="container">
  {{ $post -> text }}
  {{ $post -> user -> userid }}
  @foreach ($post->images as $image)
    <div>
      <img src="{{ asset('/storage/images/'.$image->path) }}">
    </div>
  @endforeach
  @include('partials.editDelete')
</div>

@endsection
