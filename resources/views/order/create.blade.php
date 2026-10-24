
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan — Warung Mama Rina</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-900 antialiased">

    <header class="border-b border-stone-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-5">
            <a href="{{ route('katalog') }}" class="text-xl font-extrabold">
                <span class="text-orange-600">M</span>
                Warung Mama Rina
            </a>
            <a href="{{ route('katalog') }}"
               class="text-sm font-semibold text-stone-600 hover:text-orange-600">
                Kembali ke Katalog
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-4 py-10">
        <div class="mb-8">
            <p class="text-sm font-bold uppercase tracking-wider text-orange-600">
                Pemesanan Menu
            </p>
            <h1 class="mt-2 text-3xl font-extrabold">Form Pemesanan</h1>
            <p class="mt-2 text-stone-500">
                Periksa menu dan lengkapi data pesanan kamu.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-bold">Ada data yang perlu diperbaiki:</p>
                <ul class="mt-2 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="bg-stone-100">
                    @if ($menu->gambar)
                        <img
                            src="{{ asset('storage/' . $menu->gambar) }}"
                            alt="{{ $menu->nama }}"
                            class="h-64 w-full object-cover sm:h-full"
                        >
                    @else
                        <div class="flex h-64 items-center justify-center text-6xl sm:h-full">
                            🍽️
                        </div>
                    @endif
                </div>

                <div class="p-6">
                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                        Tersedia
                    </span>

                    <h2 class="mt-4 text-2xl font-extrabold">
                        {{ $menu->nama }}
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-stone-500">
                        {{ $menu->deskripsi ?: 'Menu lezat dari Warung Mama Rina.' }}
                    </p>

                    <p class="mt-5 text-2xl font-extrabold text-orange-600">
                        Rp {{ number_format($menu->harga, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-stone-500">Harga per porsi</p>
                </div>
            </div>

            <div class="border-t border-stone-200 p-6 sm:p-8">
                <form action="{{ route('order.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                    <div>
                        <label for="nama_pelanggan"
                               class="mb-2 block text-sm font-semibold">
                            Nama pelanggan
                        </label>
                        <input
                            id="nama_pelanggan"
                            type="text"
                            name="nama_pelanggan"
                            value="{{ old('nama_pelanggan') }}"
                            required
                            maxlength="255"
                            placeholder="Masukkan nama kamu"
                            class="w-full rounded-xl border border-stone-300 px-4 py-3 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100"
                        >
                        @error('nama_pelanggan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jumlah"
                               class="mb-2 block text-sm font-semibold">
                            Jumlah pesanan
                        </label>
                        <input
                            id="jumlah"
                            type="number"
                            name="jumlah"
                            value="{{ old('jumlah', 1) }}"
                            min="1"
                            max="100"
                            required
                            class="w-full rounded-xl border border-stone-300 px-4 py-3 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100"
                        >
                        @error('jumlah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="metode_pembayaran"
                               class="mb-2 block text-sm font-semibold">
                            Metode pembayaran
                        </label>
                        <select
                            id="metode_pembayaran"
                            name="metode_pembayaran"
                            required
                            class="w-full rounded-xl border border-stone-300 px-4 py-3 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100"
                        >
                            <option value="tunai"
                                {{ old('metode_pembayaran', 'tunai') === 'tunai' ? 'selected' : '' }}>
                                Tunai
                            </option>
                            <option value="qris"
                                {{ old('metode_pembayaran') === 'qris' ? 'selected' : '' }}>
                                QRIS — belum diproses
                            </option>
                        </select>
                        <p class="mt-2 text-xs leading-5 text-stone-500">
                            Metode hanya dicatat pada pesanan. Pembayaran belum diproses oleh sistem.
                        </p>
                        @error('metode_pembayaran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="rounded-xl bg-orange-50 p-4">
                        <p class="text-sm text-stone-600">
                            Total dihitung otomatis oleh server berdasarkan harga menu dan jumlah pesanan.
                        </p>
                        <p class="mt-1 text-sm font-semibold text-orange-800">
                            Status awal pesanan: Pending
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a
                            href="{{ route('katalog') }}"
                            class="rounded-xl border border-stone-300 px-5 py-3 text-center text-sm font-bold text-stone-700 hover:bg-stone-50 sm:flex-1"
                        >
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="rounded-xl bg-orange-600 px-5 py-3 text-sm font-bold text-white hover:bg-orange-700 sm:flex-1"
                        >
                            Konfirmasi Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-stone-500">
        &copy; {{ date('Y') }} Warung Mama Rina
    </footer>

</body>
</html>
