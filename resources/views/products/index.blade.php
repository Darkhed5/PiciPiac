@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Termékek listája -->
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse($products as $product)
        <div class="col">
            <div class="card h-100">
                @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                <div class="text-center p-4">Nincs kép feltöltve</div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
                    </h5>
                    <p class="text-muted">{{ number_format($product->price, 0, '', ' ') }} Ft</p>
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
        <p class="text-center text-danger">Nincsenek elérhető termékek.</p>
        @endforelse
    </div>

    <!-- Lapozás -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
