@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">{{ $product->name }}</h1>

    <div class="row">
        <!-- Termékkép megjelenítése -->
        <div class="col-md-6 mb-4">
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="img-fluid rounded shadow">
            @else
                <p class="text-center text-muted">Nincs kép feltöltve</p>
            @endif
        </div>

        <!-- Termékinformációk -->
        <div class="col-md-6">
            <p><strong>Leírás:</strong> {{ $product->description }}</p>
            <p><strong>Ár:</strong> {{ $product->price }} Ft</p>
            <p><strong>Kategória:</strong> {{ $product->category }}</p>
            <p><strong>Készlet:</strong> {{ $product->stock > 0 ? 'Raktáron' : 'Elfogyott' }}</p>

            <!-- Szerkesztés gomb -->
            <a href="{{ url('/products/' . $product->id . '/edit') }}" class="btn btn-primary mb-2">Szerkesztés</a>

            <!-- Törlés gomb -->
            <form action="{{ url('/products/' . $product->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-2" onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">Törlés</button>
            </form>

            <!-- Vissza a termékekhez gomb -->
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Vissza a termékekhez</a>
        </div>
    </div>
</div>
@endsection
