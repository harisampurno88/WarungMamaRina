<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <title>Dapur Mama Rina — Spesial Ayam Geprek Sambel Ijo</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f2f7ef',
                            100: '#e0eed9',
                            200: '#c2dfb5',
                            500: '#3f7027',
                            600: '#2d531a',
                            700: '#224013',
                            800: '#19300e',
                            900: '#12230a',
                        }
                    }
                }
            }
        }
    </script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-toast {
            animation: slideUpFade 0.25s ease-out forwards;
        }
    </style>
</head>

<body class="bg-stone-50 text-stone-900 antialiased">

    {{-- Navbar --}}
    <header class="sticky top-0 z-30 border-b border-stone-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex h-24 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

            <a href="{{ route('katalog') }}" class="flex items-center gap-4">
                <img
                    src="{{ asset('storage/menus/logo-dapur-mama-rina.jpeg') }}"
                    alt="Logo Dapur Mama Rina"
                    class="h-16 sm:h-20 w-auto object-contain"
                >

                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xl font-extrabold text-brand-800">
                            Dapur Mama Rina
                        </span>
                        <span class="hidden rounded-full border border-amber-300 bg-amber-100 px-2 py-0.5 text-[11px] font-bold text-amber-800 sm:inline-block">
                            Since 2023
                        </span>
                    </div>
                    <p class="text-xs font-semibold text-brand-600">
                        Spesial Ayam Geprek Sambel Ijo
                    </p>
                </div>
            </a>

            <nav class="hidden items-center gap-6 text-sm font-semibold text-stone-600 md:flex">
                <a href="#beranda" class="transition hover:text-brand-600">Beranda</a>
                <a href="#menu" class="transition hover:text-brand-600">Daftar Menu</a>
                <a href="#cara-pesan" class="transition hover:text-brand-600">Cara Pesan</a>
                <a href="#lokasi" class="transition hover:text-brand-600">Lokasi</a>
            </nav>

            <div class="flex items-center gap-2.5 sm:gap-3">
                {{-- Tombol Buka Keranjang Pesanan --}}
                <button
                    type="button"
                    onclick="bukaKeranjang()"
                    class="relative inline-flex items-center gap-2 rounded-xl bg-brand-600 px-3.5 py-2 sm:px-4 sm:py-2.5 text-xs sm:text-sm font-bold text-white shadow-md transition hover:bg-brand-700 active:scale-95"
                    title="Lihat Keranjang Pesanan"
                >
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="hidden sm:inline">Pesanan</span>
                    <span id="navCartCount" class="rounded-full bg-white px-2 py-0.5 text-xs font-black text-brand-700">0</span>
                </button>

                @auth
                    <a href="{{ route('menu.index') }}"
                       class="rounded-xl border border-brand-200 bg-brand-50 px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-100">
                        Kelola Menu
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-xl border border-stone-200 bg-white px-3.5 py-2 text-xs sm:text-sm font-semibold text-stone-700 shadow-sm transition hover:bg-stone-50">
                        Masuk Admin
                    </a>
                @endauth
            </div>

        </div>
    </header>

    {{-- Notifikasi Sukses / Error --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mt-5 rounded-xl border border-brand-200 bg-brand-50 p-4 text-sm text-brand-800">
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
    <section id="beranda" class="bg-gradient-to-b from-brand-50/90 via-white to-stone-50 py-14">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">

            <div class="space-y-5 lg:col-span-7">
                <span class="inline-block rounded-full border border-brand-200 bg-brand-100 px-3.5 py-1 text-xs font-bold text-brand-800">
                    🌶️ Spesial Ayam Geprek Sambel Ijo • Dimasak Fresh Setiap Hari
                </span>

                <h1 class="text-4xl font-extrabold leading-tight text-stone-900 sm:text-5xl">
                    Pedas Gurihnya Bikin Nagih!
                    <span class="text-brand-600">Dapur Mama Rina</span>
                    Siap Menemani!
                </h1>

                <p class="text-lg text-stone-600">
                    Nikmati renyahnya Ayam Geprek crispy berpadu dengan Sambel Ijo ulek segar khas Dapur Mama Rina, harga bersahabat, dan kualitas terbaik.
                </p>

                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="#menu"
                       class="rounded-xl bg-brand-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg transition hover:bg-brand-700">
                        Lihat Menu Makanan
                    </a>

                    <a href="#cara-pesan"
                       class="rounded-xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-semibold text-stone-700 transition hover:bg-stone-100">
                        Cara Pemesanan
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                {{-- Carousel 3 Gambar Menu Dapur Mama Rina (Berganti Otomatis Setiap 3.5 Detik) --}}
                <div class="relative h-80 w-full overflow-hidden rounded-3xl border-4 border-white shadow-2xl bg-stone-900 group">
                    {{-- Slide 1: Paket Nasi Ayam Geprek Sambel Ijo --}}
                    <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100">
                        <img
                            src="{{ asset('storage/menus/hero-warung.jpeg') }}"
                            alt="Paket Nasi Ayam Geprek Sambel Ijo"
                            class="h-full w-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-950/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between rounded-2xl bg-white/95 px-4 py-3 shadow-lg backdrop-blur">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-brand-700">Menu Utama #1</span>
                                <p class="text-sm font-bold text-stone-900">Paket Ayam Geprek Sambel Ijo</p>
                            </div>
                            <span class="rounded-xl bg-brand-600 px-3 py-1.5 text-xs font-bold text-white shadow">Spesial</span>
                        </div>
                    </div>

                    {{-- Slide 2: Tempe Goreng Tepung Crispy --}}
                    <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 pointer-events-none">
                        <img
                            src="{{ asset('storage/menus/tempe-goreng-tepung.jpeg') }}"
                            alt="Tempe Goreng Tepung Crispy"
                            class="h-full w-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-950/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between rounded-2xl bg-white/95 px-4 py-3 shadow-lg backdrop-blur">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-brand-700">Lauk Renyah</span>
                                <p class="text-sm font-bold text-stone-900">Tempe Goreng Tepung Crispy</p>
                            </div>
                            <span class="rounded-xl bg-brand-600 px-3 py-1.5 text-xs font-bold text-white shadow">Garing</span>
                        </div>
                    </div>

                    {{-- Slide 3: Terong Goreng Tepung Crispy --}}
                    <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 pointer-events-none">
                        <img
                            src="{{ asset('storage/menus/terong-goreng-tepung.jpeg') }}"
                            alt="Terong Goreng Tepung Crispy"
                            class="h-full w-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-950/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between rounded-2xl bg-white/95 px-4 py-3 shadow-lg backdrop-blur">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-brand-700">Pelengkap Nikmat</span>
                                <p class="text-sm font-bold text-stone-900">Terong Goreng Tepung Crispy</p>
                            </div>
                            <span class="rounded-xl bg-brand-600 px-3 py-1.5 text-xs font-bold text-white shadow">Gurih</span>
                        </div>
                    </div>

                    {{-- Indikator Slide (Dot) --}}
                    <div class="absolute top-4 right-4 z-10 flex items-center gap-1.5 rounded-full bg-stone-900/60 px-3 py-1.5 backdrop-blur">
                        <button type="button" aria-label="Slide 1" class="hero-dot h-2 w-6 rounded-full bg-white transition-all duration-300" onclick="goToHeroSlide(0)"></button>
                        <button type="button" aria-label="Slide 2" class="hero-dot h-2 w-2 rounded-full bg-white/50 transition-all duration-300" onclick="goToHeroSlide(1)"></button>
                        <button type="button" aria-label="Slide 3" class="hero-dot h-2 w-2 rounded-full bg-white/50 transition-all duration-300" onclick="goToHeroSlide(2)"></button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Katalog Menu dari Database --}}
    <section id="menu" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-brand-600">
                    🍗 Daftar Menu Makanan
                </span>
                <h2 class="mt-1 text-3xl font-extrabold text-stone-900">
                    Menu Pilihan Hari Ini
                </h2>
                <p class="mt-1 text-sm text-stone-500">
                    Klik <strong>"+ Pesan Sekarang"</strong> untuk menambahkan menu ke dalam satu pesanan.
                </p>
            </div>

            <button
                type="button"
                onclick="bukaKeranjang()"
                class="self-start md:self-auto inline-flex items-center gap-2 rounded-xl bg-stone-900 px-4 py-2 text-xs font-semibold text-white shadow transition hover:bg-stone-800"
            >
                <span>🛒 Lihat Daftar Pesanan</span>
                <span id="quickCartCount" class="rounded-full bg-brand-600 px-2 py-0.5 text-[11px] font-bold text-white">0</span>
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($menus as $menu)
                <div class="flex flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    @if ($menu->gambar)
                        <img
                            src="{{ asset('storage/' . $menu->gambar) }}"
                            alt="{{ $menu->nama }}"
                            class="h-56 w-full object-cover"
                            loading="lazy"
                        >
                    @else
                        <div class="flex h-56 w-full items-center justify-center bg-brand-50 text-5xl">
                            🍽️
                        </div>
                    @endif

                    <div class="flex flex-1 flex-col justify-between p-5">
                        <div>
                            <span class="text-xs font-bold uppercase text-brand-600">
                                Menu Dapur Mama Rina
                            </span>
                            <h3 class="mt-1 text-lg font-bold text-stone-900">
                                {{ $menu->nama }}
                            </h3>
                            <p class="mt-2 line-clamp-3 text-sm text-stone-500">
                                {{ $menu->deskripsi ?: 'Menu lezat dari Dapur Mama Rina.' }}
                            </p>
                        </div>

                        <div class="mt-4 border-t border-stone-100 pt-4">
                            <div class="mb-4 flex items-center justify-between gap-2">
                                <span class="text-lg font-extrabold text-stone-900">
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </span>

                                @if ($menu->is_available)
                                    <span class="rounded-full bg-brand-100 px-3 py-1 text-xs font-semibold text-brand-700">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Habis
                                    </span>
                                @endif
                            </div>

                            @if ($menu->is_available)
                                <button
                                    type="button"
                                    onclick="tambahKePesanan({{ $menu->id }}, '{{ addslashes($menu->nama) }}', {{ $menu->harga }}, '{{ $menu->gambar ? asset('storage/' . $menu->gambar) : '' }}')"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-brand-600 px-4 py-3 text-center text-sm font-bold text-white shadow-md transition duration-200 hover:bg-brand-700 active:scale-98"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                    + Pesan Sekarang
                                </button>
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
                    <h3 class="text-lg font-bold text-stone-800">Belum Ada Menu</h3>
                    <p class="mt-2 text-sm text-stone-500">Menu yang tersedia akan ditampilkan di sini.</p>
                    @auth
                        <a
                            href="{{ route('menu.create') }}"
                            class="mt-5 inline-flex rounded-xl bg-brand-600 px-5 py-3 text-sm font-bold text-white hover:bg-brand-700"
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
                <span class="text-xs font-bold uppercase tracking-wider text-brand-600">
                    Mudah & Cepat
                </span>
                <h2 class="mt-1 text-3xl font-extrabold text-stone-900">
                    Cara Pemesanan
                </h2>
                <p class="mt-2 text-stone-500">
                    Bisa memesan lebih dari satu menu sekaligus dalam sekali transaksi.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="rounded-2xl border border-stone-200 p-6 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-100 text-2xl">
                        🍱
                    </div>
                    <h3 class="font-bold text-stone-900">1. Pilih Menu</h3>
                    <p class="mt-2 text-sm text-stone-500">
                        Klik tombol <strong>+ Pesan Sekarang</strong> pada menu-menu yang ingin kamu santap.
                    </p>
                </div>

                <div class="rounded-2xl border border-stone-200 p-6 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-100 text-2xl">
                        📝
                    </div>
                    <h3 class="font-bold text-stone-900">2. Atur Porsi & Data Diri</h3>
                    <p class="mt-2 text-sm text-stone-500">
                        Buka keranjang pesanan, sesuaikan jumlah porsi tiap menu, dan masukkan namamu.
                    </p>
                </div>

                <div class="rounded-2xl border border-stone-200 p-6 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-100 text-2xl">
                        🛵
                    </div>
                    <h3 class="font-bold text-stone-900">3. Konfirmasi Pesanan</h3>
                    <p class="mt-2 text-sm text-stone-500">
                        Pesanan tersimpan dengan status pending dan siap diproses oleh Dapur Mama Rina.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Lokasi Kami (Dari Branch backend-api) --}}
    <section id="lokasi" class="bg-stone-50 py-14">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="mb-6 text-center">
                    <span class="text-xs font-bold uppercase tracking-wider text-brand-600">
                        Lokasi
                    </span>
                    <h2 class="mt-1 text-3xl font-extrabold text-stone-900">
                        Kantor & Lokasi Dapur Mama Rina
                    </h2>
                </div>

                <div class="grid gap-6 md:grid-cols-[1.2fr_0.8fr] md:items-center">
                    <div class="rounded-2xl border border-stone-200 bg-stone-50 p-5">
                        <div class="mb-3 flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-100 text-xl">📍</div>
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-wide text-stone-500">Alamat</p>
                                <p class="text-lg font-bold text-stone-900">Dapur Mama Rina</p>
                            </div>
                        </div>

                        <p class="text-base leading-relaxed text-stone-600">
                            633H+3QM, Padang Sakti, Kec. Muara Satu, Kota Lhokseumawe, Aceh 24355
                        </p>

                        <a
                            href="https://www.google.com/maps/search/?api=1&query=633H%2B3QM%2C+Padang+Sakti%2C+Kec.+Muara+Satu%2C+Kota+Lhokseumawe%2C+Aceh+24355"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-brand-700"
                        >
                            <span>🧭</span>
                            Buka di Google Maps
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-stone-200 bg-stone-100">
                        <iframe
                            src="https://www.google.com/maps?q=633H%2B3QM%2C%20Padang%20Sakti%2C%20Kec.%20Muara%20Satu%2C%20Kota%20Lhokseumawe%2C%20Aceh%2024355&output=embed"
                            width="100%"
                            height="260"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi Dapur Mama Rina"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-stone-200 bg-stone-50 py-8">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <img
                src="{{ asset('storage/menus/logo-dapur-mama-rina.jpeg') }}"
                alt="Logo Dapur Mama Rina"
                class="mx-auto mb-3 h-20 w-auto object-contain"
            >
            <p class="font-bold text-brand-800">Dapur Mama Rina — Since 2023</p>
            <p class="mt-1 text-sm font-medium text-brand-600">
                Spesial Ayam Geprek Sambel Ijo
            </p>
            <p class="mt-4 text-xs text-stone-400">
                &copy; {{ date('Y') }} Dapur Mama Rina. Hak cipta dilindungi.
            </p>
        </div>
    </footer>

    {{-- Floating Bar Ringkasan Pesanan --}}
    <div id="floatingCartBar" class="fixed bottom-5 left-4 right-4 z-40 mx-auto hidden max-w-2xl transform transition-all duration-300">
        <div class="flex items-center justify-between gap-4 rounded-2xl bg-stone-900/95 p-3.5 sm:p-4 text-white shadow-2xl backdrop-blur border border-stone-700">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-600 text-lg font-bold">
                    🛒
                </div>
                <div>
                    <p id="floatingCartTitle" class="text-sm font-bold">0 Menu Dipilih</p>
                    <p id="floatingCartTotal" class="text-xs text-brand-400 font-semibold">Rp 0</p>
                </div>
            </div>
            <button
                type="button"
                onclick="bukaKeranjang()"
                class="flex items-center gap-1.5 rounded-xl bg-brand-600 hover:bg-brand-500 px-4 py-2.5 text-xs sm:text-sm font-bold text-white shadow transition active:scale-95"
            >
                <span>Lihat Keranjang</span>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </div>

    {{-- Slide-Over Drawer Keranjang Pesanan Multi-Menu --}}
    <div id="cartBackdrop" onclick="tutupKeranjang()" class="fixed inset-0 z-50 hidden bg-stone-950/60 backdrop-blur-xs opacity-0 transition-opacity duration-300"></div>

    <aside id="cartDrawer" class="fixed bottom-0 right-0 top-0 z-50 flex w-full max-w-md translate-x-full flex-col border-l border-stone-200 bg-white shadow-2xl transition-transform duration-300">
        <div class="flex items-center justify-between border-b border-stone-200 bg-stone-50 px-5 py-4">
            <div>
                <h3 class="text-lg font-extrabold text-stone-900">Keranjang Pesanan</h3>
                <p class="text-xs text-stone-500">Pesan banyak menu dalam 1 transaksi</p>
            </div>
            <button type="button" onclick="tutupKeranjang()" class="rounded-xl p-2 text-stone-400 hover:bg-stone-200 hover:text-stone-700 transition" aria-label="Tutup Keranjang">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-5">
            <div id="cartEmptyState" class="py-12 text-center text-stone-500">
                <div class="mb-3 text-5xl">🛒</div>
                <p class="text-sm font-bold text-stone-700">Keranjang masih kosong</p>
                <p class="mt-1 text-xs text-stone-400 leading-relaxed max-w-xs mx-auto">
                    Silakan klik tombol <strong>"+ Pesan Sekarang"</strong> pada menu yang ingin kamu pesan.
                </p>
            </div>

            <div id="cartItemsContainer" class="space-y-3"></div>

            <form id="multiOrderForm" action="{{ route('order.store') }}" method="POST" class="mt-6 hidden border-t border-stone-200 pt-5 space-y-4">
                @csrf

                <div id="hiddenItemsContainer"></div>

                <div>
                    <label for="inputNamaPelanggan" class="block text-xs font-bold text-stone-700 mb-1">
                        Nama Pemesan <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="inputNamaPelanggan"
                        type="text"
                        name="nama_pelanggan"
                        required
                        placeholder="Masukkan nama lengkap kamu"
                        class="w-full rounded-xl border border-stone-300 px-3.5 py-2.5 text-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200"
                    >
                </div>

                <div>
                    <label for="selectMetodePembayaran" class="block text-xs font-bold text-stone-700 mb-1">
                        Metode Pembayaran <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="selectMetodePembayaran"
                        name="metode_pembayaran"
                        required
                        class="w-full rounded-xl border border-stone-300 bg-white px-3.5 py-2.5 text-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200"
                    >
                        <option value="tunai">💵 Bayar Tunai di Tempat (Cash)</option>
                        <option value="qris">📱 QRIS Instan</option>
                    </select>
                </div>

                <div class="rounded-xl bg-brand-50 border border-brand-200 p-3.5 text-xs text-brand-900 leading-relaxed">
                    💡 Semua menu di atas akan diproses dalam <strong>1 nomor pesanan</strong> dengan status <strong>Pending</strong>.
                </div>
            </form>
        </div>

        <div id="cartFooterArea" class="border-t border-stone-200 bg-stone-50 p-5 space-y-3">
            <div class="flex items-center justify-between text-xs text-stone-500">
                <span>Total Porsi:</span>
                <span id="drawerTotalItems" class="font-bold text-stone-800">0 Porsi</span>
            </div>
            <div class="flex items-center justify-between border-t border-stone-200 pt-2 text-base font-extrabold text-stone-900">
                <span>Total Bayar:</span>
                <span id="drawerTotalPrice" class="text-lg text-brand-700">Rp 0</span>
            </div>

            <button
                id="btnSubmitMultiOrder"
                type="button"
                onclick="submitMultiOrder()"
                disabled
                class="w-full rounded-xl bg-brand-600 py-3.5 px-4 text-center text-sm font-bold text-white shadow-lg shadow-brand-600/20 transition hover:bg-brand-700 disabled:cursor-not-allowed disabled:bg-stone-300"
            >
                Konfirmasi Pesanan Sekarang
            </button>
        </div>
    </aside>

    {{-- Toast Notifikasi --}}
    <div id="toastNotification" class="fixed top-6 right-6 z-50 hidden rounded-2xl bg-stone-900 text-white px-4 py-3 shadow-2xl border border-stone-700 text-xs sm:text-sm font-semibold animate-toast">
        <span id="toastMessage"></span>
    </div>

    {{-- Script Slider & Keranjang Multi-Menu --}}
    <script>
        // 1. Slider Gambar Hero
        let currentHeroSlide = 0;
        const heroSlides = document.querySelectorAll('.hero-slide');
        const heroDots = document.querySelectorAll('.hero-dot');
        let heroSlideTimer = null;

        function showHeroSlide(index) {
            if (!heroSlides.length) return;
            currentHeroSlide = (index + heroSlides.length) % heroSlides.length;

            heroSlides.forEach((slide, idx) => {
                if (idx === currentHeroSlide) {
                    slide.classList.remove('opacity-0', 'pointer-events-none');
                    slide.classList.add('opacity-100');
                } else {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0', 'pointer-events-none');
                }
            });

            heroDots.forEach((dot, idx) => {
                if (idx === currentHeroSlide) {
                    dot.className = 'hero-dot h-2 w-6 rounded-full bg-white transition-all duration-300';
                } else {
                    dot.className = 'hero-dot h-2 w-2 rounded-full bg-white/50 transition-all duration-300';
                }
            });
        }

        function goToHeroSlide(index) {
            showHeroSlide(index);
            resetHeroTimer();
        }

        function resetHeroTimer() {
            if (heroSlideTimer) clearInterval(heroSlideTimer);
            heroSlideTimer = setInterval(() => {
                showHeroSlide(currentHeroSlide + 1);
            }, 3500);
        }

        // 2. Sistem Keranjang Pesanan Multi-Menu
        let keranjangPesanan = [];

        function formatRupiah(angka) {
            return 'Rp ' + Number(angka).toLocaleString('id-ID');
        }

        function munculkanToast(pesan) {
            const toast = document.getElementById('toastNotification');
            const msg = document.getElementById('toastMessage');
            msg.innerHTML = pesan;
            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2500);
        }

        function tambahKePesanan(menuId, namaMenu, harga, gambarUrl) {
            const existing = keranjangPesanan.find(item => item.id === menuId);
            if (existing) {
                existing.jumlah += 1;
            } else {
                keranjangPesanan.push({
                    id: menuId,
                    nama: namaMenu,
                    harga: Number(harga),
                    gambar: gambarUrl,
                    jumlah: 1
                });
            }

            perbaruiTampilanKeranjang();
            munculkanToast(`✅ <strong>${namaMenu}</strong> ditambahkan ke pesanan!`);
        }

        function ubahJumlahItem(menuId, delta) {
            const idx = keranjangPesanan.findIndex(item => item.id === menuId);
            if (idx === -1) return;

            keranjangPesanan[idx].jumlah += delta;
            if (keranjangPesanan[idx].jumlah <= 0) {
                keranjangPesanan.splice(idx, 1);
            }

            perbaruiTampilanKeranjang();
        }

        function hapusItem(menuId) {
            keranjangPesanan = keranjangPesanan.filter(item => item.id !== menuId);
            perbaruiTampilanKeranjang();
        }

        function perbaruiTampilanKeranjang() {
            const container = document.getElementById('cartItemsContainer');
            const emptyState = document.getElementById('cartEmptyState');
            const form = document.getElementById('multiOrderForm');
            const navBadge = document.getElementById('navCartCount');
            const quickBadge = document.getElementById('quickCartCount');
            const floatingBar = document.getElementById('floatingCartBar');
            const floatingTitle = document.getElementById('floatingCartTitle');
            const floatingTotal = document.getElementById('floatingCartTotal');
            const drawerItems = document.getElementById('drawerTotalItems');
            const drawerTotal = document.getElementById('drawerTotalPrice');
            const submitBtn = document.getElementById('btnSubmitMultiOrder');
            const hiddenInputsContainer = document.getElementById('hiddenItemsContainer');

            const totalItemCount = keranjangPesanan.reduce((sum, it) => sum + it.jumlah, 0);
            let totalHarga = 0;

            if (navBadge) navBadge.textContent = totalItemCount;
            if (quickBadge) quickBadge.textContent = totalItemCount;

            if (keranjangPesanan.length === 0) {
                emptyState.classList.remove('hidden');
                form.classList.add('hidden');
                floatingBar.classList.add('hidden');
                container.innerHTML = '';
                hiddenInputsContainer.innerHTML = '';
                drawerItems.textContent = '0 Porsi';
                drawerTotal.textContent = 'Rp 0';
                submitBtn.disabled = true;
                return;
            }

            emptyState.classList.add('hidden');
            form.classList.remove('hidden');
            floatingBar.classList.remove('hidden');
            submitBtn.disabled = false;

            container.innerHTML = keranjangPesanan.map(item => {
                const subtotal = item.harga * item.jumlah;
                totalHarga += subtotal;

                return `
                    <div class="flex items-center gap-3 rounded-2xl border border-stone-200 bg-stone-50 p-3">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-stone-200">
                            ${item.gambar ? `<img src="${item.gambar}" alt="${item.nama}" class="h-full w-full object-cover">` : `<span class="text-xl">🍽️</span>`}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="truncate text-xs font-bold text-stone-900">${item.nama}</h4>
                            <p class="text-xs font-semibold text-brand-700 mt-0.5">${formatRupiah(item.harga)}</p>
                            <p class="text-[11px] text-stone-400">Subtotal: ${formatRupiah(subtotal)}</p>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <button type="button" onclick="ubahJumlahItem(${item.id}, -1)" class="flex h-7 w-7 items-center justify-center rounded-lg border border-stone-300 bg-white text-xs font-bold text-stone-700 hover:bg-stone-100">-</button>
                            <span class="w-5 text-center text-xs font-extrabold text-stone-900">${item.jumlah}</span>
                            <button type="button" onclick="ubahJumlahItem(${item.id}, 1)" class="flex h-7 w-7 items-center justify-center rounded-lg bg-brand-600 text-xs font-bold text-white hover:bg-brand-700">+</button>
                            <button type="button" onclick="hapusItem(${item.id})" class="ml-1 text-stone-400 hover:text-red-500" title="Hapus menu">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');

            hiddenInputsContainer.innerHTML = keranjangPesanan.map((item, idx) => `
                <input type="hidden" name="items[${idx}][menu_id]" value="${item.id}">
                <input type="hidden" name="items[${idx}][jumlah]" value="${item.jumlah}">
            `).join('');

            drawerItems.textContent = `${totalItemCount} Porsi (${keranjangPesanan.length} Menu)`;
            drawerTotal.textContent = formatRupiah(totalHarga);
            floatingTitle.textContent = `${keranjangPesanan.length} Menu (${totalItemCount} Porsi)`;
            floatingTotal.textContent = formatRupiah(totalHarga);
        }

        function bukaKeranjang() {
            const backdrop = document.getElementById('cartBackdrop');
            const drawer = document.getElementById('cartDrawer');

            backdrop.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                drawer.classList.remove('translate-x-full');
            }, 10);
        }

        function tutupKeranjang() {
            const backdrop = document.getElementById('cartBackdrop');
            const drawer = document.getElementById('cartDrawer');

            backdrop.classList.add('opacity-0');
            drawer.classList.add('translate-x-full');

            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 300);
        }

        function submitMultiOrder() {
            if (keranjangPesanan.length === 0) {
                munculkanToast('⚠️ Pilih minimal 1 menu terlebih dahulu!');
                return;
            }

            const namaInput = document.getElementById('inputNamaPelanggan');
            if (!namaInput.value.trim()) {
                namaInput.focus();
                munculkanToast('⚠️ Mohon masukkan nama pemesan!');
                return;
            }

            document.getElementById('multiOrderForm').submit();
        }

        document.addEventListener('DOMContentLoaded', () => {
            resetHeroTimer();
            perbaruiTampilanKeranjang();
        });
    </script>
</body>
</html>