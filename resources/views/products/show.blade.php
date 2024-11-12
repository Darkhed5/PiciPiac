@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>

    <!-- Kép megjelenítése, ha van -->
    @if($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" style="width: 300px; height: auto;" class="mb-4">
    @else
        <p>Nincs kép feltöltve</p>
    @endif

    <p><strong>Leírás:</strong> {{ $product->description }}</p>
    <p><strong>Ár:</strong> {{ $product->price }} Ft</p>
    <p><strong>Kategória:</strong> {{ $product->category }}</p>
    <p><strong>Készlet:</strong> {{ $product->stock > 0 ? 'Raktáron' : 'Elfogyott' }}</p>

    <a href="{{ url('/products/' . $product->id . '/edit') }}" class="btn btn-warning">Szerkesztés</a>

    <form action="{{ url('/products/' . $product->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">Törlés</button>
    </form>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Vissza a termékekhez</a>
</div>
@endsection
