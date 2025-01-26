@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Rendelési előzmények</h1>

    <!-- Általam leadott rendelések -->
    <h2 class="mt-4">Általam leadott rendelések</h2>
    @if ($myOrders->isEmpty())
        <p class="text-muted">Nincsenek általad leadott rendelések.</p>
    @else
        @foreach ($myOrders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rendelés ID: #{{ $order->id }}</h5>
                    <p><strong>Dátum:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>Státusz:</strong> {{ $order->status }}</p>
                    <p><strong>Összesen:</strong> {{ number_format($order->total_price, 0, ',', ' ') }} Ft</p>
                    <h6>Tételek:</h6>
                    <ul class="list-unstyled">
                        @foreach ($order->items as $item)
                            <li>
                                {{ $item->product->name }} ({{ $item->product->unit }}) -> {{ $item->quantity }} x {{ number_format($item->price, 0, ',', ' ') }} Ft
                                = {{ number_format($item->quantity * $item->price, 0, ',', ' ') }} Ft
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Tőlem rendelt termékek -->
    <h2 class="mt-4">Tőlem rendelt termékek</h2>
    @if ($ordersToMe->isEmpty())
        <p class="text-muted">Nincsenek tőled rendelt termékek.</p>
    @else
        @foreach ($ordersToMe as $order)
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
                                {{ $item->product->name }} ({{ $item->product->unit }}) -> {{ $item->quantity }} x {{ number_format($item->price, 0, ',', ' ') }} Ft
                                = {{ number_format($item->quantity * $item->price, 0, ',', ' ') }} Ft
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
