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
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="bg-white p-5 rounded shadow-lg">
        @csrf

        <!-- Kép feltöltés -->
        <div class="mb-4">
            <label for="image" class="form-label">Fényképek feltöltése</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Név -->
        <div class="mb-4">
            <label for="name" class="form-label">Termék Neve:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control" 
                required 
                value="{{ old('name') }}"
            >
        </div>

        <!-- Leírás -->
        <div class="mb-4">
            <label for="description" class="form-label">Leírás:</label>
            <textarea 
                id="description" 
                name="description" 
                class="form-control" 
                rows="4"
            >{{ old('description') }}</textarea>
        </div>

        <!-- Ár -->
        <div class="mb-4">
            <label for="price" class="form-label">Ár (Ft):</label>
            <input 
                type="number" 
                id="price" 
                name="price" 
                class="form-control" 
                required 
                min="0" 
                step="0.01"
                value="{{ old('price') }}"
            >
        </div>

        <!-- Kategória -->
        <div class="mb-4">
            <label for="category" class="form-label">Kategória:</label>
            <select id="category" name="category" class="form-select" required>
                <option value="" disabled selected>Válassz kategóriát</option>
                <option value="gyumolcsok" {{ old('category') == 'gyumolcsok' ? 'selected' : '' }}>Gyümölcsök</option>
                <option value="zoldsegek" {{ old('category') == 'zoldsegek' ? 'selected' : '' }}>Zöldségek</option>
                <option value="tejtermekek" {{ old('category') == 'tejtermekek' ? 'selected' : '' }}>Tejtermékek</option>
                <option value="hus-es-huskeszitmenyek" {{ old('category') == 'hus-es-huskeszitmenyek' ? 'selected' : '' }}>Húsok és húskészítmények</option>
                <option value="mezek-es-lekvarok" {{ old('category') == 'mezek-es-lekvarok' ? 'selected' : '' }}>Mézek és lekvárok</option>
                <option value="pekaruk" {{ old('category') == 'pekaruk' ? 'selected' : '' }}>Pékáruk</option>
                <option value="fuszerek-es-gyogynovenyek" {{ old('category') == 'fuszerek-es-gyogynovenyek' ? 'selected' : '' }}>Fűszerek és gyógynövények</option>
                <option value="kezmuves-termekek" {{ old('category') == 'kezmuves-termekek' ? 'selected' : '' }}>Kézműves termékek</option>
            </select>
        </div>

        <!-- Beküldés -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Termék Hozzáadása</button>
        </div>
    </form>
</div>
@endsection
