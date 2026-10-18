<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request): RedirectResponse
    {
        $productId = (int) $request->input('id');
        $product = Product::findOrFail($productId);

        if ($product->status === 'sold') {
            return redirect()->back()->with('error', 'Maaf, produk ini sudah terjual!');
        }

        $cart = session()->get('cart', []);

        // Pada toko barang bekas, barang biasanya unik/1 unit. Jika sudah ada di cart, beri tahu.
        if (isset($cart[$productId])) {
            return redirect()->route('cart.index')->with('info', 'Barang ini sudah ada di dalam keranjang Anda.');
        }

        $cart[$productId] = [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'price' => (float) $product->price,
            'image' => $product->image_url,
            'condition' => $product->product_condition,
            'quantity' => 1,
            'defect' => $product->defect,
            'completeness' => $product->completeness,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang belanja!');
    }

    public function remove(int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang belanja.');
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang belanja telah dikosongkan.');
    }

    public function checkout(): View|RedirectResponse
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('info', 'Keranjang belanja Anda masih kosong.');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('cart.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'customer_note' => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $totalAmount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        $order = DB::transaction(function () use ($validated, $cart, $totalAmount) {
            $order = Order::create([
                'order_number' => 'SCND-' . strtoupper(Str::random(6)),
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_address' => $validated['customer_address'],
                'customer_note' => $validated['customer_note'] ?? null,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            return $order;
        });

        // Kosongkan cart
        session()->forget('cart');

        return redirect()->route('checkout.success', $order->order_number);
    }

    public function success(string $orderNumber): View
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();
        return view('cart.success', compact('order'));
    }
}
