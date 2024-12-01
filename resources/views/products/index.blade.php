@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Keresősáv és kategória szűrő -->
    <form method="GET" action="{{ url('/products') }}" class="mb-4 d-flex flex-wrap gap-3 justify-content-between align-items-center">
        <input type="text" name="search" class="form-control w-50" placeholder="Keresés termékek között..." value="{{ request('search') }}">
        <select name="category" class="form-select w-25">
            <option value="">Minden kategóriában</option>
            <option value="gyumolcsok" {{ request('category') == 'gyumolcsok' ? 'selected' : '' }}>Gyümölcsök</option>
            <option value="zoldsegek" {{ request('category') == 'zoldsegek' ? 'selected' : '' }}>Zöldségek</option>
            <option value="tejtermekek" {{ request('category') == 'tejtermekek' ? 'selected' : '' }}>Tejtermékek</option>
            <option value="hus-es-huskeszitmenyek" {{ request('category') == 'hus-es-huskeszitmenyek' ? 'selected' : '' }}>Húsok és húskészítmények</option>
            <option value="mezek-es-lekvarok" {{ request('category') == 'mezek-es-lekvarok' ? 'selected' : '' }}>Mézek és lekvárok</option>
            <option value="pekaruk" {{ request('category') == 'pekaruk' ? 'selected' : '' }}>Pékáruk</option>
            <option value="fuszerek-es-gyogynovenyek" {{ request('category') == 'fuszerek-es-gyogynovenyek' ? 'selected' : '' }}>Fűszerek és gyógynövények</option>
            <option value="kezmuves-termekek" {{ request('category') == 'kezmuves-termekek' ? 'selected' : '' }}>Kézműves termékek</option>
        </select>
        <button type="submit" class="btn btn-primary">Keresés</button>
    </form>

    <!-- Termékek listája -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
        <div class="col">
            <div class="card h-100">
                @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                <div class="text-center p-4">Nincs kép feltöltve</div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-truncate">{{ $product->description }}</p>
                    <p class="text-muted">Ár: {{ $product->price }} Ft</p>
                </div>
                <div class="card-footer bg-white text-center">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">Kosárba</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-danger">Nincsenek elérhető termékek ebben a kategóriában.</p>
        @endforelse
    </div>

    <!-- Lapozás -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
