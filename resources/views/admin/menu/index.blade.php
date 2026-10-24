
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Kelola Menu Warung
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola makanan dan minuman Warung Mama Rina.
                </p>
            </div>

            <a href="{{ route('menu.create') }}"
               class="mt-3 inline-flex items-center justify-center rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 sm:mt-0">
                + Tambah Menu
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            
@if (session('success'))
    <div
        id="success-alert"
        role="alert"
        class="mb-6 flex items-center justify-between gap-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 transition-opacity duration-500"
    >
        <div class="flex items-center gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 shrink-0 text-green-600"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
            >
                <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"
                />
            </svg>

            <span>{{ session('success') }}</span>
        </div>

        <button
            type="button"
            onclick="dismissSuccessAlert()"
            aria-label="Tutup notifikasi"
            class="shrink-0 rounded-md px-2 py-1 text-xl leading-none text-green-700 hover:bg-green-100 hover:text-green-900"
        >
            &times;
        </button>
    </div>

    <script>
        function dismissSuccessAlert() {
            const alert = document.getElementById('success-alert');

            if (alert) {
                alert.classList.add('opacity-0');

                setTimeout(() => {
                    alert.remove();
                }, 500);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(dismissSuccessAlert, 3000);
        });
    </script>
@endif


            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-xl bg-white p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Total Menu</p>
                    <p class="mt-2 text-3xl font-bold text-gray-800">
                        {{ $menus->count() }}
                    </p>
                </div>

                <div class="rounded-xl bg-white p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Menu Tersedia</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-600">
                        {{ $menus->where('is_available', true)->count() }}
                    </p>
                </div>

                <div class="rounded-xl bg-white p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Menu Tidak Tersedia</p>
                    <p class="mt-2 text-3xl font-bold text-red-600">
                        {{ $menus->where('is_available', false)->count() }}
                    </p>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="border-b border-gray-200 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Daftar Menu
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Daftar menu yang tersimpan di database.
                    </p>
                </div>

                @if ($menus->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-50 text-3xl">
                            🍽️
                        </div>

                        <h4 class="mt-4 text-lg font-semibold text-gray-800">
                            Belum ada menu
                        </h4>

                        <p class="mt-2 text-sm text-gray-500">
                            Mulai tambahkan makanan atau minuman ke daftar menu.
                        </p>

                        <a href="{{ route('menu.create') }}"
                           class="mt-5 inline-flex rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">
                            Tambah Menu Pertama
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Menu
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Harga
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($menus as $menu)
                                    <tr class="transition hover:bg-gray-50">
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                @if ($menu->gambar)
                                                    <img
                                                        src="{{ asset('storage/' . $menu->gambar) }}"
                                                        alt="{{ $menu->nama }}"
                                                        class="h-14 w-14 rounded-lg object-cover"
                                                    >
                                                @else
                                                    <div class="flex h-14 w-14 items-center justify-center rounded-lg bg-gray-100 text-2xl">
                                                        🍲
                                                    </div>
                                                @endif

                                                <div>
                                                    <p class="font-semibold text-gray-800">
                                                        {{ $menu->nama }}
                                                    </p>
                                                    <p class="mt-1 max-w-xs truncate text-sm text-gray-500">
                                                        {{ $menu->deskripsi ?: 'Tidak ada deskripsi' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-700">
                                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            @if ($menu->is_available)
                                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                    Tersedia
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                    Tidak tersedia
                                                </span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                            <div class="flex justify-end gap-3">
                                                <a href="{{ route('menu.edit', $menu) }}"
                                                   class="font-semibold text-blue-600 hover:text-blue-800">
                                                    Edit
                                                </a>                                       
                                                <form
                                                    action="{{ route('menu.destroy', $menu) }}"
                                                    method="POST"
                                                    class="delete-menu-form"
                                                    data-menu-name="{{ $menu->nama }}"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="button"
                                                        class="open-delete-modal font-semibold text-red-600 hover:text-red-800"
                                                        data-menu-name="{{ $menu->nama }}"
                                                    >
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>

    
{{-- Modal Konfirmasi Hapus Menu --}}
<div
    id="delete-menu-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50 p-4"
    role="dialog"
    aria-modal="true"
    aria-labelledby="delete-modal-title"
>
    <div
        id="delete-modal-panel"
        class="w-full max-w-md scale-95 rounded-2xl bg-white p-6 opacity-0 shadow-2xl transition duration-200"
    >
        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
            <svg
                class="h-7 w-7 text-red-600"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v4m0 4h.01M10.3 3.9 1.9 18.4A2 2 0 0 0 3.6 21h16.8a2 2 0 0 0 1.7-2.6L13.7 3.9a2 2 0 0 0-3.4 0Z"
                />
            </svg>
        </div>

        <div class="mt-4 text-center">
            <h3
                id="delete-modal-title"
                class="text-xl font-bold text-gray-900"
            >
                Hapus Menu?
            </h3>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Apakah kamu yakin ingin menghapus menu
                <span
                    id="delete-menu-name"
                    class="font-semibold text-gray-800"
                ></span>?
                Data yang dihapus tidak dapat dikembalikan.
            </p>
        </div>

        <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-center">
            <button
                type="button"
                id="cancel-delete"
                class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
            >
                Batal
            </button>

            <button
                type="button"
                id="confirm-delete"
                class="inline-flex justify-center rounded-lg bg-red-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700"
            >
                Ya, Hapus Menu
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('delete-menu-modal');
        const panel = document.getElementById('delete-modal-panel');
        const menuName = document.getElementById('delete-menu-name');
        const cancelButton = document.getElementById('cancel-delete');
        const confirmButton = document.getElementById('confirm-delete');

        let selectedForm = null;
        let previousFocus = null;

        function openModal(form, name) {
            selectedForm = form;
            previousFocus = document.activeElement;
            menuName.textContent = name;

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            requestAnimationFrame(() => {
                panel.classList.remove('scale-95', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
                cancelButton.focus();
            });
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            panel.classList.add('scale-95', 'opacity-0');
            panel.classList.remove('scale-100', 'opacity-100');

            selectedForm = null;

            if (previousFocus) {
                previousFocus.focus();
            }
        }

        document.querySelectorAll('.open-delete-modal').forEach(button => {
            button.addEventListener('click', function () {
                openModal(
                    button.closest('form'),
                    button.dataset.menuName
                );
            });
        });

        cancelButton.addEventListener('click', closeModal);

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });

        confirmButton.addEventListener('click', function () {
            if (selectedForm) {
                confirmButton.disabled = true;
                confirmButton.textContent = 'Menghapus...';
                selectedForm.submit();
            }
        });
    });
</script>

</x-app-layout>
