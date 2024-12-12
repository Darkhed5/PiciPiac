@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-5">Üdvözlünk a PiciPiacon!</h1>
    <p class="text-center">
        A PiciPiac egy online piactér, amely összekapcsolja a helyi termelőket és vásárlókat.
        Fedezd fel friss, helyi termékeinket!
    </p>

    <!-- Kategóriák szekció -->
    <div class="categories-section mt-5">
        <h2 class="text-center mb-4">Kategóriák</h2>
        <div class="row justify-content-center">
            @if($categories->isNotEmpty())
                @foreach($categories as $category)
                    <div class="col-md-3 mb-3">
                        <div class="card text-center border-success">
                            <div class="card-body">
                                <h5 class="card-title">{{ $category->category }}</h5>
                                <a href="{{ route('products.index', ['category' => $category->category]) }}" class="btn btn-outline-success">Keresés</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Jelenleg nincsenek elérhető kategóriák.</p>
            @endif
        </div>
    </div>

    <!-- Népszerű termékek -->
    <div class="popular-products-section mt-5">
        <h2 class="text-center mb-4">Népszerű termékek</h2>
        <div class="row">
            @if($popularProducts->isNotEmpty())
                @foreach($popularProducts as $product)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-success fw-bold">{{ $product->price }} Ft</p>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">Megnézem</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Jelenleg nincsenek népszerű termékek.</p>
            @endif
        </div>
    </div>
</div>
@endsection
