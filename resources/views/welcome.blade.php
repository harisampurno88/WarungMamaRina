{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur Mama Rina — Pemesanan Makanan Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 text-stone-900 antialiased">

    {{-- Navbar --}}
    <header class="sticky top-0 z-30 bg-white/95 backdrop-blur border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-orange-600 text-white font-bold flex items-center justify-center text-xl">
                    M
                </div>
                <div>
                    <span class="font-extrabold text-xl text-stone-900">Warung Mama Rina</span>
                    <p class="text-xs text-stone-500">Masakan Rumahan Asli Nusantara</p>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-stone-600">
                <a href="#beranda" class="hover:text-orange-600">Beranda</a>
                <a href="#menu" class="hover:text-orange-600">Daftar Menu</a>
                <a href="#cara-pesan" class="hover:text-orange-600">Cara Pesan</a>
            </nav>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl border border-stone-200 text-sm font-semibold text-stone-700 hover:bg-stone-100">
                            Dashboard Saya
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-sm font-semibold text-stone-700 hover:text-orange-600">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-700 text-white text-sm font-bold shadow">
                                Daftar Pelanggan
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    {{-- Hero Section --}}
    <section id="beranda" class="py-14 bg-gradient-to-b from-orange-50/70 to-stone-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7 space-y-5">
                <span class="inline-block px-3 py-1 rounded-full bg-orange-100 text-orange-800 text-xs font-bold">
                    🔥 Gratis Ongkir Radius 3 KM • Dimasak Fresh Setiap Pagi
                </span>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-stone-900 leading-tight">
                    Kangen Masakan Ibu? <span class="text-orange-600">Warung Mama Rina</span> Siap Mengantar!
                </h1>
                <p class="text-stone-600 text-lg">
                    Pesan langsung menu rumahan favoritmu mulai dari Ayam Bakar Madu, Rendang Sapi Spesial, hingga Soto Ayam Kampung hangat.
                </p>
                <div class="flex gap-3 pt-2">
                    <a href="#menu" class="px-6 py-3.5 rounded-xl bg-orange-600 hover:bg-orange-700 text-white font-bold text-sm shadow-lg">
                        Pesan Sekarang
                    </a>
                    <a href="#cara-pesan" class="px-6 py-3.5 rounded-xl border border-stone-300 bg-white text-stone-700 font-semibold text-sm">
                        Lihat Cara Pesan
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <img src="{{ asset('images/hero-warung.jpg') }}" alt="Warung Mama Rina" class="rounded-3xl shadow-2xl border-4 border-white w-full h-80 object-cover">
            </div>
        </div>
    </section>

    {{-- Katalog Menu dari Tabel menus --}}
    <section id="menu" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-stone-900">Menu Pilihan Hari Ini</h2>
                <p class="text-sm text-stone-500 mt-1">Pilih masakan favoritmu dan tambahkan ke keranjang pemesanan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($menus ?? [] as $menu)
                <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col">
                    <img src="{{ $menu->image ? asset('storage/' . $menu->image) : asset('images/default-food.jpg') }}"
                         alt="{{ $menu->name }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase text-orange-600">{{ $menu->category ?? 'Menu Utama' }}</span>
                            <h3 class="font-bold text-base text-stone-900 mt-0.5">{{ $menu->name }}</h3>
                            <p class="text-xs text-stone-500 mt-1 line-clamp-2">{{ $menu->description }}</p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-stone-100 flex items-center justify-between">
                            <span class="font-extrabold text-base text-stone-900">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </span>
                            <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-xl bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold">
                                    + Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-stone-500 py-8">Belum ada data menu di tabel menus.</p>
            @endforelse
        </div>
    </section>

</body>
</html>