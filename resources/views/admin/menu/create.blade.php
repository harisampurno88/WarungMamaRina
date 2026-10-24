
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">
            Tambah Menu
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Form Menu Baru
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Lengkapi informasi makanan atau minuman yang akan dijual.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <p class="font-semibold">Periksa kembali data berikut:</p>
                        <ul class="mt-2 list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('menu.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-5">
                    @csrf

                    <div>
                        <label for="nama" class="mb-2 block text-sm font-medium text-gray-700">
                            Nama Menu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama"
                               value="{{ old('nama') }}"
                               required maxlength="255"
                               placeholder="Contoh: Nasi Goreng Spesial"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    <div>
                        <label for="deskripsi" class="mb-2 block text-sm font-medium text-gray-700">
                            Deskripsi
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                                  placeholder="Deskripsi singkat menu..."
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label for="harga" class="mb-2 block text-sm font-medium text-gray-700">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="harga" name="harga"
                               value="{{ old('harga') }}"
                               required min="0" step="1"
                               placeholder="Contoh: 15000"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    <div>
                        <label for="gambar" class="mb-2 block text-sm font-medium text-gray-700">
                            Foto Menu
                        </label>
                        <input type="file" id="gambar" name="gambar"
                               accept="image/jpeg,image/png,image/webp"
                               class="block w-full rounded-lg border border-gray-300 text-sm text-gray-700 file:mr-4 file:border-0 file:bg-gray-100 file:px-4 file:py-3 file:font-medium hover:file:bg-gray-200">
                        <p class="mt-1 text-xs text-gray-500">
                            Opsional. Format JPG, PNG, atau WEBP, maksimal 2 MB.
                        </p>
                    </div>

                    <div class="rounded-lg bg-gray-50 p-4">
                        <label class="flex items-center gap-3">
                            <input type="checkbox" name="is_available" value="1"
                                   @checked(old('is_available', '1') == '1')
                                   class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            <span>
                                <span class="block text-sm font-medium text-gray-800">
                                    Menu tersedia
                                </span>
                                <span class="block text-xs text-gray-500">
                                    Menu dapat ditampilkan kepada pelanggan.
                                </span>
                            </span>
                        </label>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                        <a href="{{ route('menu.index') }}"
                           class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex justify-center rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">
                            Simpan Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
