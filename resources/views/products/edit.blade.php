@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="bg-white p-5 rounded shadow-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="image" class="form-label">Új fénykép feltöltése</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        @if($product->image_path)
            <div class="mb-4">
                <label class="form-label">Jelenlegi kép:</label>
                <div>
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="Termék képe" class="img-fluid rounded shadow">
                </div>
            </div>
        @endif

        <div class="mb-4">
            <label for="name" class="form-label">Termék neve:</label>
            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Leírás:</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="form-label">Ár (Ft):</label>
            <input type="number" id="price" name="price" class="form-control" required min="0" step="1" value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-4">
            <label for="quantity" class="form-label">Mennyiség:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" min="0" step="0.01" required value="{{ old('quantity', $product->quantity) }}">
        </div>

        <div class="mb-4">
            <label for="unit" class="form-label">Kiszerelés:</label>
            <select id="unit" name="unit" class="form-select" required>
                <option value="g" {{ old('unit', $product->unit) == 'g' ? 'selected' : '' }}>gramm</option>
                <option value="kg" {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>kilogramm</option>
                <option value="l" {{ old('unit', $product->unit) == 'l' ? 'selected' : '' }}>liter</option>
                <option value="db" {{ old('unit', $product->unit) == 'db' ? 'selected' : '' }}>darab</option>
                <option value="csomag" {{ old('unit', $product->unit) == 'csomag' ? 'selected' : '' }}>csomag</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="category" class="form-label">Kategória:</label>
            <select id="category" name="category" class="form-select" required>
                <option value="gyumolcsok" {{ old('category', $product->category) == 'gyumolcsok' ? 'selected' : '' }}>Gyümölcsök</option>
                <option value="zoldsegek" {{ old('category', $product->category) == 'zoldsegek' ? 'selected' : '' }}>Zöldségek</option>
                <option value="tejtermekek" {{ old('category', $product->category) == 'tejtermekek' ? 'selected' : '' }}>Tejtermékek</option>
                <option value="hus-es-huskeszitmenyek" {{ old('category', $product->category) == 'hus-es-huskeszitmenyek' ? 'selected' : '' }}>Húsok és húskészítmények</option>
                <option value="mezek-es-lekvarok" {{ old('category', $product->category) == 'mezek-es-lekvarok' ? 'selected' : '' }}>Mézek és lekvárok</option>
                <option value="pekaruk" {{ old('category', $product->category) == 'pekaruk' ? 'selected' : '' }}>Pékáruk</option>
                <option value="fuszerek-es-gyogynovenyek" {{ old('category', $product->category) == 'fuszerek-es-gyogynovenyek' ? 'selected' : '' }}>Fűszerek és gyógynövények</option>
                <option value="kezmuves-termekek" {{ old('category', $product->category) == 'kezmuves-termekek' ? 'selected' : '' }}>Kézműves termékek</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Termék frissítése</button>
        </div>
    </form>
</div>
@endsection
