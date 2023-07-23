<x-log>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('regi') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number')
                                    }}</label>
                                    <span class="text-small text-info">* Not required</span>
                                <div class="col-md-6">
                                    <input id="phone_number" type="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ old('phone_number') }}">

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Upload Your
                                    avatar') }}</label>
                                    
                                        <span class="text-small text-info">* Not required</span>
                                   
                                
                                <div class="col-md-6">
                                    <input id="name" type="file"
                                        class="form-control @error('avatar') is-invalid @enderror" name="avatar">

                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password')
                                    }}</label>
                                <div class="col-md-4">
                                    <div id="check-password"></div>
                                </div>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{
                                    __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 p-2 offset-md-4">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                                    </div>
                                    @if(Session::has('g-recaptcha-response'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                        {{ Session::get('g-recaptcha-response') }}</p>
                                    @endif
                                    <br />
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

    <script>
        $(function() {
            $('#password').on('input', function() {
                var password = $(this).val();
                var regexes = [
                    // /^(?=.*[a-z])/,
                    // /^(?=.*[A-Z])/,
                    // /^(?=.*\d)/,
                    // /^(?=.*(_|[^\w]))/,
                    /^(?=.{8,})/
                ];
                var messages = [
                    // '* At least one uppercase letter',
                    // '* At least one lowercase letter',
                    // '* At least one digit',
                    // '* At least one special character',
                    '* The min length should be 8',
                ];
                var checkValid = '';
                // for (var i = 0; i < regexes.length; i++) {
                //     if (!regexes[i].test(password)) {
                //         checkValid += '<span style="color:red">' + messages[i] + '</span><br>';
                //     } else {
                //         checkValid += '<span style="color:green">' + messages[i] + '</span><br>';
                //     }
                // }
                if (!regexes[0].test(password)) {
                    checkValid += '<span style="color:red">' + messages[0] + '</span><br>';
                } else {
                    checkValid += '<span style="color:green">' + messages[0] + '</span><br>';
                }
                
                $('#check-password').html(checkValid);
            });
        });

    </script>
</x-log>