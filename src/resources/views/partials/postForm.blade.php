@csrf

<div class="form-group row">
  <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Text') }}</label>
  <div class="col-md-6">
    <textarea name="text" class="form-control @error('text') is-invalid @enderror" required>{{ $errors->has('*') ? old('text'):($post['text'] ?? '') }}</textarea>

    @error('text')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror

  </div>
</div>

<div class="form-group row">
  <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Place') }}</label>
  <div class="col-md-6">
    <input type="text" name="place" class="form-control" value="{{ $errors->has('*') ? old('place'):($post['place'] ?? '') }}">
  </div>
</div>

<div class="form-group row">
  <label for="image" class="col-md-4 col-form-label text-md-right">画像ファイル（複数可）</label>
  <div class="col-md-6">
    <input type="file" class="form-control-file" name="files[][image]" multiple>
  </div>
</div>

<div class="form-group row mb-0">
  <div class="col-md-6 offset-md-4">
      <button type="submit" class="btn btn-outline-info">
        {{-- textがない時押せないようにする --}}
        送信
      </button>
  </div>
</div>
