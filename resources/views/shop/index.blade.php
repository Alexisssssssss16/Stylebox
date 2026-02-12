@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-0">Catálogo</h2>
                <p class="text-muted">Explora nuestra colección</p>
            </div>
            <div class="col-md-6">
                <form action="{{ route('shop.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Buscar prendas..."
                        value="{{ request('search') }}">
                    <select name="category" class="form-select" style="width: auto;" onchange="this.form.submit()">
                        <option value="">Todas</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="ratio ratio-1x1 bg-light rounded-top position-relative overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top object-fit-cover"
                                    alt="{{ $product->name }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center text-muted">
                                    <i class="fas fa-tshirt fa-3x"></i>
                                </div>
                            @endif
                            @if($product->stock <= 0)
                                <span class="position-absolute top-0 end-0 badge bg-danger m-2">Agotado</span>
                            @elseif($product->stock < 5)
                                <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2">¡Pocas unidades!</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <small class="text-muted text-uppercase fw-bold">{{ $product->category ?? 'General' }}</small>
                            <h5 class="card-title mt-1 fw-bold text-truncate">{{ $product->name }}</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="h5 mb-0 fw-bold">S/ {{ number_format($product->price, 2) }}</span>
                                <button class="btn btn-outline-dark btn-sm rounded-circle"
                                    onclick="addToCart({{ $product->id }})" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">No se encontraron productos.</h4>
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-dark mt-3">Ver todo</a>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    </div>
@endsection