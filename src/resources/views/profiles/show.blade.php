@extends('layouts.app')
@section('title', '投稿編集')

@section('content')

<div class="container">
  {{ $profile->name }}
  <strong>{{ $profile->image }}</strong>
  {{ $profile->created_at}}
</div>

@endsection
