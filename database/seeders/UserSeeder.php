<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileName   = time() .'_karona_srun.png';
        $avatar = "https://ui-avatars.com/api/?background=random&size=200&name=karona_srun";
        $img = Image::make($avatar);
        
        $img->fit(200, 200, function ($constraint) {
            $constraint->upsize();                 
        });
        $img->stream();
        Storage::disk('local')->put('public/avatars/'.$fileName, $img, 'public');

        // 
        $fileName1   = time() .'_karona_srun.png';
        $avatar1 = "https://ui-avatars.com/api/?background=random&size=200&name=karona3it";
        $img1 = Image::make($avatar1);
        
        $img1->fit(200, 200, function ($constraint) {
            $constraint->upsize();                 
        });
        $img1->stream();
        Storage::disk('local')->put('public/avatars/'.$fileName1, $img1, 'public');

        $users = [
            [
                'first_name' => 'Karona',
                'last_name' => 'Srun',
                'role' => 1, // admin
                'avatar' => $fileName,
                'email' => 'karonasrun.ks@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar' => $fileName,
                'created_at' => now(),
                'updated_at' => now()
            ], 
            [
                'first_name' => 'Karona',
                'last_name' => 'Srun',
                'role' => 2, // normal
                'avatar' => $fileName,
                'email' => 'karona3it@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar' => $fileName1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        \App\Models\User::insert($users);
    }
}
