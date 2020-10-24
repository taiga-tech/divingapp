@extends('layouts.app')
@section('title', "「{$post->text}」/ ".config('app.name'))

@section('content')

<div class="">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">投稿編集</div>
        <div class="card-body">
          <form action="{{ route('posts.update', [$post->id]) }}" method="POST" enctype="multipart/form-data">
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
