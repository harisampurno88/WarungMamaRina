<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Menu Warung</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Koneksi Controller ke View berhasil! Daftar menu akan tampil di sini.</p>
                
                @foreach($menus as $menu)
                    <li>{{ $menu->nama }} - Rp {{ $menu->harga }}</li>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>