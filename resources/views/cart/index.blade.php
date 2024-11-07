@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kosár</h1>

    <!-- Sikeres üzenet megjelenítése -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Kosár tartalmának ellenőrzése -->
    @if ($cartItems->isEmpty())
        <p>A kosarad üres.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Termék</th>
                    <th>Mennyiség</th>
                    <th>Ár</th>
                    <th>Összesen</th>
                    <th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->price }} Ft</td>
                        <td>{{ $item->product->price * $item->quantity }} Ft</td>
                        <td>
                            <!-- Termék törlése a kosárból -->
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket a kosárból?')">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Kosár összesített ára -->
        <div class="mb-3">
            <h4>Összesen: {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }} Ft</h4>
        </div>

        <!-- Megrendelés leadása gomb -->
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Megrendelés Leadása</button>
        </form>
    @endif
</div>
@endsection
