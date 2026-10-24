{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur Mama Rina — Spesial Ayam Geprek Sambel Ijo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-stone-50 text-stone-900 antialiased">

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
            </div>
        </div>
    </header>

    {{-- Hero Section --}}
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
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <img src="{{ asset('images/ayam-geprek-sambel-ijo.jpeg') }}" alt="Ayam Geprek Sambel Ijo" class="rounded-3xl shadow-2xl border-4 border-white w-full h-80 object-cover">
            </div>
        </div>
    </section>

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
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-stone-500 py-8">Belum ada data menu makanan.</p>
            @endforelse
        </div>
    </section>

</body>
</html>