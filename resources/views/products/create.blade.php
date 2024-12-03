@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hibák megjelenítése -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Űrlap -->
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <!-- Kép feltöltés -->
        <div class="mb-4 text-center">
            <label for="image" class="form-label">Fényképek feltöltése</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Név -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Termék Neve:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required 
                value="{{ old('name') }}"
            >
        </div>

        <!-- Leírás -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Leírás:</label>
            <textarea 
                id="description" 
                name="description" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary"
                rows="4"
            >{{ old('description') }}</textarea>
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
                value="{{ old('price') }}"
            >
        </div>

        <!-- Kategória -->
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Kategória:</label>
            <select 
                id="category" 
