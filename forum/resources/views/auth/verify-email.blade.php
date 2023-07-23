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
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
</head>


<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {{ __('Please check your email box and verify your account!') }}
                    </div>
                    {{-- <div class="form-group row">
                        @if (session('status') == 'verification-link-sent')
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ __('A new verification link has been sent to the email address you provided in your
                                profile settings.')
                                }}
                            </div>
                        </div>
                        @endif
                    </div> --}}

                    <div class="form-group row">
                        {{-- <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div>
                                <button type="submit" class="btn btn-primary regi-btn">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </form> --}}
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn btn-secondary regi-btn">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>