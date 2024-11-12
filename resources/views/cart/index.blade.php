@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kosár</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <p>A kosár üres.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Termék</th>
                    <th>Darabszám</th>
                    <th>Ár</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->product->name }}</td>
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
    @endif
</div>
@endsection
