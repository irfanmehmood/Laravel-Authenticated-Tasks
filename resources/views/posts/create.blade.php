@extends ('layouts.master')
@section ('content')
  <div class="album py-5 bg-light">
    <div class="container">
        <p>
            Create Blog
        </p>
        <form method="post" action="/posts">
            {{ csrf_field() }}
          <div class="form-group">
            <label for="blogTitle"></label>
            <input type="text" class="form-control" id="blogTitle" name="blogTitle" aria-describedby="emailHelp" placeholder="Enter blog title" required>
          </div>
          <div class="form-group">
            <label for="blogBody">Blog body</label>
            <textarea name="blogBody" class="form-control" id="blogBody" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @include ('layouts.errors')
    </div>
  </div>
@endsection
