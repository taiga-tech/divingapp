{{-- <form method="{{request() -> method()}}" action="{{request() -> path()}}"> --}}
  @csrf
  {{-- どうにかしたい --}}
  <input type="hidden" name="user_id" value="{{Auth::id()}}">
  <div class="form-group row">
    <label for="text" class="col-md-4 col-form-label text-md-right">
      {{ __('Text')}}
    </label>
    <div class="col-md-6">
      <textarea name="text" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Place') }}</label>
    <div class="col-md-6">
      <input type="text" name="place" class="form-control">
    </div>
  </div>

  <div>

    {{--<div class="form-group">
      <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('image') }}</label>
      <div class="col-md-6">
        <input type="file" name="image" class="form-control">
      </div>
    </div>
  </div>--}}
  <div><input type="text" name="image"></div>
  <input type="submit">

{{-- </form> --}}
