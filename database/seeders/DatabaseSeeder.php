<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@warung.com'],
            [
                'name' => 'Admin Mama Rina',
                'password' => bcrypt('password123'),
            ]
        );

        $menus = [
            [
                'nama' => 'Paket Nasi Ayam Geprek Sambel Ijo',
                'deskripsi' => 'Nasi putih hangat dengan ayam goreng tepung krispi, terong goreng tepung, lalapan timun segar, dan sambel ijo khas Dapur Mama Rina.',
                'harga' => 18000,
                'gambar' => 'menus/ayam-geprek-sambel-ijo.jpeg',
                'is_available' => true,
            ],
            [
                'nama' => 'Tempe Goreng Tepung Crispy',
                'deskripsi' => 'Seporsi tempe goreng tepung bumbu gurih renyah di luar dan lembut di dalam, disajikan hangat dengan cocolan sambal pedas.',
                'harga' => 10000,
                'gambar' => 'menus/tempe-goreng-tepung.jpeg',
                'is_available' => true,
            ],
            [
                'nama' => 'Terong Goreng Tepung Crispy',
                'deskripsi' => 'Irisan terong ungu segar dibalut adonan tepung krispi gurih yang digoreng keemasan, cocok disantap bersama sambel ijo.',
                'harga' => 10000,
                'gambar' => 'menus/terong-goreng-tepung.jpeg',
                'is_available' => true,
            ],
        ];

        foreach ($menus as $item) {
            Menu::updateOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
