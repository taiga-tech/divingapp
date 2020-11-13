@extends('layouts.app')
@section('title', 'New / '.config('app.name'))

@section('content')

<div class="">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">新規投稿</div>
        <div class="card-body">
          <form action="/posts" method="POST" enctype="multipart/form-data">
            @include('partials.postForm')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
