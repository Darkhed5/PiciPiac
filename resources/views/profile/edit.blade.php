@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profil Szerkesztése</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/profile') }}">
        @csrf

        <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="address">Cím:</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
        </div>

        <div class="form-group">
            <label for="phone_number">Telefonszám:</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Profil Frissítése</button>
    </form>
</div>
@endsection
