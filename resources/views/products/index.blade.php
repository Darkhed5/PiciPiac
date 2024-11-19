@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Termékkatalógus</h1>

    <!-- Kategória szűrő -->
    <form method="GET" action="{{ url('/products') }}" class="mb-4">
        <label for="category">Kategória:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">Összes</option>
            <option value="gyumolcsok" {{ request('category') == 'gyumolcsok' ? 'selected' : '' }}>Gyümölcsök</option>
            <option value="zoldsegek" {{ request('category') == 'zoldsegek' ? 'selected' : '' }}>Zöldségek</option>
            <option value="tejtermekek" {{ request('category') == 'tejtermekek' ? 'selected' : '' }}>Tejtermékek</option>
            <option value="hus-es-huskeszitmenyek" {{ request('category') == 'hus-es-huskeszitmenyek' ? 'selected' : '' }}>Hús és húskészítmények</option>
            <option value="kezmuves-termekek" {{ request('category') == 'kezmuves-termekek' ? 'selected' : '' }}>Kézműves termékek</option>
            <option value="mezek-es-lekvarok" {{ request('category') == 'mezek-es-lekvarok' ? 'selected' : '' }}>Mézek és lekvárok</option>
            <option value="pekaruk" {{ request('category') == 'pekaruk' ? 'selected' : '' }}>Pékáruk</option>
            <option value="fuszerek-es-gyogynovenyek" {{ request('category') == 'fuszerek-es-gyogynovenyek' ? 'selected' : '' }}>Fűszerek és gyógynövények</option>
        </select>
    </form>

    <!-- Termékek listája -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="Product Image">
                    @else
                        <p class="text-center mt-3">Nincs kép feltöltve</p>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Ár:</strong> {{ $product->price }} Ft</p>
                        <p class="card-text"><strong>Készlet:</strong> {{ $product->stock > 0 ? 'Raktáron' : 'Elfogyott' }}</p>

                        <!-- Szerkesztés és Törlés Gombok -->
                        <a href="{{ url('/products/' . $product->id) }}" class="btn btn-info">Részletek</a>
                        <a href="{{ url('/products/' . $product->id . '/edit') }}" class="btn btn-primary">Szerkesztés</a>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Hozzáadás a kosárhoz</button>
                        </form>

                        <form action="{{ url('/products/' . $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">Törlés</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Nincsenek elérhető termékek ebben a kategóriában.</p>
        @endforelse
    </div>
</div>
@endsection