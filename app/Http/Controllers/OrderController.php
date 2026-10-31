<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    // Menampilkan form pemesanan
    public function create(Menu $menu)
    {
        if (!$menu->is_available) {
            return redirect()
                ->route('katalog')
                ->with('error', 'Maaf, menu tersebut sedang tidak tersedia.');
        }

        return view('order.create', compact('menu'));
    }

    // Menyimpan pesanan (Mendukung multi-menu sekaligus maupun single-menu)
    public function store(Request $request)
    {
        // 1. Skenario Multi-Item (Contoh: Ayam Geprek + Tempe Goreng + Tortilla dalam 1x pesan)
        if ($request->has('items') && is_array($request->items) && count($request->items) > 0) {
            $validated = $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'metode_pembayaran' => 'required|in:tunai,qris',
                'items' => 'required|array|min:1',
                'items.*.menu_id' => 'required|integer|exists:menus,id',
                'items.*.jumlah' => 'required|integer|min:1|max:100',
            ]);

            $order = DB::transaction(function () use ($validated) {
                $totalHarga = 0;
                $orderItemsData = [];

                foreach ($validated['items'] as $item) {
                    $menu = Menu::whereKey($item['menu_id'])
                        ->lockForUpdate()
                        ->firstOrFail();

                    if (!$menu->is_available) {
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            'menu' => "Maaf, menu {$menu->nama} sedang tidak tersedia.",
                        ]);
                    }

                    $jumlah = (int) $item['jumlah'];
                    $subtotal = $menu->harga * $jumlah;
                    $totalHarga += $subtotal;

                    $orderItemsData[] = [
                        'menu_id' => $menu->id,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $menu->harga,
                        'subtotal' => $subtotal,
                    ];
                }

                $order = Order::create([
                    'nama_pelanggan' => $validated['nama_pelanggan'],
                    'total_harga' => $totalHarga,
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'status' => 'pending',
                ]);

                foreach ($orderItemsData as $itemData) {
                    $itemData['order_id'] = $order->id;
                    OrderItem::create($itemData);
                }

                return $order;
            });

            return redirect()
                ->route('order.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat untuk ' . count($validated['items']) . ' menu.');
        }

        // 2. Skenario Single-Item (Fallback pemesanan satuan)
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'menu_id' => 'required|integer|exists:menus,id',
            'jumlah' => 'required|integer|min:1|max:100',
            'metode_pembayaran' => 'required|in:tunai,qris',
        ]);

        $order = DB::transaction(function () use ($validated) {
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

    // Menampilkan detail pesanan yang sudah tersimpan
    public function show(Order $order)
    {
        $order->load('orderItems.menu');

        return view('order.show', compact('order'));
    }
}