@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Rendelési Előzmények</h1>

    @if ($orders->isEmpty())
        <p class="text-muted">Nincsenek korábbi rendeléseid.</p>
    @else
        @foreach ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rendelés ID: #{{ $order->id }}</h5>
                    <p><strong>Dátum:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>Státusz:</strong> 
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <div class="d-flex align-items-center">
                                <select name="status" class="form-select me-2" onchange="this.form.submit()">
                                    <option value="feldolgozás alatt" {{ $order->status == 'feldolgozás alatt' ? 'selected' : '' }}>Feldolgozás alatt</option>
                                    <option value="átvehető" {{ $order->status == 'átvehető' ? 'selected' : '' }}>Átvehető</option>
                                    <option value="átvéve" {{ $order->status == 'átvéve' ? 'selected' : '' }}>Átvéve</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Frissítés</button>
                            </div>
                        </form>
                    </p>
                    <p><strong>Összesen:</strong> {{ number_format($order->total_price, 0, ',', ' ') }} Ft</p>

                    <h6>Tételek:</h6>
                    <ul class="list-unstyled">
                        @foreach ($order->items as $item)
                            <li>
                                {{ $item->product->name }} - {{ $item->quantity }} x {{ number_format($item->price, 0, ',', ' ') }} Ft 
                                = {{ number_format($item->quantity * $item->price, 0, ',', ' ') }} Ft
                            </li>
                        @endforeach
                    </ul>

                    <!-- Részletek gomb -->
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary btn-sm mt-3">Részletek megtekintése</a>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
