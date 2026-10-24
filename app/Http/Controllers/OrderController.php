<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    // Menampilkan form pemesanan.
    public function create(Menu $menu)
    {
        if (!$menu->is_available) {
            return redirect()
                ->route('katalog')
                ->with('error', 'Maaf, menu tersebut sedang tidak tersedia.');
        }

        return view('order.create', compact('menu'));
    }

    // Menyimpan order dan detail item.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'menu_id' => 'required|integer|exists:menus,id',
            'jumlah' => 'required|integer|min:1|max:100',
            'metode_pembayaran' => 'required|in:tunai,qris',
        ]);

        $order = DB::transaction(function () use ($validated) {
            // Ambil data terbaru dari database.
            $menu = Menu::whereKey($validated['menu_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (!$menu->is_available) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'menu_id' => 'Maaf, menu tersebut sedang tidak tersedia.',
                ]);
            }

            $jumlah = (int) $validated['jumlah'];
            $subtotal = $menu->harga * $jumlah;

            $order = Order::create([
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'total_harga' => $subtotal,
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'status' => 'pending',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'jumlah' => $jumlah,
                'harga_satuan' => $menu->harga,
                'subtotal' => $subtotal,
            ]);

            return $order;
        });

        return redirect()
            ->route('order.show', $order->id)
            ->with('success', 'Pesanan berhasil dicatat.');
    }

    // Menampilkan detail pesanan yang sudah tersimpan.
    public function show(Order $order)
    {
        $order->load('orderItems.menu');

        return view('order.show', compact('order'));
    }
}
