@extends('layouts.app')
@section('title', '投稿編集')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">投稿編集</div>
        <div class="card-body">
          <form action="{{ route('posts.update', [$post->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('partials.postForm')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
