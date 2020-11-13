@extends('layouts.app')
@section('title', 'ユーザ 一覧 / '.config('app.name'))

@section('content')

<div class="">
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
