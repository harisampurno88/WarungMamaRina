<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'harga' => 'required|integer|min:0',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_available' => 'nullable|boolean',
    ]);

    $validated['is_available'] = $request->boolean('is_available');

    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')
            ->store('menus', 'public');
    }

    Menu::create($validated);

    return redirect()
        ->route('menu.index')
        ->with('success', 'Menu berhasil ditambahkan.');
}


    // Menampilkan form edit menu (Tugas Frontend)
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    // Memperbarui data menu di database
    
public function update(Request $request, Menu $menu)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'harga' => 'required|integer|min:0',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_available' => 'nullable|boolean',
    ]);

    $validated['is_available'] = $request->boolean('is_available');

    if ($request->hasFile('gambar')) {
        $gambarLama = $menu->gambar;

        $validated['gambar'] = $request->file('gambar')
            ->store('menus', 'public');

        if ($gambarLama) {
            Storage::disk('public')->delete($gambarLama);
        }
    }

    $menu->update($validated);

    return redirect()
        ->route('menu.index')
        ->with('success', 'Menu berhasil diperbarui.');
}


    // Menghapus menu dari database
   
public function destroy(Menu $menu)
{
    // Simpan lokasi foto sebelum data menu dihapus
    $gambar = $menu->gambar;

    // Hapus data menu dari database
    $menu->delete();

    // Hapus file foto jika menu memilikinya
    if ($gambar) {
        Storage::disk('public')->delete($gambar);
    }

    return redirect()
        ->route('menu.index')
        ->with('success', 'Menu berhasil dihapus.');
}

}