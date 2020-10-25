@csrf

<div class="form-group row">
  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
  <div class="col-md-6">
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $errors->has('*') ? old('name'):($profile['name'] ?? $name) }}" required>
    @error('name')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>
  <div class="col-md-6">
    <textarea name="comment" class="form-control">{{ $errors->has('*') ? old('comment'):($profile['comment'] ?? '') }}</textarea>
  </div>
</div>

<div class="form-group row">
  <label for="image" class="col-md-4 col-form-label text-md-right">プロフィール画像</label>
  <div class="col-md-6">
    <input type="file" class="form-control-file" name="image" multiple>
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
