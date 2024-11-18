@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-light">
                    <h4>{{ __('passwords.reset_password') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Token elrejtve az űrlaphoz -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- E-mail mező -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('passwords.email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Új jelszó mező -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('passwords.new_password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Jelszó megerősítése mező -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('passwords.confirm_password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <!-- Gomb a jelszó visszaállításához -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-50">
                                {{ __('passwords.reset') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
