@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kosár</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

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
    @endif
</div>
@endsection
