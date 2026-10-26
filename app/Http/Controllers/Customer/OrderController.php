<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Models need:
|   Order      -> $fillable: order_number, user_id, address_id, delivery_address, delivery_area,
|                 subtotal, delivery_fee, total_amount, status
|                 public function items() { return $this->hasMany(OrderItem::class); }
|   OrderItem  -> $fillable: order_id, product_id, product_name, quantity, unit_price, line_total
|   Product     -> see Product.php (table: id, category_id, name, sku, unit, retail_price, image_path, is_active)
|   Category    -> table: id, name
|   Address     -> table: id, user_id, label, address, area
|--------------------------------------------------------------------------
*/

class OrderController extends Controller
{
    /** Flat delivery fee in Rs. Change it here or move it to config. */
    private const DELIVERY_FEE = 50;

    /** My orders page */
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.orders', compact('orders'));
    }

    /** New order page: products + the customer's addresses */
    public function create()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->orderBy('category_id')
            ->orderBy('name')
            ->get()
            ->map(fn ($p) => [
                'id'       => $p->id,
                'name'     => $p->name,
                'sku'      => $p->sku,
                'unit'     => $p->unit,
                'category' => optional($p->category)->name,
                'image'    => $this->imageUrl($p->image_path),
                'price'    => (float) $p->retail_price,
                // Savings: the page shows "You save" only when this is higher than price.
                // The products table has no discount/market price yet, so it stays null.
                'market_price' => null,
            ])
            ->values();

        $addresses = Address::where('user_id', auth()->id())
            ->get()
            ->map(fn ($a) => [
                'id'      => $a->id,
                'label'   => $a->label,
                'address' => $this->addressText($a),
                'area'    => $a->area,
            ])
            ->values();

        return view('customer.order-create', [
            'products'    => $products,
            'addresses'   => $addresses,
            'deliveryFee' => self::DELIVERY_FEE,
        ]);
    }

    /** Save a new order (called by the New order page) */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'address_id'         => ['required', 'integer'],
            'items'              => ['required', 'array', 'min:1', 'max:50'],
            'items.*.product_id' => ['required', 'integer', 'distinct'],
            'items.*.quantity'   => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        // The address must belong to the logged-in customer.
        $address = Address::where('id', $data['address_id'])
            ->where('user_id', auth()->id())
            ->first();

        if (! $address) {
            return response()->json(['message' => 'Please choose a valid delivery address.'], 422);
        }

        // Never trust prices from the browser. Load them from the database.
        $ids      = collect($data['items'])->pluck('product_id');
        $products = Product::where('is_active', true)->whereIn('id', $ids)->get()->keyBy('id');

        if ($products->count() !== $ids->count()) {
            return response()->json(['message' => 'Some products are no longer available. Please refresh the page.'], 422);
        }

        $order = DB::transaction(function () use ($data, $products, $address) {
            $lines    = [];
            $subtotal = 0;

            foreach ($data['items'] as $item) {
                $product   = $products[$item['product_id']];
                $unitPrice = (float) $product->retail_price;
                $lineTotal = round($unitPrice * $item['quantity'], 2);
                $subtotal += $lineTotal;

                $lines[] = [
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'quantity'     => $item['quantity'],
                    'unit_price'   => $unitPrice,
                    'line_total'   => $lineTotal,
                ];
            }

            $order = Order::create([
                'order_number'     => 'RC-' . now()->format('ymd') . '-' . strtoupper(Str::random(5)),
                'user_id'          => auth()->id(),
                'address_id'       => $address->id,
                'delivery_address' => $this->addressText($address),   // snapshot: stays correct even if the address changes later
                'delivery_area'    => $address->area,
                'subtotal'         => $subtotal,
                'delivery_fee'     => self::DELIVERY_FEE,
                'total_amount'     => $subtotal + self::DELIVERY_FEE,
                'status'           => 'Placed',
            ]);

            foreach ($lines as $line) {
                OrderItem::create($line + ['order_id' => $order->id]);
            }

            return $order;
        });

        session()->flash('success', 'Order ' . $order->order_number . ' placed.');

        return response()->json([
            'order_number' => $order->order_number,
            'total_amount' => (float) $order->total_amount,
            'redirect'     => route('customer.orders'),
        ], 201);
    }

    /** Cancel an order (only while it is still "Placed") */
    public function cancel($id): RedirectResponse
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($order->status !== 'Placed') {
            return back()->with('error', 'This order can no longer be cancelled.');
        }

        $order->update(['status' => 'Cancelled']);

        return back()->with('success', 'Order ' . $order->order_number . ' cancelled. Nothing was charged.');
    }

    /**
     * The street/house text of an address. Your addresses table has no column called "address",
     * so we try the usual names. If yours is different, add its name to this list
     * (run `DESCRIBE addresses;` to see the real column names).
     */
    private function addressText($a): string
    {
        $columns = ['address', 'address_line', 'address_line1', 'address_line_1', 'street_address',
                    'street', 'full_address', 'house_address', 'details'];

        foreach ($columns as $col) {
            $v = trim((string) ($a->{$col} ?? ''));
            if ($v !== '') {
                return $v;
            }
        }

        // Last resort so the order never fails: label + area
        return trim(implode(', ', array_filter([$a->label ?? null, $a->area ?? null])));
    }

    /** image_path can be a full URL, an absolute path, or a path inside storage/app/public */
    private function imageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return Str::startsWith($path, ['http://', 'https://', '/']) ? $path : asset('storage/' . ltrim($path, '/'));
    }
}