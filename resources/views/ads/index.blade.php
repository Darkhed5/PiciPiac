@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-start text-3xl font-bold my-6"><u>Hirdetéseim</u></h1>

    @if($ads->isEmpty())
        <p class="text-muted text-left">Jelenleg nincs aktív hirdetésed.</p>
    @else
        <!-- Terméklista -->
        <div class="list-group" id="ads-list">
            @foreach($ads as $ad)
                <div class="list-group-item d-flex align-items-center hover-highlight" id="ad-{{ $ad->id }}">
                    <!-- Termékkép -->
                    <a href="{{ route('products.show', $ad->id) }}" class="me-3">
                        @if($ad->image_path)
                            <img src="{{ asset('storage/' . $ad->image_path) }}" alt="{{ $ad->name }}" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="text-muted bg-gray-200 p-3 rounded" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                Nincs kép
                            </div>
                        @endif
                    </a>

                    <!-- Termék leírás -->
                    <div class="flex-grow-1">
                        <h5 class="mb-1">
                            <a href="{{ route('products.show', $ad->id) }}" class="text-decoration-none text-primary">
                                {{ $ad->name }} 
                                <span class="text-muted">| Kiszerelés: {{ $ad->unit }}</span>
                            </a>
                        </h5>
                    </div>

                    <!-- Ár -->
                    <div class="text-end text-danger fw-bold me-3" style="min-width: 80px;">
                        {{ number_format($ad->price, 0, ',', ' ') }} Ft
                    </div>

                    <!-- Szerkesztés és Törlés gombok -->
                    <div class="d-flex" style="gap: 5px;">
                        <a href="{{ route('products.edit', $ad->id) }}" class="btn btn-primary btn-sm">Szerkesztés</a>
                        <form action="{{ route('products.destroy', $ad->id) }}" method="POST" onsubmit="return handleDelete(event, {{ $ad->id }})">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Törlés</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .hover-highlight:hover {
        background-color: #f1f8ff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, box-shadow 0.3s;
    }
</style>

<script>
    function handleDelete(event, adId) {
        event.preventDefault(); // Megakadályozzuk az alapértelmezett űrlapküldést
        if (confirm('Biztosan törlöd ezt a hirdetést?')) {
            const form = event.target;
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ _method: 'DELETE' }),
            })
            .then(response => {
                if (response.ok) {
                    // Eltávolítjuk az elemet a DOM-ból
                    document.getElementById(`ad-${adId}`).remove();
                    alert('Hirdetés sikeresen törölve!');
                } else {
                    alert('Hiba történt a hirdetés törlésekor.');
                }
            })
            .catch(error => {
                console.error('Hiba:', error);
                alert('Hiba történt a hirdetés törlésekor.');
            });
        }
    }
</script>
@endsection
