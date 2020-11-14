@if (Auth::check() && Auth::user()->profile)
  <top-bar
    app="{{ config('app.name') }}"
    image="{{ Auth::user()->profile->image }}"
  ></top-bar>
@else
  <top-bar app="{{ config('app.name') }}"></top-bar>
@endif
