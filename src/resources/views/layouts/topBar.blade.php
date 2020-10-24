<div class="px-2 w-100 border-bottom text-center text-xl-left" style="line-height: 50px">

    @if (Auth::check())
      <img src="{{ asset("storage/images/".Auth::user()->profile->image ) }}" class="d-inline-block d-xl-none rounded-circle float-left p-1" style="width: 50px;">
    @else
      <span class=" d-xl-none float-left" style="width:50px;">{{ config('app.name')}}</span>
    @endif
  <span class="ml-n5 m-xl-0" style="font-size: 23px;">Home</span>
</div>
