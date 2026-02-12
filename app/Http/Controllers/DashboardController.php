<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('vendedor')) {
            return $this->sellerDashboard();
        } else {
            return $this->clientDashboard();
        }
    }

    private function clientDashboard()
    {
        $user = Auth::user();
        // Assuming the User is linked to a Client model via email or ID, 
        // OR simply showing sales where this user's email matches the client's email.
        // For this architecture, we linked Sale to Client ID. 
        // Simplification: We will show sales where user_id matches (if they bought it) 
        // OR we need to link User -> Client.
        // For now, let's show sales where user_id = Auth::id() assuming self-checkout 
        // OR simply return the view. *Correct approach:* Link User to Client.

        // As per seeder, 'cliente@example.com' is a User.
        // If we want to show 'My Purchases', we need to know WHICH Client ID this User represents.
        // For now, let's just display the static view or sales explicitly assigned to this User ID 
        // (if we allowed users to buy online). 
        // Since POS assigns to a 'Client' entity (from clients table), we match by email?

        $client = Client::where('email', $user->email)->first();
        $myPurchases = collect([]);

        if ($client) {
            $myPurchases = Sale::where('client_id', $client->id)
                ->with('details.product')
                ->latest()
                ->get();
        }

        return view('dashboard.client', compact('myPurchases'));
    }

    private function adminDashboard()
    {
        // 1. Totals
        $totalSales = Sale::sum('total');
        $totalSalesToday = Sale::whereDate('date', '=', today())->sum('total');
        $transactionCount = Sale::count();
        $productsLowStock = Product::where('stock', '<', 5)->count();

        // 2. Sales Chart (Last 7 days)
        $salesChart = Sale::select(DB::raw('DATE(date) as date'), DB::raw('SUM(total) as total'))
            ->whereDate('date', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // 3. Top Products
        $topProducts = DB::table('sale_details')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_details.quantity) as total_qty'))
            ->groupBy('products.name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        return view('dashboard.admin', compact('totalSales', 'totalSalesToday', 'transactionCount', 'productsLowStock', 'salesChart', 'topProducts'));
    }

    private function sellerDashboard()
    {
        $userId = Auth::id();

        $mySalesToday = Sale::where('user_id', $userId)->whereDate('date', '=', today())->sum('total');
        $myTransactionCount = Sale::where('user_id', $userId)->whereDate('date', '=', today())->count();

        $recentSales = Sale::where('user_id', $userId)->with('client')->latest()->take(5)->get();

        return view('dashboard.seller', compact('mySalesToday', 'myTransactionCount', 'recentSales'));
    }
}
