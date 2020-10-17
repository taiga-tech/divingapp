@extends('layouts.app')
@section('title', '投稿編集')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">投稿編集</div>
          <div class="card-body">
            <form action="{{route('posts.update', [$post->id])}}" method="POST">
              @csrf
              @method('PUT')
              {{-- どうにかしたい --}}
              <input type="hidden" name="user_id" value="{{Auth::id()}}">
              <div class="form-group row">
                <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Text')}}</label>
                <div class="col-md-6">
                  <textarea name="text" class="form-control">{{old('text', $post->text)}}</textarea>
                  {{-- <input type="text" name="text" class="form-control" value="{{$post->text}}"> --}}
                </div>
              </div>
              <div class="form-group row">
                <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Place') }}</label>
                <div class="col-md-6">
                  <input type="text" name="place" value="{{old('place', $post->place)}}" class="form-control">
                </div>
              </div>

                {{--<div class="form-group">
                  <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('image') }}</label>
                  <div class="col-md-6">
                    <input type="file" name="image" class="form-control">
                  </div>
                </div>
                --}}
              <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">image</label>
                <div class="col-md-6">
                  <input type="text" name="image" value="{{old('image', $post->image)}}" class="form-control">
                </div>
              </div>

              <div class="form-group row"><input type="submit" class="form-control"></div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
