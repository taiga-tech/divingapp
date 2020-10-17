@extends('layouts.app')
@section('title', '新規投稿')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">新規投稿</div>
          <div class="card-body">
            <form action="/posts" method="POST">
              @include('partials.postForm')
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
