@extends('layouts.app')
@section('title', "{$profile->name} ({$profile->user->userid}) / ".config('app.name'))

@section('content')

<div class="">
  {{ $profile->name }}
  <strong>{{ $profile->image }}</strong>
  {{ $profile->created_at}}
</div>

@endsection
