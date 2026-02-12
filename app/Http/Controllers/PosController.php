<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SalePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::active()->get(); // Using scopeActive
        $clients = Client::where('status', true)->get();
        $paymentMethods = PaymentMethod::where('status', true)->get();

        return view('pos.index', compact('products', 'clients', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'cart.*.price' => 'required|numeric|min:0',
            'client_id' => 'nullable|exists:clients,id',
            'payments' => 'required|array|min:1',
            'payments.*.method_id' => 'required|exists:payment_methods,id',
            'payments.*.amount' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // 1. Calculate Totals
            $total = 0;
            $cartItems = [];

            foreach ($request->cart as $item) {
                $product = Product::findOrFail($item['id']);

                if (!$product->hasStock($item['quantity'])) {
                    throw new \Exception("Stock insuficiente para el producto: {$product->name}");
                }

                $subtotal = $item['quantity'] * $item['price']; // Or use product price from DB for security
                $total += $subtotal;

                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $subtotal,
                ];
            }

            // 2. Validate Payment Total
            $totalPaid = collect($request->payments)->sum('amount');
            if (abs($totalPaid - $total) > 0.01) { // Floating point tolerance
                // Allow partial payments? No, user requirement implies full payment or split.
                // "Validar que el total pagado coincida con el total de la venta."
                throw new \Exception("El monto pagado (S/ {$totalPaid}) no coincide con el total de la venta (S/ {$total})");
            }

            // 3. Create Sale
            $sale = Sale::create([
                'user_id' => Auth::id(), // Seller
                'client_id' => $request->client_id,
                'total' => $total,
                'status' => 'completed',
                'date' => now(),
            ]);

            // 4. Create Details & Update Stock
            foreach ($cartItems as $item) {
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);

                $item['product']->decrement('stock', $item['quantity']);
            }

            // 5. Record Payments
            foreach ($request->payments as $payment) {
                SalePayment::create([
                    'sale_id' => $sale->id,
                    'payment_method_id' => $payment['method_id'],
                    'amount' => $payment['amount'],
                    'reference' => $payment['reference'] ?? null,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venta registrada correctamente',
                'sale_id' => $sale->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
