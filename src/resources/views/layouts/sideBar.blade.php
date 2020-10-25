<div class="d-flex flex-column h-100 justify-content-between">
  <div>
    <div class="">
      <a href="/">
        <div class="d-flex">
          <div class="col-1"><i class="fas fa-home"></i></div>
          <div class="d-none d-xl-block col-xl-8 ">home</div>
        </div>
      </a>
    </div>
    <div class="">
      <a href="{{ route('posts.create') }}">
        <div class="d-flex">
          <div class="col-1"><i class="fas fa-plus"></i></div>
          <div class="d-none d-xl-block col-xl-8">新規作成</div>
        </div>
      </a>
    </div>
    <div class="">
      <a href="#">
        <div class="d-flex">
          <div class="col-1"><i class="fas fa-search"></i></div>
          <div class="d-none d-xl-block col-xl-8">検索</div>
        </div>
      </a>
    </div>

    @if (Auth::check() && Auth::user()->profile)
      <div class="">
        <a href="{{ route('profiles.show', Auth::user()->profile->id) }}">
          <div class="d-flex">
            <div class="col-1"><i class="far fa-user"></i></div>
            <div class="d-none d-xl-block col-xl-8">プロフィール</div>
          </div>
        </a>
      </div>
    @elseif (Auth::check() && !Auth::user()->profile)
      <div>
        <a href="{{route('profiles.create')}}">
          <div class="d-flex">
            <div class="col-1"><i class="far fa-id-card"></i></div>
            <div class="d-none d-xl-block col-xl-8">プロフィール作成</div>
          </div>
        </a>
      </div>
    @else
      <div>
        <a href="login">
          <div class="d-flex">
            <div class="col-1"><i class="fas fa-sign-in-alt"></i></div>
            <div class="d-none d-xl-block col-xl-8">ログイン</div>
          </div>
        </a>
      </div>
      <div>
        <a href="register">
          <div class="d-flex">
            <div class="col-1"><i class="fas fa-user-plus"></i></div>
            <div class="d-none d-xl-block col-xl-8">新規登録</div>
          </div>
        </a>
      </div>
    @endif
  </div>

  <div class="">
    @if (Auth::check())
      <div>
        @if (Auth::user()->profile)
          <a href="{{ route('profiles.show', Auth::user()->profile->id) }}">
            <div class="d-flex">
                <div class="col-1"><img class="rounded-circle" src="{{ asset("storage/images/".Auth::user()->profile->image ) }}" style="width:20px;"></div>
                <div class="d-none d-xl-block col-xl-8">{{ Auth::user()->profile->name }} {{ Auth::user()->userid }}</div>
            </div>
          </a>
        @else
          <a href="{{ route('profiles.create') }}">
            <div class="d-flex">
              <div class="col-1"><i class="far fa-id-card"></i></div>
              <div class="d-none d-xl-block col-xl-8">プロフィール作成</div>
            </div>
          </a>
        @endif

      </div>
      <div>
        <a href="#">
          <div class="d-flex">
            <div class="col-1"><i class="fas fa-sign-out-alt"></i></div>
            <div class="d-none d-xl-block col-xl-8">ログアウト</div>
          </div>
        </a>
      </div>
    @endif
  </div>
</div>
