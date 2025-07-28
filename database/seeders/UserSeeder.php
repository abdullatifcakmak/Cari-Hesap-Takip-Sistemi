<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([

            'name' => "latif",
            'email' => "test@g.com",
            'password' => Hash::make('latif'),

        ]);


        User::create([

            'name' => "emre",
            'email' => "testo@g.com",
            'password' => Hash::make('emre'),

        ]);
    }
}
