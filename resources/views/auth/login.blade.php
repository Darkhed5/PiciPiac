@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('Belépés') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Felhasználónév vagy e-mail:</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Jelszó:</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <div class="form-check position-absolute">
                                    <input type="checkbox" id="showPassword" class="form-check-input">
                                    <label class="form-check-label" for="showPassword">Mutasd</label>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none text-success" href="{{ route('password.request') }}">Elfelejtetted a jelszavad?</a>
                            @endif
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-success w-100">Belépek</button>
                        </div>

                        <div class="text-center">
                            Nincs még fiókod? <a href="{{ route('register') }}" class="text-success">Regisztrálj most!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
