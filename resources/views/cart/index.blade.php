@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"><u>Kosár</u></h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <p>A kosár üres.</p>
    @else
        <!-- Kosár tételek -->
        <table class="table">
            <thead>
                <tr>
                    <th>Termék</th>
                    <th>Kiszerelés</th>
                    <th>Darabszám</th>
                    <th>Ár</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td>
                            <a href="{{ route('products.show', $cartItem->product->id) }}" class="text-decoration-none text-primary">
                                {{ $cartItem->product->name }}
                            </a>
                        </td>                        
                        <td>{{ $cartItem->product->unit }}</td>
                        <td>
                            <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                                <button type="submit" class="btn btn-primary">Frissítés</button>
                            </form>
                        </td>
                        <td>{{ $cartItem->product->price * $cartItem->quantity }} Ft</td>
                        <td>
                            <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eltávolítás</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <h4>Összesen: {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }} Ft</h4>
        </div>
        <div class="text-end mt-3">
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">Tovább a kasszához</a>
        </div>
    @endif
</div>
@endsection
