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
    <form method="POST" action="{{ url('/products') }}" enctype="multipart/form-data" class="bg-white p-5 rounded-lg shadow-sm">
        @csrf

        <!-- Kép feltöltés -->
        <div class="mb-4 text-center">
            <label for="image" class="form-label">Fényképek feltöltése</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Név -->
        <div class="mb-4">
            <label for="name" class="form-label">Cím:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="pl. bio alma" required>
        </div>

        <!-- Leírás -->
        <div class="mb-4">
            <label for="description" class="form-label">Adj leírást a termékedhez:</label>
            <textarea id="description" name="description" class="form-control" placeholder="pl. héja vékony, íze édes" rows="3"></textarea>
        </div>

        <!-- Kategória -->
        <div class="mb-4">
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
            </select>
        </div>

        <!-- Ár -->
        <div class="mb-4">
            <label for="price" class="form-label">Ár (Ft):</label>
            <input type="number" id="price" name="price" class="form-control" min="0" step="1" placeholder="0 Ft" required>
        </div>

        <!-- Gomb -->
        <div class="text-center">
            <button type="submit" class="btn btn-success w-50">Feltöltés</button>
        </div>
    </form>
</div>
@endsection
