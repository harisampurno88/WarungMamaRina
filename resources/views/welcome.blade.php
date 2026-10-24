<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Warung Mama Rina — Pemesanan Makanan Online</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-50 text-stone-900 antialiased">

    {{-- Navbar --}}
    <header class="sticky top-0 z-30 border-b border-stone-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

            <a href="{{ route('katalog') }}" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-600 text-xl font-bold text-white">
                    M
                </div>

                <div>
                    <span class="text-xl font-extrabold text-stone-900">
                        Warung Mama Rina
                    </span>
                    <p class="text-xs text-stone-500">
                        Masakan Rumahan Asli Nusantara
                    </p>
                </div>
            </a>

            <nav class="hidden items-center gap-6 text-sm font-semibold text-stone-600 md:flex">
                <a href="#beranda" class="hover:text-orange-600">Beranda</a>
                <a href="#menu" class="hover:text-orange-600">Daftar Menu</a>
                <a href="#cara-pesan" class="hover:text-orange-600">Cara Pesan</a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('menu.index') }}"
                       class="rounded-xl border border-stone-200 px-4 py-2 text-sm font-semibold text-stone-700 hover:bg-stone-100">
                        Kelola Menu
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-xl px-4 py-2 text-sm font-semibold text-stone-700 hover:text-orange-600">
                        Masuk Admin
                    </a>
                @endauth
            </div>

        </div>
    </header>


    {{-- Pesan sukses atau error --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mt-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                <p class="font-semibold">Terjadi kesalahan:</p>
                <ul class="mt-2 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>


    {{-- Hero Section --}}
    <section id="beranda" class="bg-gradient-to-b from-orange-50/70 to-stone-50 py-14">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">

            <div class="space-y-5 lg:col-span-7">
                <span class="inline-block rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-800">
                    🔥 Dimasak Fresh Setiap Hari
                </span>

                <h1 class="text-4xl font-extrabold leading-tight text-stone-900 sm:text-5xl">
                    Kangen Masakan Ibu?
                    <span class="text-orange-600">Warung Mama Rina</span>
                    Siap Menemani!
                </h1>

                <p class="text-lg text-stone-600">
                    Temukan makanan rumahan favoritmu dengan rasa lezat,
                    harga bersahabat, dan kualitas terbaik.
                </p>

                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="#menu"
                       class="rounded-xl bg-orange-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg hover:bg-orange-700">
                        Lihat Menu
                    </a>

                    <a href="#cara-pesan"
                       class="rounded-xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-semibold text-stone-700 hover:bg-stone-100">
                        Cara Pemesanan
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <img
                    src="{{ asset('images/hero-warung.jpg') }}"
                    alt="Warung Mama Rina"
                    class="h-80 w-full rounded-3xl border-4 border-white object-cover shadow-2xl"
                    onerror="this.style.display='none'"
                >
            </div>

        </div>
    </section>


    {{-- Katalog Menu dari database --}}
    <section id="menu" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-stone-900">
                Menu Pilihan Hari Ini
            </h2>

            <p class="mt-1 text-sm text-stone-500">
                Pilih makanan favoritmu dari daftar menu Warung Mama Rina.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

            @forelse ($menus as $menu)

                <div class="flex flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    {{-- Foto menu --}}
                    @if ($menu->gambar)
                        <img
                            src="{{ asset('storage/' . $menu->gambar) }}"
                            alt="{{ $menu->nama }}"
                            class="h-48 w-full object-cover"
                            loading="lazy"
                        >
                    @else
                        <div class="flex h-48 w-full items-center justify-center bg-orange-50 text-5xl">
                            🍽️
                        </div>
                    @endif

                    <div class="flex flex-1 flex-col justify-between p-4">

                        <div>
                            <span class="text-xs font-bold uppercase text-orange-600">
                                Menu Utama
                            </span>

                            <h3 class="mt-1 text-base font-bold text-stone-900">
                                {{ $menu->nama }}
                            </h3>

                            <p class="mt-2 line-clamp-3 text-sm text-stone-500">
                                {{ $menu->deskripsi ?: 'Menu lezat dari Warung Mama Rina.' }}
                            </p>
                        </div>

                        <div class="mt-4 border-t border-stone-100 pt-4">

                            <div class="mb-4 flex items-center justify-between gap-2">
                                <span class="font-extrabold text-stone-900">
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </span>

                                @if ($menu->is_available)
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Habis
                                    </span>
                                @endif
                            </div>

                            {{-- Bagian tombol pesanan yang sudah diperbaiki --}}
                            @if ($menu->is_available)
                                <a
                                    href="{{ route('order.create', $menu->id) }}"
                                    class="block w-full rounded-xl bg-orange-600 px-4 py-3 text-center text-sm font-bold text-white transition hover:bg-orange-700"
                                >
                                    Pesan Sekarang
                                </a>
                            @else
                                <button
                                    type="button"
                                    disabled
                                    class="w-full cursor-not-allowed rounded-xl bg-stone-200 px-4 py-3 text-sm font-bold text-stone-500"
                                >
                                    Menu Tidak Tersedia
                                </button>
                            @endif

                        </div>
                    </div>
                </div>

            @empty

                <div class="col-span-full rounded-2xl border border-dashed border-stone-300 bg-white px-6 py-14 text-center">
                    <div class="mb-3 text-5xl">🍽️</div>

                    <h3 class="text-lg font-bold text-stone-800">
                        Belum Ada Menu
                    </h3>

                    <p class="mt-2 text-sm text-stone-500">
                        Menu yang tersedia akan ditampilkan di sini.
                    </p>

                    @auth
                        <a
                            href="{{ route('menu.create') }}"
                            class="mt-5 inline-flex rounded-xl bg-orange-600 px-5 py-3 text-sm font-bold text-white hover:bg-orange-700"
                        >
                            + Tambah Menu
                        </a>
                    @endauth
                </div>

            @endforelse

        </div>
    </section>


    {{-- Cara Pemesanan --}}
    <section id="cara-pesan" class="bg-white py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mb-10 text-center">
                <h2 class="text-3xl font-extrabold text-stone-900">
                    Cara Pemesanan
                </h2>

                <p class="mt-2 text-stone-500">
                    Nikmati menu favoritmu melalui langkah sederhana.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                <div class="rounded-2xl border border-stone-200 p-6 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-2xl">
                        🍱
                    </div>
                    {{-- Format angka dirapikan ke dalam tag h3 --}}
                    <h3 class="font-bold text-stone-900">1. Pilih Menu</h3>
                    <p class="mt-2 text-sm text-stone-500">
                        Pilih makanan yang tersedia di katalog.
                    </p>
                </div>

                <div class="rounded-2xl border border-stone-200 p-6 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-2xl">
                        📝
                    </div>
                    <h3 class="font-bold text-stone-900">2. Buat Pesanan</h3>
                    <p class="mt-2 text-sm text-stone-500">
                        Kirim pilihan menu untuk diproses.
                    </p>
                </div>

                <div class="rounded-2xl border border-stone-200 p-6 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-2xl">
                        🛵
                    </div>
                    <h3 class="font-bold text-stone-900">3. Konfirmasi Pesanan</h3>
                    <p class="mt-2 text-sm text-stone-500">
                        Pesanan tersimpan dengan status menunggu (pending). Pembayaran belum diproses melalui aplikasi.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- Footer --}}
    <footer class="border-t border-stone-200 bg-stone-50 py-8">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <p class="font-bold text-stone-800">Warung Mama Rina</p>
            <p class="mt-1 text-sm text-stone-500">
                Masakan rumahan dengan rasa istimewa.
            </p>
            <p class="mt-4 text-xs text-stone-400">
                &copy; {{ date('Y') }} Warung Mama Rina. Hak cipta dilindungi.
            </p>
        </div>
    </footer>

</body>
</html>