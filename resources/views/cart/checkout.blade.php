@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rendelés Leadása</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <!-- Kosár tételek -->
        @foreach($cartItems as $cartItem)
            <input type="hidden" name="items[{{ $cartItem->id }}][product_id]" value="{{ $cartItem->product_id }}">
            <input type="hidden" name="items[{{ $cartItem->id }}][quantity]" value="{{ $cartItem->quantity }}">
            <p>{{ $cartItem->product->name }} - {{ $cartItem->quantity }} x {{ $cartItem->product->price }} Ft</p>
        @endforeach

        <!-- Megjegyzés mező -->
        <div class="form-group mb-3">
            <label for="notes">Megjegyzés az eladónak:</label>
            <textarea name="notes" id="notes" class="form-control" placeholder="Adjon hozzá megjegyzést..."></textarea>
        </div>

        <!-- Rendelés Leadása Gomb -->
        <button type="submit" class="btn btn-primary">Rendelés Leadása</button>
    </form>
</div>
@endsection
