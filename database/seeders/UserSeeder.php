<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'Karona',
                'last_name' => 'Srun',
                'role' => 1, // admin
                'email' => 'karonasrun.ks@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar' => '1629704352_Karona_Srun.png'
            ], 
            [
                'first_name' => 'Karona',
                'last_name' => 'Srun',
                'role' => 2, // normal
                'email' => 'karona3it@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar' => '1629704352_Karona_Srun.png'
            ]
        ];

        \App\Models\User::insert($users);
    }
}
