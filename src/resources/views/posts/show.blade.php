@extends('layouts.app')
@section('title', '詳細')

@section('content')

<div class="container">
  {{ $post -> text }}
  {{ $post -> user -> name }}
  @foreach ($post->images as $image)
    <div>
      <img src="{{ asset('/storage/images/'.$image->path) }}" alt="">
    </div>
  @endforeach
  @include('partials.editDelete')
</div>

@endsection
