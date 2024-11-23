@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-center text-3xl font-bold my-6">Termék Szerkesztése</h1>

    <!-- Hibák megjelenítése -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Szerkesztő űrlap -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <!-- Termék neve -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Termék Neve:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ $product->name }}" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required
            >
        </div>

        <!-- Leírás -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Leírás:</label>
            <textarea 
                id="description" 
                name="description" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary"
            >{{ $product->description }}</textarea>
        </div>

        <!-- Ár -->
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Ár (Ft):</label>
            <input 
                type="number" 
                id="price" 
                name="price" 
                value="{{ $product->price }}" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required 
                min="0" 
                step="0.01"
            >
        </div>

        <!-- Kategória -->
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Kategória:</label>
            <select 
                id="category" 
                name="category" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required
            >
                <option value="gyumolcsok" {{ $product->category == 'gyumolcsok' ? 'selected' : '' }}>Gyümölcsök</option>
                <option value="zoldsegek" {{ $product->category == 'zoldsegek' ? 'selected' : '' }}>Zöldségek</option>
                <option value="tejtermekek" {{ $product->category == 'tejtermekek' ? 'selected' : '' }}>Tejtermékek</option>
                <option value="hus-es-huskeszitmenyek" {{ $product->category == 'hus-es-huskeszitmenyek' ? 'selected' : '' }}>Hús és Húskészítmények</option>
                <option value="kezmuves-termekek" {{ $product->category == 'kezmuves-termekek' ? 'selected' : '' }}>Kézműves Termékek</option>
                <option value="mezek-es-lekvarok" {{ $product->category == 'mezek-es-lekvarok' ? 'selected' : '' }}>Mézek és Lekvárok</option>
                <option value="pekaruk" {{ $product->category == 'pekaruk' ? 'selected' : '' }}>Pékáruk</option>
                <option value="fuszerek-es-gyogynovenyek" {{ $product->category == 'fuszerek-es-gyogynovenyek' ? 'selected' : '' }}>Fűszerek és Gyógynövények</option>
            </select>
        </div>

        <!-- Készlet -->
        <div class="mb-4">
            <label for="stock" class="block text-sm font-medium text-gray-700">Készlet:</label>
            <input 
                type="number" 
                id="stock" 
                name="stock" 
                value="{{ $product->stock }}" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required 
                min="0"
            >
        </div>

        <!-- Új kép feltöltése -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Új kép feltöltése:</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                accept="image/*"
            >
        </div>

        <!-- Jelenlegi kép -->
        @if($product->image_path)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Jelenlegi kép:</label>
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Termék Képe" class="w-48 rounded-lg shadow-md">
            </div>
        @endif

        <!-- Beküldés gomb -->
        <button 
            type="submit" 
            class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-primary-dark transition"
        >
            Termék Frissítése
        </button>
    </form>
</div>
@endsection
