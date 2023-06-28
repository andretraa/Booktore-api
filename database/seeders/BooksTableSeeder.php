<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;


class BooksTableSeeder extends Seeder
{
    
    public function run()
    {
        // Hapus data kategori yang ada sebelumnya (jika ada)
    DB::table('books')->truncate();

    $faker = Faker::create();

    // Simpan gambar kategori di public/images/books
    $imageDirectory = storage_path('app/public/images/books');

    // Membuat direktori jika belum ada
    if (!File::isDirectory($imageDirectory)) {
        File::makeDirectory($imageDirectory, 0777, true);
    }

    // Array data kategori
    $books = [];

    for ($i = 0; $i < 20; $i++) {
        $title = $faker->unique()->sentence(mt_rand(1, 2));
        $title = str_replace('.', '', $title);
        $slug = str_replace(' ', '-', strtolower($title));
        $image = $faker->image($imageDirectory, 400, 400, 'books', false);
        $status = $faker->randomElement(['PUBLISH', 'DRAFT']);
        $createdAt = $faker->dateTimeBetween('-1 year', 'now');

        $books[] = [
            'title' => $title,
                'slug' => $slug,
                'description' => $faker->text(255),
                'cover' => $image,
                'author' =>  $faker->name,
                'publisher' =>  $faker->company,
                'price' => mt_rand(1, 10) * 50000,
                'weight' => 0.5,
                'status' => $status,
                'created_at' => $createdAt,
        ];
    }

    // Insert data kategori ke dalam tabel books
        DB::table('books')->insert($books);
    }
}
