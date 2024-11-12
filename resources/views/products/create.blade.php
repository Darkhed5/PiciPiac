@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Új Termék Hozzáadása</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/products') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Termék Neve:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Leírás:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Ár (Ft):</label>
            <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01">
        </div>

        <div class="form-group">
            <label for="category">Kategória:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="gyumolcsok">Gyümölcsök</option>
                <option value="zoldsegek">Zöldségek</option>
                <option value="tejtermekek">Tejtermékek</option>
                <option value="hus-es-huskeszitmenyek">Hús és Húskészítmények</option>
                <option value="kezmuves-termekek">Kézműves Termékek</option>
                <option value="mezek-es-lekvarok">Mézek és Lekvárok</option>
                <option value="pekaruk">Pékáruk</option>
                <option value="fuszerek-es-gyogynovenyek">Fűszerek és Gyógynövények</option>
            </select>
        </div>

        <div class="form-group">
            <label for="stock">Készlet:</label>
            <input type="number" class="form-control" id="stock" name="stock" required min="0">
        </div>

        <div class="form-group">
            <label for="image">Kép:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Termék Hozzáadása</button>
    </form>
</div>
@endsection
