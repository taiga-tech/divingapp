@extends('layouts.app')
@section('title', '投稿編集')

@section('content')

<div class="container">
  <hr>
  @foreach ($profiles as $profile)
    <a href="{{ route('profiles.show', $profile->id)}}">
      {{ $profile -> id }}
      {{ $profile -> name }}
      {{ $profile -> user -> userid }}
    </a>
    <hr>
  @endforeach
</div>

@endsection
