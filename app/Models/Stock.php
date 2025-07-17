<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit', 'stock', 'buying_price', 'selling_price'];

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
