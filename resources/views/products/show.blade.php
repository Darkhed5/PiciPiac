@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-center text-3xl font-bold my-6">{{ $product->name }}</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Termékkép megjelenítése -->
        <div>
            @if($product->image_path)
            <div class="mb-4 col-12 col-md-4 mx-auto">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Termék képe" class="rounded shadow img-fluid">
            </div>
            @else
                <div class="text-center text-gray-500 bg-gray-100 p-6 rounded">
                    <p>Nincs kép feltöltve</p>
                </div>
            @endif
        </div>

        <!-- Termékinformációk -->
        <div>
            <div class="bg-white p-5 rounded shadow">
                <p class="mb-4"><strong>Leírás:</strong> {{ $product->description }}</p>
                <p class="mb-4"><strong>Ár:</strong> 
                    <span class="text-primary font-semibold">
                        {{ number_format($product->price, 0, ' ', ' ') }} Ft
                    </span>
                </p>
                <p class="mb-4"><strong>Kategória:</strong> {{ $product->category }}</p>
                <p class="mb-4"><strong>Készlet:</strong> 
                    {{ number_format($product->quantity, 0, '', ' ') }} {{ $product->unit }}
                </p>
            </div>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn bg-primary text-white px-4 py-2 rounded">
                    Vissza a termékekhez
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
