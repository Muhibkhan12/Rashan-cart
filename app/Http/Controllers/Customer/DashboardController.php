<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // --- Active orders (not delivered, not cancelled) ---
        $activeOrders = Order::where('user_id', $user->id)
            ->whereNotIn('status', ['Delivered', 'Cancelled'])
            ->with(['items.product'])
            ->latest()
            ->get();

        // --- Tracked delivery (first out-for-delivery or packed) ---
        $tracked = $activeOrders->firstWhere('status', 'Out for delivery')
                ?? $activeOrders->firstWhere('status', 'Packed');

        // --- Total savings (retail - group) across live orders ---
        $totalSavings = Order::where('user_id', $user->id)
            ->where('status', '!=', 'Cancelled')
            ->with(['items.product'])
            ->get()
            ->flatMap->items
            ->sum(function ($item) {
                $retail = $item->product->retail_price ?? $item->unit_price;
                return max(0, ($retail - $item->unit_price) * $item->quantity);
            });

        // --- Orders awaiting confirmation ---
        $awaitingConfirmation = $activeOrders->where('status', 'Placed')->count();

        // --- Default address ---
        $defaultAddress = $user->addresses()->where('is_default', true)->first()
                       ?? $user->addresses()->first();

        // --- Ending-soon products (3 closest to their deadline / target) ---
        $endingSoon = Product::where('is_active', true)
            ->whereHas('campaigns', fn ($q) => $q->where('deadline', '>=', now()))
            ->with(['campaigns' => fn ($q) => $q->where('deadline', '>=', now())->orderBy('deadline')])
            ->get()
            ->map(function ($product) {
                $c = $product->campaigns->first();
                return $c ? [
                    'product'  => $product,
                    'campaign' => $c,
                ] : null;
            })
            ->filter()
            ->sortBy(fn ($row) => $row['campaign']->deadline)
            ->take(3)
            ->values();

        // --- Recent orders (last 3) ---
        $recentOrders = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->latest()
            ->limit(3)
            ->get();

        return view('customer.dashboard', compact(
            'user',
            'activeOrders',
            'tracked',
            'totalSavings',
            'awaitingConfirmation',
            'defaultAddress',
            'endingSoon',
            'recentOrders',
        ));
    }
}