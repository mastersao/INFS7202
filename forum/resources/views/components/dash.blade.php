<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{--
  <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  <title>Forum</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.css') }}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <style>
    .hide {
      display: none;
    }
        
    .avatar:hover + .hide {
      display: flexbox;
      color: red;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <div class="logo"><a href="{{ route('/') }}">LOGO</a></div>
    <form action="{{ route('posts.search') }}" method="GET" id="search_form">
      <div class="search-bar">
        <input type="text" name="search_query" id="search_query" placeholder="Search...">
        <button type="submit">Search</button>
      </div>
    </form>
    <div class="profile btn-login-signup">
      <div class="avatar" style="margin-right: 30px">
        <a href="{{ route('update-avatar') }}">
          <img src="{{ asset(Auth::user()->avatar) }}" alt="">
        </a>
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" id="log-form">
      @csrf
      <button class="btn btn-primary btn-login-signup" id="logout" type="submit">Logout</button>
    </form>
  </div>

  
  <section class="container dash-container">
    {{ $slot }}
  </section>

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