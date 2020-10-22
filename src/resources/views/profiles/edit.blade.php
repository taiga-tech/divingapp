@extends('layouts.app')
@section('title', '投稿編集')

@section('content')

<div class="container">
  <div class="row justify-content-center">
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
