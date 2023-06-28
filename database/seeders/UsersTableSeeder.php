<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            $name = $faker->name;
            $email = $faker->unique()->safeEmail;
            $password = Hash::make('password');
            $roles = 'CUSTOMER';
            $status = 'ACTIVE';
            $created_at = $faker->dateTimeBetween('-1 year', 'now');

            // Generate random avatar image file
            $imagePath = $faker->image(storage_path('app/public/images/users'), 200, 200, 'people', true);
            $avatar = Storage::putFile(new File($imagePath));

            // Save user data to database
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'roles' => $roles,
                'avatar' => $avatar,
                'status' => $status,
                'created_at' => $created_at,
            ]);
        }
    }
}
