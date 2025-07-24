<?php

namespace Database\Seeders;

use App\Models\Firm;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stock::create([
            'product_code' => 'ydk101',
            'name' => 'debriyaj',
            'supplier_name' => 'Eda Ticaret',
            'stock' => '10',
            'purchase_price' => '100',
            'sale_price' => '200',
        ]);
    }
}
