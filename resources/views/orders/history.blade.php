@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rendelési Előzmények</h1>

    @if ($orders->isEmpty())
        <p>Nincsenek korábbi rendeléseid.</p>
    @else
        @foreach ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rendelés ID: {{ $order->id }}</h5>
                    <p><strong>Dátum:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>Állapot:</strong> {{ $order->status }}</p>
                    <p><strong>Összesen:</strong> {{ $order->total_price }} Ft</p>

                    <h6>Tételek:</h6>
                    <ul>
                        @foreach ($order->items as $item)
                            <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ $item->price }} Ft = {{ $item->quantity * $item->price }} Ft</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
