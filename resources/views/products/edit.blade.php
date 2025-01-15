@extends('layouts.app')

@section('content')
<style>
    ::-webkit-file-upload-button {
   display: none;
}
::file-selector-button {
  display: none;
}
</style>
    <div class="container mx-auto px-4">
        <h1 class="text-center font-bold my-5">Termék szerkesztése</h1>

        <!-- Hibák megjelenítése -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Szerkesztő űrlap -->

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow">
            @csrf
            @method('PUT')
            <div class="container">
                <!-- Termék neve -->
                <div class="input-group mb-4">
                    <span for="name" class="input-group-text">Termék neve:</span>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                        class="form-control form-control-sm" required>
                </div>

                <!-- Leírás -->
                <div class="input-group mb-4">
                    <span for="description" class="input-group-text">Leírás:</span>
                    <textarea id="description" name="description" class="form-control form-control-sm" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Ár -->
                <div class="input-group mb-4">
                    <span for="price" class="input-group-text">Ár (Ft):</span>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                        class="form-control form-control-sm" required min="0" step="0.01">
                </div>

                <!-- Kategória -->
                <div class="input-group mb-4">
                    <span for="category" class="input-group-text">Kategória:</span>
                    <select id="category" name="category" class="form-control form-control-sm" required>
                        <option value="gyumolcsok"
                            {{ old('category', $product->category) == 'gyumolcsok' ? 'selected' : '' }}>
                            Gyümölcsök</option>
                        <option value="zoldsegek"
                            {{ old('category', $product->category) == 'zoldsegek' ? 'selected' : '' }}>
                            Zöldségek</option>
                        <option value="tejtermekek"
                            {{ old('category', $product->category) == 'tejtermekek' ? 'selected' : '' }}>Tejtermékek
                        </option>
                        <option value="hus-es-huskeszitmenyek"
                            {{ old('category', $product->category) == 'hus-es-huskeszitmenyek' ? 'selected' : '' }}>
                            Hús és
                            húskészítmények</option>
                        <option value="kezmuves-termekek"
                            {{ old('category', $product->category) == 'kezmuves-termekek' ? 'selected' : '' }}>
                            Kézműves termékek
                        </option>
                        <option value="mezek-es-lekvarok"
                            {{ old('category', $product->category) == 'mezek-es-lekvarok' ? 'selected' : '' }}>
                            Mézek és
                            lekvárok</option>
                        <option value="pekaruk" {{ old('category', $product->category) == 'pekaruk' ? 'selected' : '' }}>
                            Pékáruk</option>
                        <option value="fuszerek-es-gyogynovenyek"
                            {{ old('category', $product->category) == 'fuszerek-es-gyogynovenyek' ? 'selected' : '' }}>
                            Fűszerek
                            és gyógynövények</option>
                    </select>
                </div>

                <!-- Készlet -->
                <div class="input-group mb-4">
                    <span for="stock" class="input-group-text">Készlet:</span>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                        class="form-control form-control-sm" required min="0">
                </div>

                <!-- Új kép feltöltése -->
                <div class="input-group mb-4">
                    <span for="image" class="input-group-text">Új kép
                        feltöltése:</span>
                    <input type="file" id="image" name="image"
                        class="p-2 border rounded shadow-sm focus:ring focus:ring-primary form-control form-control-sm"
                        accept="image/*">
                </div>

                <!-- Jelenlegi kép -->
                @if ($product->image_path)
                    <div class="mb-4 col-12 col-md-4 mx-auto">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Termék Képe"
                            class="rounded shadow img-fluid">
                    </div>
                @endif

                <!-- Beküldés gomb -->
                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-primary text-white py-2 px-4 rounded hover:bg-primary-dark transition">
                        Termék frissítése
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection
