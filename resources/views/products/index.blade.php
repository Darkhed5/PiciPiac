@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Kategória neve -->
    @if (request()->has('category') && !empty(request()->category))
        @php
            $categories = [
                'gyumolcsok' => 'Gyümölcsök',
                'zoldsegek' => 'Zöldségek',
                'tejtermekek' => 'Tejtermékek',
                'hus-es-huskeszitmenyek' => 'Húsok és húskészítmények',
                'mezek-es-lekvarok' => 'Mézek és lekvárok',
                'pekaruk' => 'Pékáruk',
                'fuszerek-es-gyogynovenyek' => 'Fűszerek és gyógynövények',
                'kezmuves-termekek' => 'Kézműves termékek',
            ];
            $categoryName = $categories[request()->category] ?? ucfirst(str_replace('-', ' ', request()->category));
        @endphp
        <h2 class="text-start mb-4">{{ $categoryName }}</h2>
    @endif


    <!-- Fejléc és tartományválasztás -->
    <div class="d-flex justify-content-between align-items-center mb-3" style="background-color: #f5c500; padding: 10px;">
        <div class="d-flex align-items-center">
            <!-- Ugrás az elejére -->
            <button class="btn btn-light me-1 {{ $products->onFirstPage() ? 'disabled' : '' }}" onclick="navigateToPage('first')">
                <i class="fas fa-fast-backward"></i>
            </button>
            <!-- Egyel vissza -->
            <button class="btn btn-light me-1 {{ $products->onFirstPage() ? 'disabled' : '' }}" onclick="navigateToPage('previous')">
                <i class="fas fa-backward"></i>
            </button>
            <!-- Tartományválasztó -->
            <select id="item-range-selector" class="form-select me-3" style="width: auto;" onchange="updateRange()">
                @foreach($ranges as $range)
                    <option value="{{ $range['start'] }}-{{ $range['end'] }}">
                        {{ $range['start'] }} - {{ $range['end'] }}
                    </option>
                @endforeach
            </select>
            <!-- Egyel előre -->
            <button class="btn btn-light me-1 {{ $products->currentPage() >= $products->lastPage() ? 'disabled' : '' }}" onclick="navigateToPage('next')">
                <i class="fas fa-forward"></i>
            </button>
            <!-- Ugrás a végére -->
            <button class="btn btn-light {{ $products->currentPage() >= $products->lastPage() ? 'disabled' : '' }}" onclick="navigateToPage('last')">
                <i class="fas fa-fast-forward"></i>
            </button>
        </div>
        <!-- Ugrás az aljára -->
        <button class="btn btn-light" onclick="navigateToPage('bottom')">
            <i class="bi bi-chevron-double-down"></i>
        </button>
    </div>

    <!-- Terméklista -->
    <div class="list-group">
        @forelse($products as $product)
            <div class="list-group-item d-flex align-items-center hover-highlight">
                <!-- Termékkép -->
                <a href="{{ route('products.show', $product->id) }}" class="me-3">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover;">
                </a>

                <!-- Termék leírás -->
                <div class="flex-grow-1">
                    <h5 class="mb-1">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-primary">
                            {{ $product->name }} 
                            <span class="text-muted">({{ $product->unit }})</span>
                        </a>
                    </h5>
                    <small class="text-muted">Eladó: {{ $product->seller->name ?? 'Ismeretlen' }}</small>
                </div>

                <!-- Ár -->
                <div class="text-end text-danger fw-bold me-3" style="min-width: 80px;">
                    {{ number_format($product->price, 0, ',', ' ') }} Ft
                </div>

                <!-- Kosárba gomb -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-0 add-to-cart-form">
                    @csrf
                    <button type="button" class="btn btn-success add-to-cart" data-url="{{ route('cart.add', $product->id) }}">Kosárba</button>
                </form>                
            </div>
        @empty
            <p class="text-center">Jelenleg nincsenek termékek ebben a kategóriában.</p>
        @endforelse
    </div>

    <!-- Lábléc tartomány és navigáció -->
    <div class="d-flex justify-content-between align-items-center mt-3" style="background-color: #f5c500; padding: 10px;">
        <div class="d-flex align-items-center">
            <!-- Ugrás az elejére -->
            <button class="btn btn-light me-1 {{ $products->onFirstPage() ? 'disabled' : '' }}" onclick="navigateToPage('first')">
                <i class="fas fa-fast-backward"></i>
            </button>
            <!-- Egyel vissza -->
            <button class="btn btn-light me-1 {{ $products->onFirstPage() ? 'disabled' : '' }}" onclick="navigateToPage('previous')">
                <i class="fas fa-backward"></i>
            </button>
            <!-- Tartományválasztó -->
            <select id="item-range-selector-footer" class="form-select me-3" style="width: auto;" onchange="updateRange()">
                @foreach($ranges as $range)
                    <option value="{{ $range['start'] }}-{{ $range['end'] }}">
                        {{ $range['start'] }} - {{ $range['end'] }}
                    </option>
                @endforeach
            </select>
            <!-- Egyel előre -->
            <button class="btn btn-light me-1 {{ $products->currentPage() >= $products->lastPage() ? 'disabled' : '' }}" onclick="navigateToPage('next')">
                <i class="fas fa-forward"></i>
            </button>
            <!-- Ugrás a végére -->
            <button class="btn btn-light {{ $products->currentPage() >= $products->lastPage() ? 'disabled' : '' }}" onclick="navigateToPage('last')">
                <i class="fas fa-fast-forward"></i>
            </button>
        </div>
        <!-- Ugrás a tetejére -->
        <button class="btn btn-light" onclick="navigateToPage('top')">
            <i class="bi bi-chevron-double-up"></i>
        </button>
    </div>

    <!-- Lapozás -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>

<style>
    .hover-highlight:hover {
        background-color: #f1f8ff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .category-count-hover:hover::after {
        content: attr(data-count);
        position: absolute;
        left: 100%;
        margin-left: 10px;
        background-color: #ffc107;
        padding: 5px;
        border-radius: 3px;
        font-size: 0.9rem;
        white-space: nowrap;
        z-index: 10;
    }

    /* Mobilnézet szövegek méretének csökkentése */
    @media (max-width: 768px) {
        h5 {
            font-size: 1rem !important; /* Termék nevek kisebb méretben */
        }
        .list-group-item .text-muted {
            font-size: 0.875rem !important; /* Kis szövegek méretének csökkentése */
        }
        .text-end {
            font-size: 0.9rem !important; /* Ár kisebb méretben */
        }
    }
</style>

<script>
    function navigateToPage(action) {
        switch (action) {
            case 'first':
                window.location.href = '?page=1';
                break;
            case 'previous':
                const prevPage = {{ $products->currentPage() > 1 ? $products->currentPage() - 1 : 1 }};
                window.location.href = ?page=${prevPage};
                break;
            case 'next':
                const nextPage = {{ $products->currentPage() < $products->lastPage() ? $products->currentPage() + 1 : $products->lastPage() }};
                window.location.href = ?page=${nextPage};
                break;
            case 'last':
                window.location.href = ?page={{ $products->lastPage() }};
                break;
            case 'top':
                window.scrollTo({ top: 0, behavior: 'smooth' });
                break;
            case 'bottom':
                window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
                break;
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartButtons = document.querySelectorAll('.add-to-cart');

        cartButtons.forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    if (response.ok) {
                        alert('Termék sikeresen hozzáadva a kosárhoz!');
                    } else {
                        alert('Hiba történt a termék kosárhoz adásakor.');
                    }
                })
                .catch(error => {
                    console.error('Hiba:', error);
                    alert('Hiba történt a termék kosárhoz adásakor.');
                });
            });
        });
    });
</script>

@endsection