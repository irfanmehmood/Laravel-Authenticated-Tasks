@extends ('layouts.master')
@section ('content')
  <div class="album py-5 bg-light">
    <div class="container">
        <div class="card mb-4 box-shadow">
          <img class="card-img-top" data-src="js/holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
          <div class="card-body">
            <p class="card-text">
                {{ $post->title }}.
            </p>
            <p class="card-body-text">
                {{ $post->body }}
            </p>
            <p class="card-body-text">
                <small class="text-muted">{{ $post->created_at->toFormattedDateString() }}</small>
            </p>
            <hr />
            <h4>Added Comments</h4>
            <ul class="list-group">
                @foreach ($post->comments as $comment)
                    <li class="list-group-item">
                        <strong>{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</strong>: {{ $comment->body }}
                    </li>
                @endforeach
            </ul>
            <hr />
            <h4>New Comment</h4>
            <form method="post" action="/posts/{{ $post->id }}/comments">
                {{ csrf_field() }}
              <div class="form-group">
                <label for="commentBody">Blog body</label>
                <textarea name="commentBody"  placeholder="Your commen here" class="form-control" id="commentBody" rows="3" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Add Comment</button>
            </form>
            @include ('layouts.errors')
          </div>
        </div>
    </div>
  </div>
@endsection
