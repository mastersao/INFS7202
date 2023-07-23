<x-log>
    <div class="container" style="margin-top: 50px">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-header">{{ __('Two factor authentication') }}</div>
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        @if(! Auth::user()->two_factor_secret)
                            You have not enabled 2fa
                            <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    Enable
                                </button>
                            </form>
                        @else
                            You have 2fa enabled
                            <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Disable
                                </button>
                            </form>
                        @endif

                        

                        @if(session('status') == 'two-factor-authentication-enabled')
                        <p>
                            You have now enabled 2-factor, please scan the following QR code.
                            {!! Auth::user()->twoFactorQrCodeSvg() !!}
                        </p>

                        <p>
                            Please keep a record of the following recovery codes in a secure location:
                        </p>
                        @foreach (json_decode(decrypt(Auth::user()->two_factor_recovery_codes, true)) as $code)
                        {{ trim($code) }}
                        <br>
                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-log>