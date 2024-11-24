@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Hirdetéseim</h1>

    @if($ads->isEmpty())
        <p class="text-center text-muted">Nincsenek hirdetéseid.</p>
    @else
        <div class="row">
            @foreach($ads as $ad)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        @if($ad->image_path)
                            <img src="{{ asset('storage/' . $ad->image_path) }}" class="card-img-top" alt="{{ $ad->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $ad->name }}</h5>
                            <p class="card-text">{{ $ad->description }}</p>
                            <p class="card-text"><strong>Ár:</strong> {{ $ad->price }} Ft</p>
                            <a href="{{ route('products.edit', $ad->id) }}" class="btn btn-primary">Szerkesztés</a>
                            <form action="{{ route('products.destroy', $ad->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">Törlés</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
