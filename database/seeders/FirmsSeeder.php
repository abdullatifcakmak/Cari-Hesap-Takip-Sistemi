<?php

namespace Database\Seeders;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FirmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::find(2)) {
            $user = User::find(2);

            Firm::create([
                'name' => "deneme latif",
                'user_id' => $user->id,
            ]);
        }


        if (User::find(3)) {
            $user = User::find(3);

            Firm::create([
                'name' => "deneme emre",
                'user_id' => $user->id,
            ]);
        }
    }
}
