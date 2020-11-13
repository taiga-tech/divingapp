@extends('layouts.app')
@section('title', "{$post->user->profile->name} ({$post->user->userid})「{$post->text}」/ ".config('app.name'))

@section('content')

<div class="">
  {{ $post -> text }}
  {{ $post -> user -> userid }}
  @foreach ($post->images as $image)
    <div>
      <a href="{{ asset("/storage/images/{$image->path}") }}" target="_blank">
        <img class="w-100" src="{{ asset("/storage/images/{$image->path}") }}">
      </a>
    </div>
  @endforeach
  @include('partials.editDelete')
</div>

@endsection
