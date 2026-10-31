
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} — Warung Mama Rina</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-900 antialiased">

<header class="border-b border-stone-200 bg-white">
    <div class="mx-auto flex max-w-4xl items-center justify-between px-4 py-5">
        <a href="{{ route('katalog') }}" class="text-xl font-extrabold">
            <span class="text-orange-600">M</span> Warung Mama Rina
        </a>
        <a href="{{ route('katalog') }}"
           class="text-sm font-semibold text-orange-600 hover:text-orange-700">
            Kembali ke Katalog
        </a>
    </div>
</header>

<main class="mx-auto max-w-4xl px-4 py-10">

    @if (session('success'))
        <div class="mb-6 rounded-xl bg-green-50 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-8">
        <p class="text-sm font-bold uppercase tracking-wider text-orange-600">
            Pesanan berhasil dicatat
        </p>
        <h1 class="mt-2 text-3xl font-extrabold">Detail Pesanan</h1>
        <p class="mt-2 text-stone-500">
            Simpan informasi ini sebagai referensi pesanan kamu.
        </p>
    </div>

    <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
        <div class="flex flex-wrap items-start justify-between gap-4 border-b border-stone-200 pb-5">
            <div>
                <p class="text-sm text-stone-500">Nomor pesanan</p>
                <p class="mt-1 text-2xl font-extrabold">
                    #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                </p>
                <p class="mt-2 text-sm text-stone-500">
                    {{ $order->created_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <span class="rounded-full bg-amber-100 px-4 py-2 text-sm font-bold text-amber-800">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid gap-5 border-b border-stone-200 py-5 sm:grid-cols-2">
            <div>
                <p class="text-sm text-stone-500">Nama pelanggan</p>
                <p class="mt-1 font-bold">{{ $order->nama_pelanggan }}</p>
            </div>
            <div>
                <p class="text-sm text-stone-500">Metode pembayaran</p>
                <p class="mt-1 font-bold">
                    {{ strtoupper($order->metode_pembayaran) }}
                </p>
            </div>
        </div>

        <h2 class="mt-6 text-lg font-extrabold">Menu yang dipesan</h2>

        <div class="mt-4 space-y-4">
            @foreach ($order->orderItems as $item)
                <div class="flex items-start justify-between gap-4 border-b border-stone-100 pb-4">
                    <div>
                        <p class="font-bold">
                            {{ $item->menu?->nama ?? 'Menu sudah tidak tersedia' }}
                        </p>
                        <p class="mt-1 text-sm text-stone-500">
                            {{ $item->jumlah }} porsi ×
                            Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                        </p>
                    </div>
                    <p class="shrink-0 font-bold">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex items-center justify-between gap-4">
            <span class="text-lg font-bold">Total pesanan</span>
            <span class="text-2xl font-extrabold text-orange-600">
                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
            </span>
        </div>
    </section>

    <section class="mt-6 rounded-2xl border border-stone-200 bg-white p-6 text-center shadow-sm sm:p-8">
        <h2 class="text-xl font-extrabold">Informasi Pembayaran</h2>

        @if ($order->metode_pembayaran === 'qris')
            <p class="mt-2 text-sm leading-6 text-stone-500">
                Berikut tampilan QR contoh untuk simulasi antarmuka pembayaran.
                Kode ini bukan kode pembayaran yang dapat dipindai.
            </p>

            <div class="mx-auto mt-5 flex h-56 w-56 items-center justify-center rounded-xl border-2 border-dashed border-stone-300 bg-stone-50 p-4">
                <svg viewBox="0 0 21 21" class="h-full w-full" role="img"
                     aria-label="Ilustrasi QRIS simulasi, bukan kode pembayaran asli">
                    <rect width="21" height="21" fill="white"/>
                    <g fill="#111827">
                        <path d="M1 1h7v7H1z M2 2v5h5V2z M3 3h3v3H3z"/>
                        <path d="M13 1h7v7h-7z M14 2v5h5V2z M15 3h3v3h-3z"/>
                        <path d="M1 13h7v7H1z M2 14v5h5v-5z M3 15h3v3H3z"/>
                        <path d="M9 1h2v2H9z M9 5h2v2H9z M9 9h2v2H9z M12 9h2v2h-2z"/>
                        <path d="M16 9h2v2h-2z M19 9h1v3h-1z M9 13h2v2H9z"/>
                        <path d="M12 13h2v2h-2z M15 13h2v2h-2z M18 14h2v2h-2z"/>
                        <path d="M9 16h2v2H9z M12 17h2v3h-2z M15 17h2v2h-2z M18 19h2v1h-2z"/>
                        <path d="M10 3h2v1h-2z M12 5h1v2h-1z M15 10h1v2h-1z"/>
                    </g>
                </svg>
            </div>

            <p class="mt-4 font-bold text-orange-700">
                QRIS — DEMO / TIDAK DAPAT DIGUNAKAN
            </p>
            <p class="mt-2 text-sm text-stone-500">
                Pembayaran belum terhubung ke penyedia payment gateway.
                Jangan gunakan gambar ini untuk melakukan pembayaran.
            </p>
        @else
            <div class="mx-auto mt-5 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                <span class="text-3xl">✓</span>
            </div>
            <p class="mt-4 font-bold">Metode pembayaran tunai</p>
            <p class="mt-2 text-sm text-stone-500">
                Pembayaran belum dikonfirmasi oleh sistem. Silakan lakukan pembayaran
                tunai kepada petugas saat proses pemesanan sesuai prosedur warung.
            </p>
        @endif

        <div class="mt-6 rounded-xl bg-amber-50 p-4 text-left text-sm leading-6 text-amber-900">
            <strong>Status: {{ ucfirst($order->status) }}.</strong>
            Pesanan telah dicatat, tetapi status ini tidak berarti pembayaran telah berhasil.
        </div>
    </section>

    <div class="mt-6 text-center">
        <a href="{{ route('katalog') }}"
           class="inline-block rounded-xl bg-orange-600 px-6 py-3 font-bold text-white hover:bg-orange-700">
            Kembali ke Katalog
        </a>
    </div>

</main>

<footer class="py-6 text-center text-sm text-stone-500">
    &copy; {{ date('Y') }} Warung Mama Rina
</footer>

</body>
</html>
