@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-center text-3xl font-bold my-6">Termékkatalógus</h1>

    <!-- Keresőmező és Kategória szűrő -->
    <form method="GET" action="{{ url('/products') }}" class="mb-6 flex flex-wrap justify-between items-center gap-4">
        <!-- Keresőmező -->
        <div class="flex-grow">
            <input type="text" name="search" class="w-full p-2 border rounded-lg shadow-sm focus:ring focus:ring-primary" placeholder="Keresés termékek között..." value="{{ request('search') }}">
        </div>
        <!-- Kategória szűrő -->
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Kategória:</label>
            <select name="category" id="category" class="w-full p-2 border rounded-lg shadow-sm" onchange="this.form.submit()">
                <option value="">Összes</option>
                <option value="gyumolcsok" {{ request('category') == 'gyumolcsok' ? 'selected' : '' }}>Gyümölcsök</option>
                <option value="zoldsegek" {{ request('category') == 'zoldsegek' ? 'selected' : '' }}>Zöldségek</option>
                <option value="tejtermekek" {{ request('category') == 'tejtermekek' ? 'selected' : '' }}>Tejtermékek</option>
                <option value="hus-es-huskeszitmenyek" {{ request('category') == 'hus-es-huskeszitmenyek' ? 'selected' : '' }}>Hús és húskészítmények</option>
                <option value="kezmuves-termekek" {{ request('category') == 'kezmuves-termekek' ? 'selected' : '' }}>Kézműves termékek</option>
                <option value="mezek-es-lekvarok" {{ request('category') == 'mezek-es-lekvarok' ? 'selected' : '' }}>Mézek és lekvárok</option>
                <option value="pekaruk" {{ request('category') == 'pekaruk' ? 'selected' : '' }}>Pékáruk</option>
                <option value="fuszerek-es-gyogynovenyek" {{ request('category') == 'fuszerek-es-gyogynovenyek' ? 'selected' : '' }}>Fűszerek és gyógynövények</option>
            </select>
        </div>
        <!-- Keresés gomb -->
        <button type="submit" class="btn bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">Keresés</button>
    </form>

    <!-- Keresés eredményének ellenőrzése -->
    @if(request('search') && $products->isEmpty())
        <p class="text-center text-red-500">Nincs találat a keresésre: "{{ request('search') }}"</p>
    @endif

    <!-- Termékek listája -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                @if($product->image_path)
                    <div class="w-full h-32 bg-gray-100 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="h-full w-full object-cover" alt="{{ $product->name }}">
                    </div>
                @else
                    <div class="w-full h-32 bg-gray-100 flex items-center justify-center">
                        <p class="text-gray-500">Nincs kép feltöltve</p>
                    </div>
                @endif
                <div class="p-4 flex flex-col">
                    <h5 class="text-lg font-bold text-gray-800 truncate">{{ $product->name }}</h5>
                    <p class="text-sm text-gray-600 flex-grow truncate">{{ $product->description }}</p>
                    <p class="font-semibold text-primary">Ár: {{ $product->price }} Ft</p>
                    <p class="text-sm text-gray-600">Készlet: {{ $product->stock > 0 ? 'Raktáron' : 'Elfogyott' }}</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="{{ url('/products/' . $product->id) }}" class="btn bg-info text-white px-4 py-2 rounded-lg">Részletek</a>
                        <a href="{{ url('/products/' . $product->id . '/edit') }}" class="btn bg-primary text-white px-4 py-2 rounded-lg">Szerkesztés</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn bg-success text-white px-4 py-2 rounded-lg">Kosárba</button>
                        </form>
                        <form action="{{ url('/products/' . $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-danger text-white px-4 py-2 rounded-lg" onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">Törlés</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Nincsenek elérhető termékek.</p>
        @endforelse
    </div>

    <!-- Lapozás -->
    <div class="mt-6 flex justify-center">
        {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
