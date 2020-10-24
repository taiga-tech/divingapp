@extends('layouts.app')
@section('title', "{$profile->name} ({$profile->user->userid})の編集 / ".config('app.name'))

@section('content')

<div class="">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">profileedit</div>
        <div class="card-body">
          <form action="{{ route('profiles.update', [$profile->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('partials.profileForm')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
