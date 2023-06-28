<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    // Hapus data kategori yang ada sebelumnya (jika ada)
    DB::table('categories')->truncate();

    $faker = Faker::create();

    // Simpan gambar kategori di public/images/categories
    $imageDirectory = storage_path('app/public/images/categories');

    // Membuat direktori jika belum ada
    if (!File::isDirectory($imageDirectory)) {
        File::makeDirectory($imageDirectory, 0777, true);
    }

    // Array data kategori
    $categories = [];

    for ($i = 0; $i < 8; $i++) {
        $name = $faker->unique()->sentence(mt_rand(1, 2));
        $name = str_replace('.', '', $name);
        $slug = str_replace(' ', '-', strtolower($name));
        $image = $faker->image($imageDirectory, 400, 400, 'categories', false);
        $status = $faker->randomElement(['PUBLISH', 'DRAFT']);
        $createdAt = $faker->dateTimeBetween('-1 year', 'now');

        $categories[] = [
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'status' => $status,
            'created_at' => $createdAt,
        ];
    }

    // Insert data kategori ke dalam tabel categories
    DB::table('categories')->insert($categories);
}

}
