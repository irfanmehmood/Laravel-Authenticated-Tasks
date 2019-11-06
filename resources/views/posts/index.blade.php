@extends ('layouts.master')
@section ('content')
<section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Recent Posts</h1>
      <p class="lead text-muted">Recent Posts</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
          @foreach ($posts as $post)
            @include ('posts.postcard')
          @endforeach
      </div>
    </div>
  </div>

@endsection
