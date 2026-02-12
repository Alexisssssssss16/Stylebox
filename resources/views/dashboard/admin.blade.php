@extends('layouts.admin')

@section('title', 'Dashboard Administrativo')

@section('content')
    <div class="row g-4 mb-4">
        <!-- Metric Cards -->
        <div class="col-md-3">
            <div class="card card-custom h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold">Ventas Totales</h6>
                    <h3 class="fw-bold mb-0">S/ {{ number_format($totalSales, 2) }}</h3>
                    <small class="text-success"><i class="fas fa-chart-line me-1"></i>Acumulado</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold">Ventas Hoy</h6>
                    <h3 class="fw-bold mb-0">S/ {{ number_format($totalSalesToday, 2) }}</h3>
                    <small class="text-primary">{{ $transactionCount }} transacciones</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold">Stock Bajo</h6>
                    <h3 class="fw-bold mb-0 text-danger">{{ $productsLowStock }}</h3>
                    <small class="text-muted">Productos por agotar</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom h-100 border-0 shadow-sm bg-primary text-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-white-50 text-uppercase small fw-bold">Acción Rápida</h6>
                        <a href="{{ route('pos.index') }}" class="btn btn-light btn-sm fw-bold rounded-pill px-3">Ir al POS
                            <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                    <i class="fas fa-cash-register fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card card-custom border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Ingresos Últimos 7 Días</h6>
                </div>
                <div class="card-body">
                    <!-- Placeholder for Chart -->
                    <div
                        style="height: 300px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border-radius: 8px;">
                        <p class="text-muted">Gráfico de Ventas (Implementar con Chart.js)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Productos Más Vendidos</h6>
                </div>
                <div class="list-group list-group-flush">
                    @foreach($topProducts as $product)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-3 py-3">
                            <div>
                                <span class="fw-medium">{{ $product->name }}</span>
                            </div>
                            <span class="badge bg-light text-dark border">{{ $product->total_qty }} un.</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection