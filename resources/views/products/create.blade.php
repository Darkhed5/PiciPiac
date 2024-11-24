@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-center text-3xl font-bold my-6">Hirdetésfeladás</h1>

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

    <!-- Űrlap -->
    <form method="POST" action="{{ url('/products') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <!-- Termék neve -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Termék Neve:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
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
            ></textarea>
        </div>

        <!-- Ár -->
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Ár (Ft):</label>
            <input 
                type="number" 
                id="price" 
                name="price" 
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
                <option value="gyumolcsok">Gyümölcsök</option>
                <option value="zoldsegek">Zöldségek</option>
                <option value="tejtermekek">Tejtermékek</option>
                <option value="hus-es-huskeszitmenyek">Hús és húskészítmények</option>
                <option value="kezmuves-termekek">Kézműves termékek</option>
                <option value="mezek-es-lekvarok">Mézek és lekvárok</option>
                <option value="pekaruk">Pékáruk</option>
                <option value="fuszerek-es-gyogynovenyek">Fűszerek és gyógynövények</option>
            </select>
        </div>

        <!-- Készlet -->
        <div class="mb-4">
            <label for="stock" class="block text-sm font-medium text-gray-700">Készlet:</label>
            <input 
                type="number" 
                id="stock" 
                name="stock" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required 
                min="0"
            >
        </div>

        <!-- Kép feltöltés -->
        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700">Kép:</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                accept="image/*"
            >
        </div>

        <!-- Beküldés gomb -->
        <button 
            type="submit" 
            class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-primary-dark transition"
        >
            Termék hozzáadása
        </button>
    </form>
</div>
@endsection
