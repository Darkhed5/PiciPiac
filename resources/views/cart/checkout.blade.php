@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rendelés leadása</h1>

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

        <table class="table">
            <thead>
                <tr>
                    <th>Termék</th>
                    <th>Darabszám</th>
                    <th>Egységár</th>
                    <th>Összeg</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>{{ $cartItem->quantity }}</td>
                        <td>{{ $cartItem->product->price }} Ft</td>
                        <td>{{ $cartItem->quantity * $cartItem->product->price }} Ft</td>
                    </tr>
                    <input type="hidden" name="items[{{ $cartItem->id }}][product_id]" value="{{ $cartItem->product_id }}">
                    <input type="hidden" name="items[{{ $cartItem->id }}][quantity]" value="{{ $cartItem->quantity }}">
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <h4>Összesen: {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }} Ft</h4>
        </div>

        <div class="form-group mt-3">
            <label for="notes">Megjegyzés:</label>
            <textarea name="notes" id="notes" class="form-control" placeholder="Adjon hozzá megjegyzést..."></textarea>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">Rendelés leadása</button>
        </div>
    </form>
</div>
@endsection
