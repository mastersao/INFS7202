<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--
    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>Layout</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typeahead.js@0.11.1/dist/typeahead.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
</head>

<body>
    <div class="form-container col-5">
        <div class="logo"><a href="{{ route('/') }}">LOGO</a></div>
        <div class="logo"><a href="{{ route('dashboard') }}">Dashboard</a></div>
    </div>
    <section class="px-10 py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Change avatar') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('change-avatar') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Upload Your
                                        avatar') }}</label>
                                    <span class="text-small text-info"></span>
                                    <div class="col-md-6">
                                        <input id="avatar" type="file"
                                            class="form-control @error('avatar') is-invalid @enderror" name="avatar">

                                        @error('avatar')
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