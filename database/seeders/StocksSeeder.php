<?php

namespace Database\Seeders;

use App\Models\Firm;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (User::find(2)){
            $user = User::find(2);
            Stock::create([
                'product_code' => 'ydk101',
                'name' => 'debriyaj',
                'supplier_name' => 'Eda Ticaret',
                'stock' => '10',
                'purchase_price' => '100',
                'sale_price' => '200',
                'user_id' => $user->id,
            ]);



            Stock::create([
                'product_code' => 'ydk102',
                'name' => 'debriyaj çatalı',
                'supplier_name' => 'Eda Ticaret',
                'stock' => '15',
                'purchase_price' => '50',
                'sale_price' => '100',
                'user_id' => $user->id,
            ]);
        }


        if (User::find(3)){
            $user = User::find(3);
            Stock::create([
                'product_code' => 'ydk201',
                'name' => 'fren balata',
                'supplier_name' => 'Dariri Ticaret',
                'stock' => '5',
                'purchase_price' => '250',
                'sale_price' => '350',
                'user_id' => $user->id,
            ]);



            Stock::create([
                'product_code' => 'ydk202',
                'name' => 'krank',
                'supplier_name' => 'Dariri Ticaret',
                'stock' => '15',
                'purchase_price' => '500',
                'sale_price' => '1000',
                'user_id' => $user->id,
            ]);
        }

    }
}
