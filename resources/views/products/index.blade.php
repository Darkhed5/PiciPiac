@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Termékkatalógus</h1>

    <!-- Keresőmező és Kategória szűrő -->
    <form method="GET" action="{{ url('/products') }}" class="mb-4 d-flex flex-wrap justify-content-between align-items-center">
        <!-- Keresőmező -->
        <div class="flex-grow-1 me-3">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Keresés termékek között..."
                value="{{ request('search') }}"
            >
        </div>

        <!-- Kategória szűrő -->
        <div class="me-3">
            <label for="category" class="me-2">Kategória:</label>
            <select name="category" id="category" class="form-select" onchange="this.form.submit()">
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
        </div>

        <!-- Keresés gomb -->
        <button type="submit" class="btn btn-primary">Keresés</button>
    </form>

    <!-- Keresés eredményének ellenőrzése -->
    @if(request('search') && $products->isEmpty())
        <p class="text-center text-danger">Nincs találat a keresésre: "{{ request('search') }}"</p>
    @endif

    <!-- Termékek listája -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="Product Image">
                    @else
                        <p class="text-center mt-3">Nincs kép feltöltve</p>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text flex-grow-1">{{ $product->description }}</p>
                        <p class="card-text"><strong>Ár:</strong> {{ $product->price }} Ft</p>
                        <p class="card-text"><strong>Készlet:</strong> {{ $product->stock > 0 ? 'Raktáron' : 'Elfogyott' }}</p>

                        <!-- Gombok -->
                        <a href="{{ url('/products/' . $product->id) }}" class="btn btn-info mb-2">Részletek</a>
                        <a href="{{ url('/products/' . $product->id . '/edit') }}" class="btn btn-primary mb-2">Szerkesztés</a>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success mb-2">Kosárba</button>
                        </form>

                        <form action="{{ url('/products/' . $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-2" onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">Törlés</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Nincsenek elérhető termékek.</p>
        @endforelse
    </div>

    <!-- Lapozás -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
