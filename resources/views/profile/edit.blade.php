@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"><u>Profil szerkesztése</u></h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/profile') }}">
        @csrf

        <!-- Név -->
        <div class="form-group mb-3">
            <label for="name" class="form-label">Név:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cím -->
        <div class="form-group mb-3">
            <label for="address" class="form-label">Cím:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $user->address) }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Telefonszám -->
        <div class="form-group mb-3">
            <label for="phone_number" class="form-label">Telefonszám:</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $user->phone_number) }}">
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mentés gomb -->
        <div class="form-group text-end">
            <button type="submit" class="btn btn-primary">Mentés</button>
        </div>
    </form>
</div>
@endsection
