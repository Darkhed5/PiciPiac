@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Termék Szerkesztése</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Termék Neve:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Leírás:</label>
            <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Ár (Ft):</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required min="0" step="0.01">
        </div>

        <div class="form-group">
            <label for="category">Kategória:</label>
            <select class="form-control" id="category" name="category" required>
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

        <div class="form-group">
            <label for="stock">Készlet:</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required min="0">
        </div>

        <div class="form-group">
            <label for="image">Új kép feltöltése:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
        </div>

        @if($product->image_path)
            <div class="form-group">
                <label>Jelenlegi kép:</label>
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Termék Képe" style="width: 200px; height: auto;">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Termék Frissítése</button>
    </form>
</div>
@endsection
