@extends('layouts.public')

@section('title', 'Mis Compras')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Historial de Pedidos</h6>
                </div>
                <div class="card-body p-0">
                    @if($myPurchases->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aún no has realizado compras con este correo.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4"># Compra</th>
                                        <th>Fecha</th>
                                        <th>Productos</th>
                                        <th class="text-end pe-4">Total</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myPurchases as $sale)
                                        <tr>
                                            <td class="ps-4 fw-bold">#{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $sale->date->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <ul class="list-unstyled mb-0 small">
                                                    @foreach($sale->details as $detail)
                                                        <li>{{ $detail->quantity }}x {{ $detail->product->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="text-end pe-4 fw-bold">S/ {{ number_format($sale->total, 2) }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-success bg-opacity-10 text-success">Completado</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection