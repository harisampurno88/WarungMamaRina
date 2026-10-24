
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Dapur Mama Rina — Spesial Ayam Geprek Sambel Ijo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
=======

    <title>Warung Mama Rina — Pemesanan Makanan Online</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
>>>>>>> origin/main
</head>

<body class="bg-stone-50 text-stone-900 antialiased">

<<<<<<< HEAD
    {{-- Navbar dengan Logo Dapur Mama Rina & Tema Hijau Daun --}}
    <header class="sticky top-0 z-30 bg-white/95 backdrop-blur border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-dapur-mama-rina.jpeg') }}" alt="Logo Dapur Mama Rina" class="w-14 h-14 rounded-2xl object-contain border border-green-200 p-0.5 bg-white shadow-sm">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-extrabold text-xl text-[#19300e]">Dapur Mama Rina</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-300">Since 2023</span>
                    </div>
                    <p class="text-xs font-semibold text-[#2d531a]">Spesial Ayam Geprek Sambel Ijo</p>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-stone-600">
                <a href="#beranda" class="hover:text-[#2d531a]">Beranda</a>
                <a href="#menu" class="hover:text-[#2d531a]">Menu Makanan</a>
            </nav>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl border border-stone-200 text-sm font-semibold text-stone-700 hover:bg-stone-100">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-sm font-semibold text-stone-700 hover:text-[#2d531a]">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2.5 rounded-xl bg-[#2d531a] hover:bg-[#224013] text-white text-sm font-bold shadow">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif
=======
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
>>>>>>> origin/main
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
<<<<<<< HEAD
    <section id="beranda" class="py-12 bg-gradient-to-b from-[#f2f7ef] to-stone-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7 space-y-5">
                <span class="inline-block px-3 py-1 rounded-full bg-[#e0eed9] text-[#19300e] text-xs font-bold">
                    🌶️ Spesial Ayam Geprek Sambel Ijo • Since 2023
                </span>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-stone-900 leading-tight">
                    Pedas Gurihnya Bikin Nagih! <span class="text-[#2d531a]">Dapur Mama Rina</span>
                </h1>
                <p class="text-stone-600 text-lg">
                    Nikmati renyahnya Ayam Geprek crispy berpadu dengan Sambel Ijo ulek segar, lengkap dengan Tempe Goreng Tepung dan Terong Goreng krispi.
                </p>
                <div class="flex gap-3 pt-2">
                    <a href="#menu" class="px-6 py-3.5 rounded-xl bg-[#2d531a] hover:bg-[#224013] text-white font-bold text-sm shadow-lg">
                        Lihat Menu Makanan
=======
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
>>>>>>> origin/main
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
<<<<<<< HEAD
                <img src="{{ asset('images/ayam-geprek-sambel-ijo.jpeg') }}" alt="Ayam Geprek Sambel Ijo" class="rounded-3xl shadow-2xl border-4 border-white w-full h-80 object-cover">
=======
                <img
                    src="{{ asset('images/hero-warung.jpg') }}"
                    alt="Warung Mama Rina"
                    class="h-80 w-full rounded-3xl border-4 border-white object-cover shadow-2xl"
                    onerror="this.style.display='none'"
                >
>>>>>>> origin/main
            </div>

        </div>
    </section>

<<<<<<< HEAD
    {{-- Tampilan Menu Makanan --}}
    <section id="menu" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <span class="text-xs font-bold uppercase tracking-wider text-[#2d531a]">🍗 Katalog Menu Makanan</span>
            <h2 class="text-3xl font-extrabold text-stone-900 mt-1">Pilih Menu Makanan Favoritmu</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($menus ?? [] as $menu)
                <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-lg transition flex flex-col">
                    <img src="{{ $menu->image ? asset('storage/' . $menu->image) : asset('images/ayam-geprek-sambel-ijo.jpeg') }}"
                         alt="{{ $menu->name }}"
                         class="w-full h-60 object-cover">
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase text-[#2d531a]">{{ $menu->category ?? 'Menu Makanan' }}</span>
                            <h3 class="font-bold text-lg text-stone-900 mt-0.5">{{ $menu->name }}</h3>
                            <p class="text-xs text-stone-500 mt-1.5 leading-relaxed">{{ $menu->description }}</p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-stone-100 flex items-center justify-between">
                            <span class="font-extrabold text-lg text-stone-900">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </span>
                            <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-xl bg-[#2d531a] hover:bg-[#224013] text-white text-xs font-bold">
                                    + Pesan
=======

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

                            @if ($menu->is_available)
                                <form action="{{ route('order.store') }}" method="POST">
                                    @csrf

                                    <input
                                        type="hidden"
                                        name="menu_id"
                                        value="{{ $menu->id }}"
                                    >

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl bg-orange-600 px-4 py-3 text-sm font-bold text-white transition hover:bg-orange-700"
                                    >
                                        + Pesan
                                    </button>
                                </form>
                            @else
                                <button
                                    type="button"
                                    disabled
                                    class="w-full cursor-not-allowed rounded-xl bg-stone-200 px-4 py-3 text-sm font-bold text-stone-500"
                                >
                                    Menu Tidak Tersedia
>>>>>>> origin/main
                                </button>
                            @endif

                        </div>
                    </div>
                </div>

            @empty
<<<<<<< HEAD
                <p class="col-span-full text-center text-stone-500 py-8">Belum ada data menu makanan.</p>
=======

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

>>>>>>> origin/main
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
                        Pesanan akan diproses setelah alur pemesanan diaktifkan.
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
