<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Halaman utama pelanggan (welcome.blade.php)
    public function katalogPelanggan()
    {
        $menus = Menu::where('is_available', true)->get();
        return view('welcome', compact('menus'));
    }

    // Menampilkan daftar menu di dashboard admin
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    // Menampilkan form tambah menu (Tugas Frontend)
    public function create()
    {
        return view('admin.menu.create');
    }

    // Menyimpan data menu baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'is_available' => 'boolean'
        ]);

        Menu::create($request->all());
        return redirect()->route('menu.index');
    }

    // Menampilkan form edit menu (Tugas Frontend)
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    // Memperbarui data menu di database
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
        return redirect()->route('menu.index');
    }

    // Menghapus menu dari database
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index');
    }
}