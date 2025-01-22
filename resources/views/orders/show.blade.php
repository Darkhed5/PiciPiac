@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Rendelés Részletei</h1>
    <p><strong>Rendelés ID:</strong> #{{ $order->id }}</p>
    <p><strong>Státusz:</strong> {{ $order->status }}</p>
    <p><strong>Leadva:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

    <h2 class="mt-4">Tételek</h2>
    <ul class="list-group">
        @foreach ($order->items as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $item->product->name }} (x{{ $item->quantity }})
                <span>{{ number_format($item->price * $item->quantity, 0, ' ', ' ') }} Ft</span>
            </li>
        @endforeach
    </ul>

    <h3 class="mt-4">Teljes összeg: {{ number_format($order->total_price, 0, ' ', ' ') }} Ft</h3>
</div>
@endsection
