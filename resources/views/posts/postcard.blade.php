<div class="col-md-4">
  <div class="card mb-4 box-shadow">
    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
    <div class="card-body">
      <p class="card-text">{{ $post->title }}.</p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-outline-secondary"><a href="/posts/{{ $post->id }}">View</a></button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
        </div>
        <small class="text-muted">{{ $post->created_at->toFormattedDateString() }}</small>
        <small class="text-muted">{{ $post->user->name }}</small>
      </div>
    </div>
  </div>
</div>
