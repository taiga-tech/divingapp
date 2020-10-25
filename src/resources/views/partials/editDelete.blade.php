@if(Auth::id() === $post->user->id)
  <div style="display: flex;">
    <a href="{{route('posts.edit', [$post->id])}}">
      <button class="btn btn-outline-primary">編集</button>
    </a>
    <form action="{{ route('posts.destroy', [$post->id]) }}" method="POST">
      @csrf
      {{ method_field('delete') }}

      <button type="submit" class="btn btn-outline-danger">削除</button>

    </form>
  </div>
@endif
