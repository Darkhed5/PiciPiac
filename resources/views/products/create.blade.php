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
<<<<<<< HEAD
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
=======
    <form method="POST" action="{{ url('/products') }}" enctype="multipart/form-data" class="bg-white p-5 rounded-lg shadow-sm">
>>>>>>> ab5eac1ce6a9a9f41110f3cc8df1e41ef45b0a8c
        @csrf

        <!-- Kép feltöltés -->
        <div class="mb-4 text-center">
            <label for="image" class="form-label">Fényképek feltöltése</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Név -->
        <div class="mb-4">
<<<<<<< HEAD
            <label for="name" class="block text-sm font-medium text-gray-700">Termék Neve:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required 
                value="{{ old('name') }}"
            >
=======
            <label for="name" class="form-label">Cím:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="pl. bio alma" required>
>>>>>>> ab5eac1ce6a9a9f41110f3cc8df1e41ef45b0a8c
        </div>

        <!-- Leírás -->
        <div class="mb-4">
<<<<<<< HEAD
            <label for="description" class="block text-sm font-medium text-gray-700">Leírás:</label>
            <textarea 
                id="description" 
                name="description" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary"
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
=======
            <label for="description" class="form-label">Adj leírást a termékedhez:</label>
            <textarea id="description" name="description" class="form-control" placeholder="pl. héja vékony, íze édes" rows="3"></textarea>
>>>>>>> ab5eac1ce6a9a9f41110f3cc8df1e41ef45b0a8c
        </div>

        <!-- Kategória -->
        <div class="mb-4">
<<<<<<< HEAD
            <label for="category" class="block text-sm font-medium text-gray-700">Kategória:</label>
            <select 
                id="category" 
                name="category" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required
            >
                <option value="gyumolcsok" {{ old('category') == 'gyumolcsok' ? 'selected' : '' }}>Gyümölcsök</option>
                <option value="zoldsegek" {{ old('category') == 'zoldsegek' ? 'selected' : '' }}>Zöldségek</option>
                <option value="tejtermekek" {{ old('category') == 'tejtermekek' ? 'selected' : '' }}>Tejtermékek</option>
                <option value="hus-es-huskeszitmenyek" {{ old('category') == 'hus-es-huskeszitmenyek' ? 'selected' : '' }}>Hús és húskészítmények</option>
                <option value="kezmuves-termekek" {{ old('category') == 'kezmuves-termekek' ? 'selected' : '' }}>Kézműves termékek</option>
                <option value="mezek-es-lekvarok" {{ old('category') == 'mezek-es-lekvarok' ? 'selected' : '' }}>Mézek és lekvárok</option>
                <option value="pekaruk" {{ old('category') == 'pekaruk' ? 'selected' : '' }}>Pékáruk</option>
                <option value="fuszerek-es-gyogynovenyek" {{ old('category') == 'fuszerek-es-gyogynovenyek' ? 'selected' : '' }}>Fűszerek és gyógynövények</option>
=======
            <label for="category" class="form-label">Kategória:</label>
            <select id="category" name="category" class="form-select" required>
                <option value="" disabled selected>Válassz ki egy kategóriát</option>
                <option value="gyumolcsok">Gyümölcsök</option>
                <option value="zoldsegek">Zöldségek</option>
                <option value="tejtermekek">Tejtermékek</option>
                <option value="hus-es-huskeszitmenyek">Húsok és húskészítmények</option>
                <option value="mezek-es-lekvarok">Mézek és lekvárok</option>
                <option value="pekaruk">Pékáruk</option>
                <option value="fuszerek-es-gyogynovenyek">Fűszerek és gyógynövények</option>
                <option value="kezmuves-termekek">Kézműves termékek</option>
>>>>>>> ab5eac1ce6a9a9f41110f3cc8df1e41ef45b0a8c
            </select>
        </div>

        <!-- Ár -->
        <div class="mb-4">
<<<<<<< HEAD
            <label for="stock" class="block text-sm font-medium text-gray-700">Készlet:</label>
            <input 
                type="number" 
                id="stock" 
                name="stock" 
                class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" 
                required 
                min="0"
                value="{{ old('stock') }}"
            >
=======
            <label for="price" class="form-label">Ár (Ft):</label>
            <input type="number" id="price" name="price" class="form-control" min="0" step="1" placeholder="0 Ft" required>
>>>>>>> ab5eac1ce6a9a9f41110f3cc8df1e41ef45b0a8c
        </div>

        <!-- Gomb -->
        <div class="text-center">
            <button type="submit" class="btn btn-success w-50">Feltöltés</button>
        </div>
    </form>
</div>
@endsection
