<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Forum</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.css') }}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
</head>

<body>
  <div class="form-container">
    <div class="logo"><a href="{{ route('/') }}">LOGO</a></div>
    <form method="GET" action="{{ route('posts.search') }}" id="search_form">
      @csrf
      <div class="search-bar">
        <input type="text" name="search_query" id="search_query" placeholder="Search...">
        <button type="submit">Search</button>
      </div>
    </form>
    @if (Auth::check())
    <div class="profile btn-login-signup">
      <div class="avatar" style="margin-right: 30px">
        <a href="{{ route('dashboard') }}">
          <img src="{{ asset(Auth::user()->avatar) }}" alt="">
        </a>
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" id="log-form">
      @csrf
      <button class="btn btn-primary btn-login-signup" id="logout" type="submit">Logout</button>
    </form>
    @else
    <div class="auth-buttons">
      <a href="{{ route('login') }}" class="btn btn-primary btn-login-signup ">Login</a>
      <a href="{{ route('register') }}" class="btn btn-secondary btn-login-signup">Sign Up</a>
    </div>
    @endif
  </div>

  <div id="search_results"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2">
        {{-- Left functions --}}
        <div class="btn-group-vertical">
          @if (Auth::check())
          <a class="btn btn-primary" href="{{ route('thread') }}">
            {{ __('New Thread') }}
          </a>
          @else
          <a class="btn btn-primary" href="{{ route('login') }}">
            {{ __('New Thread') }}
          </a>
          @endif
          <div class="dropdown">
            <h1>Categories</h1>
            <div class="list-group">
              <a class="list-group-item" href="/forum/public/">ALL</a>
              <a class="list-group-item" href="/forum/public/categories/math">Math</a>
              <a class="list-group-item" href="/forum/public/categories/data_science">Data Science</a>
              <a class="list-group-item" href="/forum/public/categories/computer_science">Computer Science</a>
              <a class="list-group-item" href="/forum/public/categories/software_engineering">Software Engineering</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-10">
        {{-- Right content --}}
        <section class="index_page" id="posts-container">
          {{ $slot }}
        </section>

        <script>
          var botmanWidget={
            aboutText:"Welcome",
            introMessage:"Hi! From laravel forum"
          }
        </script>

        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

        <script type="text/javascript">
          var route = "{{ route('posts.autocomplete') }}";
          $('#search_query').typeahead({
            source: function (query, process) {
              return $.get(route, { 
                query: query }, function (data) {
                  return process(data);
                });
              }
          });
        </script>
        

</body>


</html>