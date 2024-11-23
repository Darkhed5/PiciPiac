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
                <div class="text-center text-muted bg-light p-5 rounded">
                    <p>Nincs kép feltöltve</p>
                </div>
            @endif
        </div>

        <!-- Termékinformációk -->
        <div class="col-md-6">
            <div class="mb-3">
                <p><strong>Leírás:</strong> {{ $product->description }}</p>
                <p><strong>Ár:</strong> {{ $product->price }} Ft</p>
                <p><strong>Kategória:</strong> {{ $product->category }}</p>
                <p><strong>Készlet:</strong> {{ $product->stock > 0 ? 'Raktáron' : 'Elfogyott' }}</p>
            </div>

            <!-- Műveletek -->
            <div class="d-flex flex-wrap gap-2">
                <!-- Szerkesztés gomb -->
                <a href="{{ url('/products/' . $product->id . '/edit') }}" class="btn btn-primary">Szerkesztés</a>

                <!-- Törlés gomb -->
                <form action="{{ url('/products/' . $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">Törlés</button>
                </form>
            </div>

            <!-- Vissza a termékekhez gomb -->
            <div class="mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Vissza a termékekhez</a>
            </div>
        </div>
    </div>
</div>
@endsection
