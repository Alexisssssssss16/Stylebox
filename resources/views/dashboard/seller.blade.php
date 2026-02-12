@extends('layouts.admin')

@section('title', 'Mi Panel de Ventas')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card card-custom h-100 bg-primary text-white border-0 shadow-sm">
                <div class="card-body text-center p-5">
                    <h1 class="display-4 fw-bold mb-0">S/ {{ number_format($mySalesToday, 2) }}</h1>
                    <p class="mb-4 text-white-50">Mis Ventas de Hoy</p>
                    <a href="{{ route('pos.index') }}" class="btn btn-light fw-bold px-4 py-2 rounded-pill">
                        <i class="fas fa-plus me-2"></i>Nueva Venta
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-custom h-100 border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Transacciones Recientes</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Hora</th>
                                <th>Cliente</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSales as $sale)
                                <tr>
                                    <td>{{ $sale->date->format('H:i') }}</td>
                                    <td>{{ $sale->client->name ?? 'Cliente General' }}</td>
                                    <td class="text-end fw-bold">S/ {{ number_format($sale->total, 2) }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-success bg-opacity-10 text-success">Completado</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection