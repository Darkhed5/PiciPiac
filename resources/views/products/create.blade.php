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

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="bg-white p-5 rounded shadow-lg">
        @csrf

        <div class="mb-4">
            <label for="image" class="form-label">Fényképek feltöltése</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-4">
            <label for="name" class="form-label">Termék neve:</label>
            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Leírás:</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="form-label">Ár (Ft):</label>
            <input type="number" id="price" name="price" class="form-control" required min="0" step="0.01" value="{{ old('price') }}">
        </div>

        <div class="mb-4">
            <label for="quantity" class="form-label">Mennyiség:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" min="0" step="0.01" required value="{{ old('quantity') }}">
        </div>

        <div class="mb-4">
            <label for="unit" class="form-label">Kiszerelés:</label>
            <select id="unit" name="unit" class="form-select" required>
                <option value="" disabled selected>Válassz kiszerelést</option>
                <option value="g" {{ old('unit') == 'g' ? 'selected' : '' }}>gramm</option>
                <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>kilogramm</option>
                <option value="l" {{ old('unit') == 'l' ? 'selected' : '' }}>liter</option>
                <option value="db" {{ old('unit') == 'db' ? 'selected' : '' }}>darab</option>
                <option value="csomag" {{ old('unit') == 'csomag' ? 'selected' : '' }}>csomag</option>
            </select>
        </div>

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

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Termék hozzáadása</button>
        </div>
    </form>
</div>
@endsection
