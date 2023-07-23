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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
    <style>
        .hide {
            display: none;
        }

        .avatar:hover+.hide {
            display: flexbox;
            color: red;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <div class="form-container col-5">
            <div class="logo"><a href="{{ route('/') }}">LOGO</a></div>
            <div class="logo"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        </div>
    </div>
    <section class="px-10 py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Change personal information') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('change-details') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Change your name') }}</label>
                                    <div class="col-md-6">
                                        <input id="change-name" type="text" placeholder="{{ $user->name }}"
                                            class="form-control @error('username') is-invalid @enderror" name="username">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 p-2 offset-md-4">
                                        <button type="submit" class="btn btn-primary regi-btn">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>